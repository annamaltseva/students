<?php
namespace app\commands;

use Yii;
use yii\rbac\Rule;
use app\models\User;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $group = User::roleCurrentUser();
            if ($item->name === 'admin') {
                return $group == 'admin';
            } elseif ($item->name === 'user') {
                return $group == 'user';
            }
        }
        return $group == 'guest';
    }
}