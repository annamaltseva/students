<?php

namespace app\controllers;

use app\models\CheckoutCompetenceResult;
use app\models\CheckoutResult;
use app\models\ControlAttestationResult;
use app\models\ControlResult;
use app\models\Visit;
use app\models\VisitResult;
use app\models\ControlAttestation;
use Yii;

class CheckoutResultController extends PrepodController
{
    public function actionSetResult($student_id, $checkout_id, $work_num, $result)
    {
        $model = CheckoutResult::find()->where(['student_id' =>$student_id, 'checkout_id' =>$checkout_id, 'work_num'=>$work_num])->one();
        if ($result!="") {
            if (is_null($model)) {
                $model = new CheckoutResult();
            }
            $model->student_id = $student_id;
            $model->checkout_id = $checkout_id;
            $model->work_num = $work_num;
            $model->score = $result;

            if ($model->save()) {
                return '';
            } else {
                return 'Ошибка сохранения, обратитесь к разработчику';
            }
        } else {
            if (!is_null($model)) {
                if ($model->delete()) {
                    return '';
                } else {
                    return 'Ошибка удаления, обратитесь к разработчику';
                }
            }
            return '';
        }
    }

    public function actionSetVisitResult($student_id, $visit_id, $result)
    {
        $visit = Visit::findOne($visit_id);
        $model = VisitResult::find()->where(['student_id' => $student_id, 'visit_id' => $visit_id])->one();

        if ($result!="") {
            if (is_null($model)) {
                $model = new VisitResult();
            }
            $model->visit_id = $visit->id;
            $model->student_id = $student_id;
            $model->rating = $result;
            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                return '';
            } else {
                return 'Ошибка сохранения, обратитесь к разработчику';
            }
        } else {
            if (!is_null($model)) {
                if ($model->delete()) {
                    return '';
                } else {
                    return 'Ошибка удаления, обратитесь к разработчику';
                }
            }
            return '';
        }
   }

    public function actionSetResultQuality($student_id, $competence_id, $work_id, $level_id)
    {
        $model = CheckoutCompetenceResult::find()->with('checkoutWork.checkout')->where([
            'student_id' => $student_id,
            'checkout_competence_id' => $competence_id,
            'checkout_work_id' => $work_id
        ])->one();

        if ($level_id!="") {
            if (is_null($model)) {
                $model = new CheckoutCompetenceResult();
            }
            $model->checkout_competence_id = $competence_id;
            $model->student_id = $student_id;
            $model->checkout_work_id = $work_id;
            $model->competence_level_id = $level_id;
            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                $score= ControlAttestation::find()->select('avg(competence_level.level_value) as kol')
                    ->joinWith('checkouts.checkoutWork.checkoutCompetenceResults.competenceLevel')
                    ->where(['checkout.control_attestation_id'=>$model->checkoutWork->checkout->control_attestation_id,'checkout_competence_result.student_id' =>$student_id])
                    ->groupBy(['checkout_competence_id'])->average('kol') ;

                return round($score,2);
            } else {
                return 'Ошибка сохранения, обратитесь к разработчику';
            }
        } else {
            if (!is_null($model)) {
                if ($model->delete()) {
                    return '';
                } else {
                    return 'Ошибка удаления, обратитесь к разработчику';
                }
            }
            return '';
        }
    }

    public function actionSetControlResult($student_id, $control_id, $score, $range_id)
    {
        $model = ControlResult::find()->where([
            'student_id' => $student_id,
            'control_id' => $control_id,
        ])->one();

        if ($range_id!="") {
            if (is_null($model)) {
                $model = new ControlResult();
            }
            $model->control_id = $control_id;
            $model->student_id = $student_id;
            $model->range_id = $range_id;
            $model->score = $score;
            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                return '';
            } else {
                return 'Ошибка сохранения, обратитесь к разработчику';
            }
        } else {
            if (!is_null($model)) {
                if ($model->delete()) {
                    return '';
                } else {
                    return 'Ошибка удаления, обратитесь к разработчику';
                }
            }
            return '';
        }
    }

    public function actionSetAttestationResult($student_id, $control_attestation_id , $result)
    {
        $model = ControlAttestationResult::find()->where(['student_id' =>$student_id, 'control_attestation_id' =>$control_attestation_id, ])->one();
        if ($result!="") {
            if (is_null($model)) {
                $model = new ControlAttestationResult();
            }
            $model->student_id = $student_id;
            $model->control_attestation_id = $control_attestation_id;
            $model->score = $result;

            if ($model->save()) {
                return '';
            } else {
                return 'Ошибка сохранения, обратитесь к разработчику';
            }
        } else {
            if (!is_null($model)) {
                if ($model->delete()) {
                    return '';
                } else {
                    return 'Ошибка удаления, обратитесь к разработчику';
                }
            }
            return '';
        }
    }
}