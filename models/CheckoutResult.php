<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout_result".
 *
 * @property integer $id
 * @property integer $checkout_id
 * @property integer $student_id
 * @property string $score
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Checkout $checkout
 * @property Student $student
 * @property User $user
 */
class CheckoutResult extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checkout_id', 'student_id', 'work_num','user_id'], 'required'],
            [['checkout_id', 'student_id', 'user_id', 'work_num','created_at', 'updated_at'], 'integer'],
            [['score'], 'number'],
            [['checkout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkout::className(), 'targetAttribute' => ['checkout_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
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
            'student_id' => 'Student ID',
            'score' => 'Score',
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
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getAll($controlID)
    {
        $result=[];

        $checkouts = Checkout::find()->where(['control_id'=>$controlID])->all();
        foreach ($checkouts as $checkout) {
            $checkoutResults = self::find()->where(['checkout_id' => $checkout->id])->all();
            foreach ($checkoutResults as $checkoutResult) {
                $result[$checkoutResult->student_id][$checkoutResult->checkout_id][$checkoutResult->work_num] =$checkoutResult->score;
            }
        }
        return $result;
    }
}
