<?php

namespace app\controllers;

use app\models\Attestation;
use yii\data\ActiveDataProvider;

class AttestationController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Attestation::find()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
}
