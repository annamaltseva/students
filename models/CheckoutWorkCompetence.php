<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout_work_competence".
 *
 * @property integer $id
 * @property integer $checkout_work_id
 * @property integer $checkout_competence_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CheckoutCompetence $checkoutCompetence
 * @property CheckoutWork $checkoutWork
 * @property User $user
 */
class CheckoutWorkCompetence extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_work_competence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checkout_work_id', 'checkout_competence_id', 'user_id'], 'required'],
            [['checkout_work_id', 'checkout_competence_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['checkout_work_id', 'checkout_competence_id'], 'unique', 'targetAttribute' => ['checkout_work_id', 'checkout_competence_id']],
            [['checkout_competence_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckoutCompetence::className(), 'targetAttribute' => ['checkout_competence_id' => 'id']],
            [['checkout_work_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckoutWork::className(), 'targetAttribute' => ['checkout_work_id' => 'id']],
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
            'checkout_work_id' => 'Работа',
            'checkout_competence_id' => 'Компетенция',
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
    public function getCheckoutCompetence()
    {
        return $this->hasOne(CheckoutCompetence::className(), ['id' => 'checkout_competence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutWork()
    {
        return $this->hasOne(CheckoutWork::className(), ['id' => 'checkout_work_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
