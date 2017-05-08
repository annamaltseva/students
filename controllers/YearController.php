<?php

namespace app\controllers;

use app\models\Year;
use yii\data\ActiveDataProvider;

class YearController extends AdminController
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Year::find()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionNew()
    {
        return $this->render('new');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
