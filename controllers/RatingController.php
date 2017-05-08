<?php

namespace app\controllers;

use app\models\Rating;
use yii\data\ActiveDataProvider;

class RatingController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Rating::find()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
}
