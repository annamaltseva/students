<?php

namespace app\controllers;

use app\models\Group;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class GroupController extends AdminController
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->set('RETURN_URL', Yii::$app->request->absoluteUrl);

        $dataProvider = new ActiveDataProvider([
            'query' => Group::getAllProvider()->with('user')
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
    public function actionCreate()
    {
        $model = new Group();

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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            $session = Yii::$app->session;
            return $this->redirect($session->get('RETURN_URL'));
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
