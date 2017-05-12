<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout_competence_result".
 *
 * @property integer $id
 * @property integer $checkout_competence_id
 * @property integer $checkout_work_id
 * @property integer $student_id
 * @property integer $competence_level_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CheckoutCompetence $checkoutCompetence
 * @property CheckoutWork $checkoutWork
 * @property CompetenceLevel $competenceLevel
 * @property Student $student
 * @property User $user
 */
class CheckoutCompetenceResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_competence_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checkout_competence_id', 'checkout_work_id', 'student_id', 'competence_level_id', 'user_id'], 'required'],
            [['checkout_competence_id', 'checkout_work_id', 'student_id', 'competence_level_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['checkout_competence_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckoutCompetence::className(), 'targetAttribute' => ['checkout_competence_id' => 'id']],
            [['checkout_work_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckoutWork::className(), 'targetAttribute' => ['checkout_work_id' => 'id']],
            [['competence_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompetenceLevel::className(), 'targetAttribute' => ['competence_level_id' => 'id']],
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
            'checkout_competence_id' => 'Checkout Competence ID',
            'checkout_work_id' => 'Checkout Work ID',
            'student_id' => 'Student ID',
            'competence_level_id' => 'Competence Level ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getCompetenceLevel()
    {
        return $this->hasOne(CompetenceLevel::className(), ['id' => 'competence_level_id']);
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
}
