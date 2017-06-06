<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout_rating".
 *
 * @property integer $id
 * @property integer $checkout_id
 * @property integer $work_num
 * @property string $score
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Checkout $checkout
 * @property User $user
 */
class CheckoutRating extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checkout_id', 'work_num', 'score', 'user_id'], 'required'],
            [['checkout_id', 'work_num', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['score'], 'number'],
            [['checkout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkout::className(), 'targetAttribute' => ['checkout_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['checkout_id', 'work_num'], 'unique', 'targetAttribute' => ['checkout_id', 'work_num']],
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
            'work_num' => '№ работы',
            'score' => 'Балл по умолчанию',
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
}
