<?php

namespace app\controllers;

use app\models\CheckoutResult;
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

}