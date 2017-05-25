<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\commands\UserGroupRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;

        // Create roles
        $user = $authManager->createRole('user');
        $guest  = $authManager->createRole('guest');

        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $index  = $authManager->createPermission('index');

        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($index);


        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $user->ruleName  = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $index);

        // User
        $authManager->addChild($user, $login);
        $authManager->addChild($user, $logout);
        $authManager->addChild($user, $index);

        // Create simple, based on action{$NAME} permissions
        $control_index  = $authManager->createPermission('control_index');
        // Add permissions in Yii::$app->authManager
        $authManager->add($control_index);
        // Add permission-per-role in Yii::$app->authManager
        $authManager->addChild($user, $control_index);

        $control_create  = $authManager->createPermission('control_create');
        $authManager->add($control_create);
        $authManager->addChild($user, $control_create);

        $control_update  = $authManager->createPermission('control_update');
        $authManager->add($control_update);
        $authManager->addChild($user, $control_update);

        $control_delete  = $authManager->createPermission('control_delete');
        $authManager->add($control_delete);
        $authManager->addChild($user, $control_delete);

        $control_rating_quality  = $authManager->createPermission('control_rating-quality');
        $authManager->add($control_rating_quality);
        $authManager->addChild($user, $control_rating_quality);

        $control_rating  = $authManager->createPermission('control_rating');
        $authManager->add($control_rating);
        $authManager->addChild($user, $control_rating);

        //Range
        $range_index  = $authManager->createPermission('range_index');
        $authManager->add($range_index);
        $authManager->addChild($user, $range_index);

        $range_create  = $authManager->createPermission('range_create');
        $authManager->add($range_create);
        $authManager->addChild($user, $range_create);

        $range_update  = $authManager->createPermission('range_update');
        $authManager->add($range_update);
        $authManager->addChild($user, $range_update);

        $range_delete  = $authManager->createPermission('range_delete');
        $authManager->add($range_delete);
        $authManager->addChild($user, $range_delete);

        //Checkout
        $checkout_index  = $authManager->createPermission('checkout_index');
        $authManager->add($checkout_index);
        $authManager->addChild($user, $checkout_index);

        $checkout_create  = $authManager->createPermission('checkout_create');
        $authManager->add($checkout_create);
        $authManager->addChild($user, $checkout_create);

        $checkout_update  = $authManager->createPermission('checkout_update');
        $authManager->add($checkout_update);
        $authManager->addChild($user, $checkout_update);

        $checkout_delete  = $authManager->createPermission('checkout_delete');
        $authManager->add($checkout_delete);
        $authManager->addChild($user, $checkout_delete);

        //checkout competence
        $checkout_competence  = $authManager->createPermission('checkout_competence');
        $authManager->add($checkout_competence);
        $authManager->addChild($user, $checkout_competence);

        $checkout_create_competence  = $authManager->createPermission('checkout_create-competence');
        $authManager->add($checkout_create_competence);
        $authManager->addChild($user, $checkout_create_competence);

        $checkout_update_competence  = $authManager->createPermission('checkout_update-competence');
        $authManager->add($checkout_update_competence);
        $authManager->addChild($user, $checkout_update_competence);

        $checkout_delete_competence  = $authManager->createPermission('checkout_delete-competence');
        $authManager->add($checkout_delete_competence);
        $authManager->addChild($user, $checkout_delete_competence);

        //checkout work
        $checkout_work  = $authManager->createPermission('checkout_work');
        $authManager->add($checkout_work);
        $authManager->addChild($user, $checkout_work);

        $checkout_create_work  = $authManager->createPermission('checkout_create-work');
        $authManager->add($checkout_create_work);
        $authManager->addChild($user, $checkout_create_work);

        $checkout_update_work  = $authManager->createPermission('checkout_update-work');
        $authManager->add($checkout_update_work);
        $authManager->addChild($user, $checkout_update_work);

        $checkout_delete_work  = $authManager->createPermission('checkout_delete-work');
        $authManager->add($checkout_delete_work);
        $authManager->addChild($user, $checkout_delete_work);


        //checkout work competence
        $checkout_work_competence  = $authManager->createPermission('checkout_work-competence');
        $authManager->add($checkout_work_competence);
        $authManager->addChild($user, $checkout_work_competence);

        $checkout_create_work_competence  = $authManager->createPermission('checkout_create-work-competence');
        $authManager->add($checkout_create_work_competence);
        $authManager->addChild($user, $checkout_create_work_competence);

        $checkout_delete_work_competence  = $authManager->createPermission('checkout_delete-work-competence');
        $authManager->add($checkout_delete_work_competence);
        $authManager->addChild($user, $checkout_delete_work_competence);


        //Visit
        $visit_index  = $authManager->createPermission('visit_index');
        $authManager->add($visit_index);
        $authManager->addChild($user, $visit_index);

        $visit_create  = $authManager->createPermission('visit_create');
        $authManager->add($visit_create);
        $authManager->addChild($user, $visit_create);

        $visit_update  = $authManager->createPermission('visit_update');
        $authManager->add($visit_update);
        $authManager->addChild($user, $visit_update);

        $visit_delete  = $authManager->createPermission('visit_delete');
        $authManager->add($visit_delete);
        $authManager->addChild($user, $visit_delete);



    }
}