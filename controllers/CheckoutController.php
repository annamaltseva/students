<?php

namespace app\controllers;

use app\models\Checkout;
use app\models\Student;
use app\models\CheckoutCompetence;
use app\models\CheckoutWork;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class CheckoutController extends PrepodController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Checkout::find()->with('year','attestation','user','subject','group')
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Checkout();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
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

    public function actionRating($id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()->where(['group_id'=>$model->group_id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating', [
                'model' => $model,
                'studentResults' =>$studentResults
            ]);
        }
    }

    public function actionWork($id)
    {
        $model = $this->findWork($id);
        $studentResults = Student::find()->where(['group_id'=>$model->group_id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('work', [
                'model' => $model,
                'studentResults' =>$studentResults
            ]);
        }
    }

    public function actionCompetence($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => CheckoutCompetence::find()->with('user')->where(['checkout_id' =>$id])
        ]);

        return $this->render('competence',[
            'dataProvider'=> $dataProvider,
            'model' => $model
        ]);
    }

    public function actionCreateCompetence($id)
    {

        $model = $this->findModel($id);
        $modelCompetence = new CheckoutCompetence();
        $modelCompetence->checkout_id = $model->id;

        if ($modelCompetence->load(Yii::$app->request->post()) && $modelCompetence->save()) {
            return $this->redirect(['competence','id' => $model->id]);
        } else {
            return $this->render('_competence_form', [
                'modelCompetence' => $modelCompetence,
                'model' => $model
            ]);
        }
    }


    public function actionUpdateCompetence($id, $competence_id)
    {

        $model = $this->findModel($id);
        $modelCompetence = $this->findCompetence($competence_id);


        if ($modelCompetence->load(Yii::$app->request->post()) && $modelCompetence->save()) {
            return $this->redirect(['competence','id' => $model->id]);
        } else {
            return $this->render('_competence_form', [
                'model' => $model,
                'modelCompetence' => $modelCompetence
            ]);
        }
    }

    public function actionDeleteCompetence($id, $competence_id)
    {

        $model = $this->findModel($id);
        $modelCompetence = $this->findCompetence($competence_id);


        if ($modelCompetence->delete()) {
            return $this->redirect(['competence','id' => $model->id]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Checkout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Checkout::find($id)->with('year','attestation','subject','group')->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

    /**
     * Finds the CheckoutCompetence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CheckoutCompetence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCompetence($id)
    {
        if (($model = CheckoutCompetence::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая компетенция не найдена!');
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Checkout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWork($id)
    {
        if (($model = Checkout::find($id)->with('year','attestation','subject','group')->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

}
