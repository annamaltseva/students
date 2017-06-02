<?php

namespace app\controllers;

use app\models\ControlAttestationReport;
use app\models\ReportForm;
use app\models\Year;
use yii\web\NotFoundHttpException;
use Yii;

class ReportController extends AdminController
{
    public function actionIndex()
    {
        $model = new ReportForm();
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
        return $this->render('result', [
            'data' => $data,
            'year' =>$year
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}
