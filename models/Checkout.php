<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout".
 *
 * @property integer $id
 * @property integer $year_attestation_id
 * @property integer $subject_id
 * @property integer $checkout_form_id
 * @property integer $quantity
 * @property integer $rating_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $group_id
 *
 * @property CheckoutForm $checkoutForm
 * @property Group $group
 * @property Rating $rating
 * @property Subject $subject
 * @property User $user
 * @property YearAttestation $yearAttestation
 * @property CheckoutCompetence[] $checkoutCompetences
 * @property CheckoutResult[] $checkoutResults
 */
class Checkout extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checkout_form_id', 'quantity', 'user_id','control_id' ], 'required'],
            [['checkout_form_id', 'quantity', 'user_id', 'control_id', 'created_at', 'updated_at'], 'integer'],
            [['checkout_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckoutForm::className(), 'targetAttribute' => ['checkout_form_id' => 'id']],
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
            'quantity' => 'Количество',
            'rating_id' => 'Метод оценки',
            'checkout_form_id' => 'Форма контроля',
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
    public function getCheckoutForm()
    {
        return $this->hasOne(CheckoutForm::className(), ['id' => 'checkout_form_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearAttestation()
    {
        return $this->hasOne(YearAttestation::className(), ['id' => 'year_attestation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutWork()
    {
        return $this->hasMany(CheckoutWork::className(), ['checkout_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutResults()
    {
        return $this->hasMany(CheckoutResult::className(), ['checkout_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id'])
            ->viaTable('year_attestation', ['id' => 'year_attestation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttestation()
    {
        return $this->hasOne(Attestation::className(), ['id' => 'attestation_id'])
            ->viaTable('year_attestation', ['id' => 'year_attestation_id']);
    }
}
