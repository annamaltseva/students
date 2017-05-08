<?php

namespace app\controllers;

use app\models\Subject;
use yii\data\ActiveDataProvider;

class SubjectController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subject::find()->orderBy(['name'=>'desc']),

        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }
}
