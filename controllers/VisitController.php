<?php

namespace app\controllers;

use app\models\Visit;

use app\models\Student;
use app\models\VisitResult;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class VisitController extends PrepodController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Visit::find()->with('year', 'attestation', 'user', 'subject', 'group')
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Visit();

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
        if (($model = Visit::find()->with('year', 'attestation', 'subject', 'group')->where(['id' =>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}