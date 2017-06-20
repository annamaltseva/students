<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\models\SignupForm;



class AdminController extends Controller
{
    /**
     * @inheritdoc
     */

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can($action->controller->id.'_'.$action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['is_admin' => 1])
        ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider
        ]);
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
                return $this->render('_form', [
                    'model' => $model,
                ]);
            }

        } else {

            return $this->render('_form', [
                'model' => $model,
            ]);
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
}