<?php

namespace app\controllers;

use app\models\Checkout;
use app\models\CheckoutRating;
use app\models\ControlAttestation;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class CheckoutRatingController extends PrepodController
{
    public function actionIndex($checkout_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CheckoutRating::find()->where(['checkout_id' => $checkout_id])
        ]);

        $model =Checkout::find()->with('controlAttestation','checkoutForm')->where(['id' => $checkout_id])->one();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'checkout_id' => $checkout_id
        ]);
    }

    public function actionCreate($checkout_id)
    {
        $model = new CheckoutRating();
        $model->checkout_id = $checkout_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'checkout_id' => $checkout_id]);
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
            return $this->redirect(['index', 'checkout_id' => $model->checkout_id]);
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
            return $this->redirect(['index', 'checkout_id' => $model->checkout_id]);
        }
    }

    /**
     * Finds the CheckoutRating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CheckoutRating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CheckoutRating::find($id)->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}
?>