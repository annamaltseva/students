<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\Control;
use app\models\Range;
use Yii;

class RangeController extends PrepodController
{
    public function actionIndex($control_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Range::find()->with('user')->where(['control_id' => $control_id])
        ]);
        $model = Control::find()->where(['id' => $control_id])->one();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'control_id' => $control_id,
            'model' => $model
        ]);
    }

    public function actionCreate($control_id)
    {
        $model = new Range();
        $model->control_id = $control_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'control_id' => $control_id]);
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
            return $this->redirect(['index', 'control_id' => $model->control_id]);
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
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Range model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Range the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Range::find($id)->with('control')->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}