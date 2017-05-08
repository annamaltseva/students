<?php

namespace app\controllers;

use app\models\CompetenceLevel;
use yii\data\ActiveDataProvider;

class CompetenceLevelController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CompetenceLevel::find()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
}
