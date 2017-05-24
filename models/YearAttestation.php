<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "year_attestation".
 *
 * @property integer $id
 * @property integer $year_id
 * @property integer $attestation_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Checkout[] $checkouts
 * @property Attestation $attestation
 * @property User $user
 * @property Year $year
 */
class YearAttestation extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'year_attestation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_id', 'attestation_id', 'user_id'], 'required'],
            [['year_id', 'attestation_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['attestation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attestation::className(), 'targetAttribute' => ['attestation_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['year_id' => 'id']],
            [['year_id', 'attestation_id'], 'unique', 'targetAttribute' => ['year_id', 'attestation_id']]
        ];
    }

    public function beforeValidate() {
        $this->user_id = Yii::$app->user->identity->id;
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => 'Год',
            'attestation_id' => 'Аттестация',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['year_attestation_id' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }

    public static function getAll()
    {
        $query = self::find()->with('year','attestation');
        return $query->all();
    }
}
