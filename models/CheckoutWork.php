<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout_work".
 *
 * @property integer $id
 * @property integer $checkout_id
 * @property string $name
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Checkout $checkout
 * @property User $user
 */
class CheckoutWork extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checkout_id', 'name', 'user_id'], 'required'],
            [['checkout_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['checkout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkout::className(), 'targetAttribute' => ['checkout_id' => 'id']],
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
            'checkout_id' => 'Checkout ID',
            'name' => 'Наименование',
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
    public function getCheckout()
    {
        return $this->hasOne(Checkout::className(), ['id' => 'checkout_id']);
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
    public function getCheckoutCompetenceResults()
    {
        return $this->hasMany(CheckoutCompetenceResult::className(), ['checkout_competence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutWorkCompetence()
    {
        return $this->hasMany(CheckoutWorkCompetence::className(), ['checkout_work_id' => 'id']);
    }

}
