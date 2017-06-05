<?php

namespace app\controllers;

use app\models\Checkout;
use app\models\CheckoutCompetenceResult;
use app\models\CheckoutWorkCompetence;
use app\models\ControlAttestation;
use app\models\Student;
use app\models\CheckoutCompetence;
use app\models\CheckoutWork;
use yii\data\ActiveDataProvider;
use app\models\Control;
use yii\web\NotFoundHttpException;
use Yii;

class CheckoutController extends PrepodController
{
    public function actionIndex($control_attestation_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Checkout::find()->with('user','controlAttestation.attestation')->where(['control_attestation_id' => $control_attestation_id])
        ]);

        $model = ControlAttestation::find()->with('control','attestation')->where(['id'=> $control_attestation_id])->one();
        return $this->render('index',[
            'dataProvider'=> $dataProvider,
            'control_attestation_id' => $control_attestation_id,
            'model' => $model->control,
            'attestation' => $model->attestation
        ]);
    }

    public function actionCreate($control_attestation_id)
    {
        $model = new Checkout();
        $model->control_attestation_id = $control_attestation_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'control_attestation_id' => $control_attestation_id]);
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
            return $this->redirect(['index', 'control_attestation_id' => $model->control_attestation_id]);
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
            return $this->redirect(['index','control_attestation_id' => $model->control_attestation_id]);
        }
    }

    public function actionRating($id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()
            ->where(['group_id'=>$model->group_id])->all();
        //
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating', [
                'model' => $model,
                'studentResults' =>$studentResults
            ]);
        }
    }

    public function actionRatingQuality($id,$work_id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()->where(['group_id'=>$model->control->group_id])->all();
        $competence = CheckoutWorkCompetence::find()->with('checkoutCompetence')->where(['checkout_work_id'=> $work_id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating-quality', [
                'model' => $model,
                'studentResults' =>$studentResults,
                'competence' =>$competence
            ]);
        }
    }


    public function actionWork($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => CheckoutWork::find()->with('user')->where(['checkout_id' =>$id])
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('work', [
                'model' => $model,
                'dataProvider' =>$dataProvider
            ]);
        }
    }

    public function actionCreateWork($id)
    {

        $model = $this->findModel($id);
        $modelWork = new CheckoutWork();
        $modelWork->checkout_id = $model->id;

        if ($modelWork->load(Yii::$app->request->post()) && $modelWork->save()) {
            return $this->redirect(['work','id' => $model->id]);
        } else {
            return $this->render('_work_form', [
                'modelWork' => $modelWork,
                'model' => $model
            ]);
        }
    }


    public function actionUpdateWork($id, $work_id)
    {

        $model = $this->findModel($id);
        $modelWork = $this->findWork($work_id);


        if ($modelWork->load(Yii::$app->request->post()) && $modelWork->save()) {
            return $this->redirect(['work','id' => $model->id]);
        } else {
            return $this->render('_work_form', [
                'model' => $model,
                'modelWork' => $modelWork
            ]);
        }
    }

    public function actionDeleteWork($id, $work_id)
    {

        $model = $this->findModel($id);
        $modelWork = $this->findWork($work_id);
        $workID =$modelWork->id;

        if ($modelWork->delete()) {
            CheckoutCompetenceResult::deleteAll(['checkout_work_id' =>$workID]);
            return $this->redirect(['work','id' => $model->id]);
        }
    }

    public function actionWorkCompetence($id, $work_id)
    {

        $model = $this->findWork($work_id);
        $dataProvider = new ActiveDataProvider([
            'query' => CheckoutWorkCompetence::find()->with('user','checkoutCompetence')->where(['checkout_work_id' =>$work_id])
        ]);

        return $this->render('work-competence',[
            'dataProvider'=> $dataProvider,
            'model' => $model
        ]);
    }

    public function actionCreateWorkCompetence($id, $work_id)
    {

        $model = $this->findWork($work_id);
        $modelWork = new CheckoutWorkCompetence();
        $modelWork->checkout_work_id = $model->id;

        if ($modelWork->load(Yii::$app->request->post()) && $modelWork->save()) {
            return $this->redirect(['work-competence','id' => $id,'work_id' =>$work_id ]);
        } else {
            return $this->render('_work_competence_form', [
                'modelWork' => $modelWork,
                'model' => $model
            ]);
        }
    }
    public function actionDeleteWorkCompetence($id, $checkout_id, $work_id)
    {
        $model = $this->findWorkCompetence($id);
        $compID = $model->checkout_competence_id;

        if ($model->delete()) {
            CheckoutCompetenceResult::deleteAll(['checkout_competence_id' =>$compID]);
            return $this->redirect(['work-competence','id' => $checkout_id, 'work_id' =>$work_id]);
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
        if (($model = Checkout::find($id)->with('controlAttestation')->where(['id'=>$id])->one()) !== null) {
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
     * Finds the CheckoutWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CheckoutWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWork($id)
    {
        if (($model = CheckoutWork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая работа не найдена!');
        }
    }

    /**
     * Finds the CheckoutWorkCompetence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CheckoutWorkCompetence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWorkCompetence($id)
    {
        if (($model = CheckoutWorkCompetence::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая компетенция по работе не найдена!');
        }
    }
}
