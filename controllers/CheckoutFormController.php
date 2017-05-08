<?php

namespace app\controllers;

use app\models\CheckoutForm;
use yii\data\ActiveDataProvider;

class CheckoutFormController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CheckoutForm::find()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
}
