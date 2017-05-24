<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property integer $id
 * @property string $date
 * @property integer $control_id
 * @property string $description
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Group $group
 * @property Subject $subject
 * @property User $user
 * @property YearAttestation $yearAttestation
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
            [['date', 'control_id', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['control_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['control_id'], 'exist', 'skipOnError' => true, 'targetClass' => Control::className(), 'targetAttribute' => ['control_id' => 'id']],
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
            'year_attestation_id' => 'Аттестация',
            'group_id' => 'Группа',
            'subject_id' => 'Предмет',
            'description' => 'Примечание',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeValidate() {
        $this->user_id = Yii::$app->user->identity->id;
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
    public function getControl()
    {
        return $this->hasOne(Control::className(), ['id' => 'control_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id'])
            ->viaTable('control', ['id' => 'control_id']);
    }
}
