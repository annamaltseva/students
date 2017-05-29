<?php

namespace app\controllers;

use app\models\Checkout;
use app\models\CheckoutResult;
use app\models\CheckoutWorkCompetence;
use app\models\Control;
use app\models\ControlAttestation;
use app\models\ControlResult;
use app\models\Range;
use app\models\Student;
use app\models\CheckoutCompetence;
use app\models\CheckoutWork;
use app\models\CheckoutCompetenceResult;
use app\models\Visit;
use app\models\VisitResult;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class ControlController extends PrepodController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Control::find()->with('year','user','subject','group','rating','goal','controlStatus'),
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Control();

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
        $students = Student::find()
            ->where(['group_id'=>$model->group_id])
            ->orderBy(['name'=>'desc'])->all();
        $results = CheckoutResult::getAll($id);
        $attestations =ControlAttestation::find()->where(['control_id']);
        $checkouts = null;//Checkout::find()->with('checkoutForm')->where(['control_id' =>$model->id])->all();
        $visits = VisitResult::getSumAll($id);
        $ranges = Range::getAll($id);
        $controlResults = ControlResult::getAll($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating', [
                'model' => $model,
                'students' =>$students,
                'attestations' => $attestations,
                'checkouts' =>$checkouts,
                'results' =>$results,
                'visits' => $visits,
                'ranges' => $ranges,
                'controlResults' => $controlResults
            ]);
        }
    }

    public function actionRatingVisit($id)
    {
        $model = $this->findModel($id);
        $students = Student::find()
            ->where(['group_id'=>$model->group_id])
            ->orderBy(['name'=>'desc'])->all();
        $results = VisitResult::getAll($id);
        $visits = Visit::find()->with('subject')->where(['control_id' =>$model->id])->all();

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



    public function actionRatingQuality($id)
    {
        $model = $this->findModel($id);
        $students = Student::find()->where(['group_id'=>$model->group_id])
            ->orderBy(['name'=>'desc'])->all();

        $headerData = Control::getCheckoutWorkAll($id);
        $checkouts =$headerData["checkout"];
        $works =$headerData["work"];
        $competences =$headerData["competence"];

        $results = CheckoutCompetenceResult::getAll($id);
        $ranges = Range::getAll($id);
        $controlResults = ControlResult::getAll($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('rating-quality', [
                'model' => $model,
                'students' => $students,
                'checkouts' => $checkouts,
                'works' => $works,
                'competences' => $competences,
                'results' => $results,
                'ranges' => $ranges,
                'controlResults' => $controlResults
            ]);
        }
    }


    public function actionClose($id)
    {
        $model = Control::find()->where(['id' =>$id, 'control_status_id'])->one();
        if ($model !== null) {
            $model->control_status_id = 2;
            $model->save();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('Запрашиваемая компетенция по работе не найдена!');
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


        if ($modelWork->delete()) {
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

        if ($model->delete()) {
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
        if (($model = Control::find($id)->with('year','subject','group')->where(['id'=>$id])->one()) !== null) {
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
