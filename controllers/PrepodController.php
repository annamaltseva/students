<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;



class PrepodController extends Controller
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
}