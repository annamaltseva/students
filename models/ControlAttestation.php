<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "control_attestation".
 *
 * @property integer $id
 * @property integer $control_id
 * @property integer $attestation_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Checkout[] $checkouts
 * @property Attestation $attestation
 * @property Control $control
 * @property User $rating
 */
class ControlAttestation extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'control_attestation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['control_id', 'attestation_id',  'user_id'], 'required'],
            [['control_id', 'attestation_id',  'user_id','created_at', 'updated_at'], 'integer'],
            [['attestation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attestation::className(), 'targetAttribute' => ['attestation_id' => 'id']],
            [['control_id'], 'exist', 'skipOnError' => true, 'targetClass' => Control::className(), 'targetAttribute' => ['control_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['control_id', 'attestation_id'], 'unique', 'targetAttribute' => ['control_id', 'attestation_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_id' => 'Контроль',
            'attestation_id' => 'Аттестация',
            'user_id' => 'User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['control_attestation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttestation()
    {
        return $this->hasOne(Attestation::className(), ['id' => 'attestation_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
