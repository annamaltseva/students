<?php
namespace app\controllers;

use app\models\ControlAttestationResult;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\ControlAttestation;
use app\models\Control;
use app\models\Student;
use app\models\CheckoutResult;
use app\models\VisitResult;
use app\models\Range;
use app\models\ControlResult;
use app\models\Checkout;
use app\models\CheckoutCompetenceResult;
use app\models\Visit;

class ControlAttestationController extends PrepodController
{
    public function actionIndex($control_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ControlAttestation::find()->with( 'user', 'attestation','control')->where(['control_id' => $control_id]),
            'sort' => ['defaultOrder' => ['attestation_id' => SORT_ASC]]
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


    public function actionRating($id)
    {
        $model = $this->findModel($id);
        $students = Student::find()
            ->where(['group_id'=>$model->control->group_id])
            ->orderBy(['name'=>'desc'])->all();
        $results = CheckoutResult::getAll($id);
        $firstAttestation = ControlAttestation::find()->with('checkouts')->where(['control_id' =>$model->control_id, 'attestation_id'=>1])->one();
        $firstAttestationResult = ControlAttestationResult::getAll($firstAttestation->id);
        $checkouts = Checkout::find()->with('checkoutForm')->where(['control_attestation_id' =>$id])->all();
        $visits = VisitResult::getSumAll($id);
        $ranges = Range::getAll($model->control->id);
        $controlResults = ControlResult::getAll($model->control->id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating', [
                'model' => $model->control,
                'attestation' => $model,
                'students' =>$students,
                'checkouts' =>$checkouts,
                'results' =>$results,
                'visits' => $visits,
                'ranges' => $ranges,
                'controlResults' => $controlResults,
                'firstAttestationResult' => $firstAttestationResult,
                'firstAttestation' => $firstAttestation
            ]);
        }
    }

    public function actionRatingQuality($id)
    {
        $model = $this->findModel($id);
        $students = Student::find()
            ->where(['group_id'=>$model->control->group_id])
            ->orderBy(['name'=>'desc'])->all();

        $firstAttestation = ControlAttestation::find()->with('checkouts')->where(['control_id' =>$model->control_id, 'attestation_id'=>1])->one();
        $firstAttestationResult = ControlAttestationResult::getAll($firstAttestation->id);
        $visits = VisitResult::getSumAll($id);
        $ranges = Range::getAll($model->control->id);
        $controlResults = ControlResult::getAll($model->control->id);


        $headerData = Control::getCheckoutWorkAll($id);
        $checkouts =$headerData["checkout"];
        $works =$headerData["work"];
        $competences =$headerData["competence"];

        $results = CheckoutCompetenceResult::getAll($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating-quality', [
                'model' => $model->control,
                'attestation' => $model,
                'works' =>$works,
                'competences' =>$competences,
                'students' =>$students,
                'checkouts' =>$checkouts,
                'results' =>$results,
                'visits' => $visits,
                'ranges' => $ranges,
                'controlResults' => $controlResults,
                'firstAttestationResult' => $firstAttestationResult,
                'firstAttestation' => $firstAttestation
            ]);
        }
    }


    public function actionRatingVisit($id)
    {
        $model = $this->findModel($id);

        $students = Student::find()
            ->where(['group_id'=>$model->control->group_id])
            ->orderBy(['name'=>'desc'])->all();
        $results = VisitResult::getAll($id);
        $visits = Visit::find()->with('controlAttestation.control.subject')->where(['control_attestation_id' =>$id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating-visit', [
                'model' => $model,
                'students' =>$students,
                'visits' =>$visits,
                'results' =>$results
            ]);
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
        if (($model = ControlAttestation::find($id)->with('control','attestation')->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}