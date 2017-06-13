<?php

namespace app\controllers;

use app\models\ControlAttestationReport;
use app\models\ReportForm;
use app\models\Year;
use Yii;

class ReportController extends AdminController
{
    public function actionIndex()
    {
        $model = new ReportForm();
        $model->view_type = 1;
        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionResult()
    {
        $this->layout = 'report';
        $filter = Yii::$app->request->post('ReportForm');
        $data = ControlAttestationReport::getReportData($filter);
        $year = Year::findOne($filter["year_id"]);

        if ($filter["view_type"] ==1) {
            return $this->render('result', [
                'data' => $data,
                'year' => $year
            ]);
        } else {
            return $this->render('excel', [
                'data' => $data,
                'year' => $year
            ]);
        }
    }
}
