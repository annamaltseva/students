<?php

namespace app\controllers;

use app\models\CheckoutCompetenceResult;
use app\models\CheckoutResult;
use app\models\Visit;
use app\models\VisitResult;
use Yii;

class CheckoutResultController extends PrepodController
{
    public function actionSetResult($student_id, $checkout_id, $work_num, $result)
    {
        $model = CheckoutResult::find()->where(['student_id' =>$student_id, 'checkout_id' =>$checkout_id, 'work_num'=>$work_num])->one();
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
    }

    public function actionSetVisitResult($student_id, $visit_id, $result)
    {
        $visit = Visit::findOne($visit_id);
        $model = VisitResult::find()->where(['student_id' => $student_id, 'visit_id' => $visit_id])->one();

        if ($result=="true") {
            if (is_null($model)) {
                $model = new VisitResult();
            }
            $model->visit_id = $visit->id;
            $model->student_id = $student_id;
            $model->rating = $visit->rating;
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
        $model = CheckoutCompetenceResult::find()->where([
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