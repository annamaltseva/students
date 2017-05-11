<?php

namespace app\controllers;

use app\models\Checkout;
use app\models\Student;
use app\models\YearAttestation;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class CheckoutController extends PrepodController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Checkout::find()->with('year','attestation','user','subject','group')
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Checkout();

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

    public function actionRating($id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()->where(['group_id'=>$model->group_id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating', [
                'model' => $model,
                'studentResults' =>$studentResults
            ]);
        }
    }

    public function actionWork($id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()->where(['group_id'=>$model->group_id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('work', [
                'model' => $model,
                'studentResults' =>$studentResults
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return YearAttestation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Checkout::find($id)->with('year','attestation','subject','group')->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

}
