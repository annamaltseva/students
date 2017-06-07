<?php

namespace app\controllers;

use app\models\Year;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class YearController extends AdminController
{


    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->set('RETURN_URL', Yii::$app->request->absoluteUrl);

        $dataProvider = new ActiveDataProvider([
            'query' => Year::find()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Year();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = Yii::$app->session;
            return $this->redirect($session->get('RETURN_URL'));
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
    /**
     * Finds the Year model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Year the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Year::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}
