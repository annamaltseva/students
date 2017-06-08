<?php

namespace app\controllers;

use app\models\Group;
use app\models\Student;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class StudentController extends AdminController
{
    public function actionIndex($group_id = null)
    {

        $session = Yii::$app->session;
        $session->set('RETURN_URL', Yii::$app->request->absoluteUrl);

        $query = Student::find()->with('group');
        $groupName = null;
        $groupID = null;
        if (!is_null($group_id)){
            $query = $query->where(['group_id' => $group_id]);
            $groupModel = Group::findOne($group_id);
            $groupName = $groupModel->name;
            $groupID = $groupModel->id;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider,
            'groupName' => $groupName,
            'groupID' => $groupID
        ]);
    }

    public function actionCreate($group_id = null)
    {
        $session = Yii::$app->session;

        $model = new Student();
        $model->group_id =$group_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($session->get('RETURN_URL'));
        } else {
            return $this->render('_form', [
                'model' => $model,
                'cancelUrl' =>$session->get('RETURN_URL')
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($session->get('RETURN_URL'));
        } else {
            return $this->render('_form', [
                'model' => $model,
                'cancelUrl' =>$session->get('RETURN_URL')
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            $session = Yii::$app->session;
            return $this->redirect($session->get('RETURN_URL'));
        }
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

}
