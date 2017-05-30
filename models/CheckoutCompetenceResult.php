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
class CheckoutCompetenceResult extends AppActiveRecord
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


    public function afterSave($insert, $changedAttributes)
    {
        $control_attestation_id = $this->checkoutWork->checkout->control_attestation_id;
        $score= ControlAttestation::find()->joinWith('checkouts.checkoutWork.checkoutCompetenceResults.competenceLevel')
            ->where(['checkout.control_attestation_id'=>$control_attestation_id,'checkout_competence_result.student_id' =>$this->student_id])
            ->average('competence_level.level_value') ;
        $model = ControlAttestationResult::find()
            ->where(['student_id' =>$this->student_id, 'control_attestation_id' =>$control_attestation_id])
            ->one();
        if (is_null($model)) {
            $model = new ControlAttestationResult();
            $model->student_id = $this->student_id;
            $model->control_attestation_id = $control_attestation_id;
        }
        $model->score = $score;
        $model->save();
    }


    public function afterDelete()
    {
        $control_attestation_id = $this->checkoutWork->checkout->control_attestation_id;
        $score= ControlAttestation::find()->joinWith('checkouts.checkoutWork.checkoutCompetenceResults.competenceLevel')
            ->where(['checkout.control_attestation_id'=>$control_attestation_id,'checkout_competence_result.student_id' =>$this->student_id])
            ->average('competence_level.level_value') ;
        $model = ControlAttestationResult::find()
            ->where(['student_id' =>$this->student_id, 'control_attestation_id' =>$control_attestation_id])
            ->one();
        if (is_null($model)) {
            $model = new ControlAttestationResult();
            $model->student_id = $this->student_id;
            $model->control_attestation_id = $control_attestation_id;
        }
        $model->score = $score;
        $model->save();
    }


    public static function getAll($controlID)
    {
        $result=[];
/*
        $checkouts = Checkout::find()->where(['control_id'=>$controlID])->all();
        foreach ($checkouts as $checkout) {
            $checkoutResults = self::find()->where(['checkout_id' => $checkout->id])->all();
            foreach ($checkoutResults as $checkoutResult) {
                $result[$checkoutResult->student_id][$checkoutResult->checkout_id][$checkoutResult->work_num] =$checkoutResult->score;
            }
        }
*/
        $checkouts = Checkout::find()->with('checkoutForm')->where(['control_attestation_id' => $controlID])->all();
        foreach ($checkouts as $checkout) {
            $works = CheckoutWork::find()->where(['checkout_id' => $checkout->id])->all();
            foreach ($works as $work) {
                $checkoutResults = CheckoutCompetenceResult::find()->with('competenceLevel')->where(['checkout_work_id' => $work->id])->all();
                foreach ($checkoutResults as $checkoutResult) {
                    $result[$checkoutResult->student_id][$checkoutResult->checkout_work_id][$checkoutResult->checkout_competence_id] = [
                        'id' =>$checkoutResult->competence_level_id,
                        'value' =>$checkoutResult->competenceLevel->level_value
                    ];
                }
            }
        }
        return $result;

    }
}
