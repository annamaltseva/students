<?php

namespace app\controllers;

use app\models\Visit;

use app\models\Student;
use app\models\VisitResult;
use app\models\Control;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class VisitController extends PrepodController
{
    public function actionIndex($control_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Visit::find()->with('user')->where(['control_id' => $control_id])
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
        $model = new Visit();
        $model->control_id = $control_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','control_id' =>$control_id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($control_id,$id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','control_id' =>$control_id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($control_id,$id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            return $this->redirect(['index','control_id' =>$control_id]);
        }
    }


    public function actionResult($id)
    {
        $model = $this->findModel($id);
        $studentResults = Student::find()
                    ->joinWith([
                        'visitResults' => function ($query) use ($id) {
                            $query->onCondition(['visit_result.visit_id' => $id]);
                        },
                    ], true, 'LEFT JOIN')
                    ->where(['group_id' => $model->group_id])
                    ->orderBy(['name'=>'desc'])
                    ->all();

        if (count(Yii::$app->request->post())>0)
        {
            $post = Yii::$app->request->post();
            foreach ($studentResults as $result) {
                if ($post["st_".$result->id] =="on") {
                    $visitResult = new VisitResult();
                    $visitResult->visit_id = $model->id;
                    $visitResult->student_id = $result->id;
                    $visitResult->rating = $model->rating;
                    $visitResult->user_id = Yii::$app->user->identity->id;
                    if ($visitResult->validate()) {
                        $visitResult->save();
                    }
                } else {
                    $visitResult = VisitResult::find()->where(['student_id' =>$result->id, 'visit_id' => $model->id ])->one();
                    if ($visitResult) {
                        $visitResult->delete();
                    }
                }
            }
            return $this->redirect(['result','id' =>$id ]);
        }

        return $this->render('result', [
            'model' =>$model,
            'studentResults' => $studentResults
        ]);
    }




    /**
     * Finds the Visit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Visit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visit::find()->with('control')->where(['id' =>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}