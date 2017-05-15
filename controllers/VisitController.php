<?php

namespace app\controllers;

use app\models\Visit;

use app\models\Student;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class VisitController extends PrepodController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Visit::find()->with('year', 'attestation', 'user', 'subject', 'group')
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Visit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            return $this->redirect(['index']);
        }
    }


    public function actionResult($id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()->where(['group_id'=>$model->group_id])->all();

        return $this->render('result', [
            'model' =>$model,
            'studentResults' => $studentResults
        ]);
    }




    /**
     * Finds the Visit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Visit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visit::find()->with('year', 'attestation', 'subject', 'group')->where(['id' =>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}