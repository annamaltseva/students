<?php

namespace app\controllers;

use app\models\SignupForm;
use app\models\User;
use app\models\UserGroup;
use app\models\UserSubject;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

class TeacherController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::getTeachers()
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new SignupForm();
        $model->setScenario(SignupForm::SCENARIO_UPDATE);

        $model->isNewRecord = true;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('_form', [
                    'model' => $model,
                ]);
            }
        }
        else {
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

    public function actionPassword($id)
    {
        $model = new SignupForm();
        $model->setScenario(SignupForm::SCENARIO_PWD_CHANGE);
        $user = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $user->setPassword($model->password);
            $user->generateAuthKey();
            if ($user->save()){
                return $this->redirect(['index']);
            }else {
                return $this->render('_pwd', [
                    'model' => $model,
                ]);
            }

        } else {

            return $this->render('_pwd', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED ;

        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }

    public function actionAccess($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => UserSubject::find()->with('subject')->where(['prepod_id' => $id])
        ]);

        return $this->render('access',[
            'dataProvider'=> $dataProvider,
            'model' => $model
        ]);
    }

    public function actionAccessCreate($id)
    {
        $model = new UserSubject();
        $model->prepod_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['access','id' => $id]);
        } else {
            return $this->render('_form_access', [
                'model' => $model,
            ]);
        }
    }

    public function actionAccessDelete($id, $access_id)
    {
        $model = $this->findAccessModel($access_id);

        if ($model->delete()) {
            return $this->redirect(['access','id' => $id]);
        }
    }


    public function actionGroup($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => UserGroup::find()->with('group')->where(['prepod_id' => $id])
        ]);

        return $this->render('group',[
            'dataProvider'=> $dataProvider,
            'model' => $model
        ]);
    }

    public function actionGroupCreate($id)
    {
        $model = new UserGroup();
        $model->prepod_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['group','id' => $id]);
        } else {
            return $this->render('_form_group', [
                'model' => $model,
            ]);
        }
    }

    public function actionGroupDelete($id, $group_id)
    {
        $model = $this->findGroupModel($group_id);

        if ($model->delete()) {
            return $this->redirect(['group','id' => $id]);
        }
    }



    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

    protected function findAccessModel($id)
    {
        if (($model = UserSubject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

    protected function findGroupModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }
}
