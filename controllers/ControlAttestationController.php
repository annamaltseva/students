<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\ControlAttestation;
use app\models\Control;

class ControlAttestationController extends PrepodController
{
    public function actionIndex($control_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ControlAttestation::find()->with( 'user', 'attestation','control')->where(['control_id' => $control_id]),
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
        $model = Control::find()->where(['id'=> $control_id])->one();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'control_id' => $control_id,
            'model' => $model
        ]);
    }

    public function actionCreate($control_id)
    {
        $model = new ControlAttestation();
        $model->control_id = $control_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'control_id' => $control_id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate( $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','control_id' => $model->control_id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $control_id = $model->control_id;
        if ($model->delete()) {
            return $this->redirect(['index','control_id' => $control_id]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ControlAttestation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ControlAttestation::find($id)->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}