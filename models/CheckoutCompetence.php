<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout_competence".
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
 * @property CheckoutCompetenceResult[] $checkoutCompetenceResults
 */
class CheckoutCompetence extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_competence';
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
            'name' => 'Название',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public static function getAll($checkoutID)
    {
        $query = self::find()->where(['checkout_id' =>$checkoutID]);
        return $query->all();
    }
}
