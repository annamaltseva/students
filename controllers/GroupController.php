<?php

namespace app\controllers;

use app\models\Group;
use yii\data\ActiveDataProvider;
use Yii;

class GroupController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Group::find()->with('user')
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
    public function actionCreate()
    {
        $model = new Group();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }
}
