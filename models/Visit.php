<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property integer $id
 * @property string $date
 * @property integer $control_attestation_id
 * @property string $description
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Group $group
 * @property Subject $subject
 * @property User $user
 * @property ControlAttestation $controlAttestation
 * @property VisitResult[] $visitResults
 */
class Visit extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'control_attestation_id', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['control_attestation_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['control_attestation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ControlAttestation::className(), 'targetAttribute' => ['control_attestation_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата лекции',
            'description' => 'Примечание',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterFind()
    {
        $this->date = date('d.m.Y',strtotime($this->date));

        parent::afterFind();
    }

    public function beforeValidate()
    {
        $this->date = date('Y-m-d',strtotime($this->date));

        return parent::beforeValidate();
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitResults()
    {
        return $this->hasMany(VisitResult::className(), ['visit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlAttestation()
    {
        return $this->hasOne(ControlAttestation::className(), ['id' => 'control_attestation_id']);
    }


}
