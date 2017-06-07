<?php

namespace app\controllers;

use app\models\Subject;
use yii\data\ActiveDataProvider;
use Yii;

class SubjectController extends AdminController
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->set('RETURN_URL', Yii::$app->request->absoluteUrl);

        $dataProvider = new ActiveDataProvider([
            'query' => Subject::find(),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Subject();

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
            $session = Yii::$app->session;
            return $this->redirect($session->get('RETURN_URL'));
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
        if (($model = Subject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}
