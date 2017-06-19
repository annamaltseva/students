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
        $admin  = $authManager->createRole('admin');

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
        $admin->ruleName  = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($admin);

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
        $authManager->addChild($admin, $control_index);


        $control_create  = $authManager->createPermission('control_create');
        $authManager->add($control_create);
        $authManager->addChild($user, $control_create);
        $authManager->addChild($admin, $control_create);

        $control_update  = $authManager->createPermission('control_update');
        $authManager->add($control_update);
        $authManager->addChild($user, $control_update);
        $authManager->addChild($admin, $control_update);

        $control_delete  = $authManager->createPermission('control_delete');
        $authManager->add($control_delete);
        $authManager->addChild($user, $control_delete);
        $authManager->addChild($admin, $control_delete);

        $control_rating_quality  = $authManager->createPermission('control_rating-quality');
        $authManager->add($control_rating_quality);
        $authManager->addChild($user, $control_rating_quality);

        $control_generateReport  = $authManager->createPermission('control_generate-report');
        $authManager->add($control_generateReport);
        $authManager->addChild($user, $control_generateReport);
        $authManager->addChild($admin, $control_generateReport);

        $control_generateQualityReport  = $authManager->createPermission('control_generate-quality-report');
        $authManager->add($control_generateQualityReport);
        $authManager->addChild($user, $control_generateQualityReport);
        $authManager->addChild($admin, $control_generateQualityReport);




        //Range
        $range_index  = $authManager->createPermission('range_index');
        $authManager->add($range_index);
        $authManager->addChild($user, $range_index);
        $authManager->addChild($admin, $range_index);

        $range_create  = $authManager->createPermission('range_create');
        $authManager->add($range_create);
        $authManager->addChild($user, $range_create);
        $authManager->addChild($admin, $range_create);

        $range_update  = $authManager->createPermission('range_update');
        $authManager->add($range_update);
        $authManager->addChild($user, $range_update);
        $authManager->addChild($admin, $range_update);

        $range_delete  = $authManager->createPermission('range_delete');
        $authManager->add($range_delete);
        $authManager->addChild($user, $range_delete);
        $authManager->addChild($admin, $range_delete);


        //Control attestation
        $controlAttestation_index  = $authManager->createPermission('control-attestation_index');
        $authManager->add($controlAttestation_index);
        $authManager->addChild($user, $controlAttestation_index);
        $authManager->addChild($admin, $controlAttestation_index);

        $controlAttestation_create  = $authManager->createPermission('control-attestation_create');
        $authManager->add($controlAttestation_create);
        $authManager->addChild($user, $controlAttestation_create);
        $authManager->addChild($admin, $controlAttestation_create);

        $controlAttestation_update  = $authManager->createPermission('control-attestation_update');
        $authManager->add($controlAttestation_update);
        $authManager->addChild($user, $controlAttestation_update);
        $authManager->addChild($admin, $controlAttestation_update);

        $controlAttestation_delete  = $authManager->createPermission('control-attestation_delete');
        $authManager->add($controlAttestation_delete);
        $authManager->addChild($user, $controlAttestation_delete);
        $authManager->addChild($admin, $controlAttestation_delete);

        $controlAttestation_rating  = $authManager->createPermission('control-attestation_rating');
        $authManager->add($controlAttestation_rating);
        $authManager->addChild($user, $controlAttestation_rating);
        $authManager->addChild($admin, $controlAttestation_rating);

        $controlAttestation_rating_visit  = $authManager->createPermission('control-attestation_rating-visit');
        $authManager->add($controlAttestation_rating_visit);
        $authManager->addChild($user, $controlAttestation_rating_visit);
        $authManager->addChild($admin, $controlAttestation_rating_visit);

        $controlAttestation_rating_quality  = $authManager->createPermission('control-attestation_rating-quality');
        $authManager->add($controlAttestation_rating_quality);
        $authManager->addChild($user, $controlAttestation_rating_quality);
        $authManager->addChild($admin, $controlAttestation_rating_quality);


        //Checkout
        $checkout_index  = $authManager->createPermission('checkout_index');
        $authManager->add($checkout_index);
        $authManager->addChild($user, $checkout_index);
        $authManager->addChild($admin, $checkout_index);

        $checkout_create  = $authManager->createPermission('checkout_create');
        $authManager->add($checkout_create);
        $authManager->addChild($user, $checkout_create);
        $authManager->addChild($admin, $checkout_create);

        $checkout_update  = $authManager->createPermission('checkout_update');
        $authManager->add($checkout_update);
        $authManager->addChild($user, $checkout_update);
        $authManager->addChild($admin, $checkout_update);

        $checkout_delete  = $authManager->createPermission('checkout_delete');
        $authManager->add($checkout_delete);
        $authManager->addChild($user, $checkout_delete);
        $authManager->addChild($admin, $checkout_delete);

        //Checkout rating
        $checkoutRating_index  = $authManager->createPermission('checkout-rating_index');
        $authManager->add($checkoutRating_index);
        $authManager->addChild($user, $checkoutRating_index);
        $authManager->addChild($admin, $checkoutRating_index);

        $checkoutRating_create  = $authManager->createPermission('checkout-rating_create');
        $authManager->add($checkoutRating_create);
        $authManager->addChild($user, $checkoutRating_create);
        $authManager->addChild($admin, $checkoutRating_create);

        $checkoutRating_update  = $authManager->createPermission('checkout-rating_update');
        $authManager->add($checkoutRating_update);
        $authManager->addChild($user, $checkoutRating_update);
        $authManager->addChild($admin, $checkoutRating_update);

        $checkoutRating_delete  = $authManager->createPermission('checkout-rating_delete');
        $authManager->add($checkoutRating_delete);
        $authManager->addChild($user, $checkoutRating_delete);
        $authManager->addChild($admin, $checkoutRating_delete);

        //checkout competence
        $checkout_competence  = $authManager->createPermission('checkout_competence');
        $authManager->add($checkout_competence);
        $authManager->addChild($user, $checkout_competence);
        $authManager->addChild($admin, $checkout_competence);

        $checkout_create_competence  = $authManager->createPermission('checkout_create-competence');
        $authManager->add($checkout_create_competence);
        $authManager->addChild($user, $checkout_create_competence);
        $authManager->addChild($admin, $checkout_create_competence);

        $checkout_update_competence  = $authManager->createPermission('checkout_update-competence');
        $authManager->add($checkout_update_competence);
        $authManager->addChild($user, $checkout_update_competence);
        $authManager->addChild($admin, $checkout_update_competence);

        $checkout_delete_competence  = $authManager->createPermission('checkout_delete-competence');
        $authManager->add($checkout_delete_competence);
        $authManager->addChild($user, $checkout_delete_competence);
        $authManager->addChild($admin, $checkout_delete_competence);

        //checkout work
        $checkout_work  = $authManager->createPermission('checkout_work');
        $authManager->add($checkout_work);
        $authManager->addChild($user, $checkout_work);
        $authManager->addChild($admin, $checkout_work);

        $checkout_create_work  = $authManager->createPermission('checkout_create-work');
        $authManager->add($checkout_create_work);
        $authManager->addChild($user, $checkout_create_work);
        $authManager->addChild($admin, $checkout_create_work);

        $checkout_update_work  = $authManager->createPermission('checkout_update-work');
        $authManager->add($checkout_update_work);
        $authManager->addChild($user, $checkout_update_work);
        $authManager->addChild($admin, $checkout_update_work);

        $checkout_delete_work  = $authManager->createPermission('checkout_delete-work');
        $authManager->add($checkout_delete_work);
        $authManager->addChild($user, $checkout_delete_work);
        $authManager->addChild($admin, $checkout_delete_work);


        //checkout work competence
        $checkout_work_competence  = $authManager->createPermission('checkout_work-competence');
        $authManager->add($checkout_work_competence);
        $authManager->addChild($user, $checkout_work_competence);
        $authManager->addChild($admin, $checkout_work_competence);

        $checkout_create_work_competence  = $authManager->createPermission('checkout_create-work-competence');
        $authManager->add($checkout_create_work_competence);
        $authManager->addChild($user, $checkout_create_work_competence);
        $authManager->addChild($admin, $checkout_create_work_competence);

        $checkout_delete_work_competence  = $authManager->createPermission('checkout_delete-work-competence');
        $authManager->add($checkout_delete_work_competence);
        $authManager->addChild($user, $checkout_delete_work_competence);
        $authManager->addChild($admin, $checkout_delete_work_competence);


        //Checkout result
        $checkoutResult_setResultQuality  = $authManager->createPermission('checkout-result_set-result-quality');
        $authManager->add($checkoutResult_setResultQuality);
        $authManager->addChild($user, $checkoutResult_setResultQuality);
        $authManager->addChild($admin, $checkoutResult_setResultQuality);

        $checkoutResult_setControlResult  = $authManager->createPermission('checkout-result_set-control-result');
        $authManager->add($checkoutResult_setControlResult);
        $authManager->addChild($user, $checkoutResult_setControlResult);
        $authManager->addChild($admin, $checkoutResult_setControlResult);

        $checkoutResult_setAttestationResult  = $authManager->createPermission('checkout-result_set-attestation-result');
        $authManager->add($checkoutResult_setAttestationResult);
        $authManager->addChild($user, $checkoutResult_setAttestationResult);
        $authManager->addChild($admin, $checkoutResult_setAttestationResult);

        $checkoutResult_setVisitResult  = $authManager->createPermission('checkout-result_set-visit-result');
        $authManager->add($checkoutResult_setVisitResult);
        $authManager->addChild($user, $checkoutResult_setVisitResult);
        $authManager->addChild($admin, $checkoutResult_setVisitResult);

        $checkoutResult_setResult  = $authManager->createPermission('checkout-result_set-result');
        $authManager->add($checkoutResult_setResult);
        $authManager->addChild($user, $checkoutResult_setResult);
        $authManager->addChild($admin, $checkoutResult_setResult);


        //Visit
        $visit_index  = $authManager->createPermission('visit_index');
        $authManager->add($visit_index);
        $authManager->addChild($user, $visit_index);
        $authManager->addChild($admin, $visit_index);

        $visit_create  = $authManager->createPermission('visit_create');
        $authManager->add($visit_create);
        $authManager->addChild($user, $visit_create);
        $authManager->addChild($admin, $visit_create);

        $visit_update  = $authManager->createPermission('visit_update');
        $authManager->add($visit_update);
        $authManager->addChild($user, $visit_update);
        $authManager->addChild($admin, $visit_update);

        $visit_delete  = $authManager->createPermission('visit_delete');
        $authManager->add($visit_delete);
        $authManager->addChild($user, $visit_delete);
        $authManager->addChild($admin, $visit_delete);

        //Year
        $year_index  = $authManager->createPermission('year_index');
        $authManager->add($year_index);
        $authManager->addChild($admin, $year_index);

        $year_update  = $authManager->createPermission('year_update');
        $authManager->add($year_update);
        $authManager->addChild($admin, $year_update);

        $year_create  = $authManager->createPermission('year_create');
        $authManager->add($year_create);
        $authManager->addChild($admin, $year_create);

        $year_delete  = $authManager->createPermission('year_delete');
        $authManager->add($year_delete);
        $authManager->addChild($admin, $year_delete);

        // Сheckout form
        $checkoutForm_index  = $authManager->createPermission('checkout-form_index');
        $authManager->add($checkoutForm_index);
        $authManager->addChild($admin, $checkoutForm_index);

        $checkoutForm_update  = $authManager->createPermission('checkout-form_update');
        $authManager->add($checkoutForm_update);
        $authManager->addChild($admin, $checkoutForm_update);

        $checkoutForm_create  = $authManager->createPermission('checkout-form_create');
        $authManager->add($checkoutForm_create);
        $authManager->addChild($admin, $checkoutForm_create);

        $checkoutForm_delete  = $authManager->createPermission('checkout-form_delete');
        $authManager->add($checkoutForm_delete);
        $authManager->addChild($admin, $checkoutForm_delete);

        //Subject
        $subject_index  = $authManager->createPermission('subject_index');
        $authManager->add($subject_index);
        $authManager->addChild($admin, $subject_index);

        $subject_update  = $authManager->createPermission('subject_update');
        $authManager->add($subject_update);
        $authManager->addChild($admin, $subject_update);

        $subject_create  = $authManager->createPermission('subject_create');
        $authManager->add($subject_create);
        $authManager->addChild($admin, $subject_create);

        $subject_delete  = $authManager->createPermission('subject_delete');
        $authManager->add($subject_delete);
        $authManager->addChild($admin, $subject_delete);

        //attestation
        $attestation_index  = $authManager->createPermission('attestation_index');
        $authManager->add($attestation_index);
        $authManager->addChild($admin, $attestation_index);

        //Competence level
        $competenceLevel_index  = $authManager->createPermission('competence-level_index');
        $authManager->add($competenceLevel_index);
        $authManager->addChild($admin, $competenceLevel_index);

        $competenceLevel_update  = $authManager->createPermission('competence-level_update');
        $authManager->add($competenceLevel_update);
        $authManager->addChild($admin, $competenceLevel_update);

        $competenceLevel_create  = $authManager->createPermission('competence-level_create');
        $authManager->add($competenceLevel_create);
        $authManager->addChild($admin, $competenceLevel_create);

        $competenceLevel_delete  = $authManager->createPermission('competence-level_delete');
        $authManager->add($competenceLevel_delete);
        $authManager->addChild($admin, $competenceLevel_delete);

        //Group
        $group_index  = $authManager->createPermission('group_index');
        $authManager->add($group_index);
        $authManager->addChild($admin, $group_index);
        $authManager->addChild($user, $group_index);

        $group_update  = $authManager->createPermission('group_update');
        $authManager->add($group_update);
        $authManager->addChild($admin, $group_update);
        $authManager->addChild($user, $group_update);

        $group_create  = $authManager->createPermission('group_create');
        $authManager->add($group_create);
        $authManager->addChild($admin, $group_create);
        $authManager->addChild($user, $group_create);

        $group_delete  = $authManager->createPermission('group_delete');
        $authManager->add($group_delete);
        $authManager->addChild($admin, $group_delete);
        $authManager->addChild($user, $group_delete);

        //Student
        $student_index  = $authManager->createPermission('student_index');
        $authManager->add($student_index);
        $authManager->addChild($admin, $student_index);
        $authManager->addChild($user, $student_index);

        $student_update  = $authManager->createPermission('student_update');
        $authManager->add($student_update);
        $authManager->addChild($admin, $student_update);
        $authManager->addChild($user, $student_update);

        $student_create  = $authManager->createPermission('student_create');
        $authManager->add($student_create);
        $authManager->addChild($admin, $student_create);
        $authManager->addChild($user, $student_create);

        $student_delete  = $authManager->createPermission('student_delete');
        $authManager->add($student_delete);
        $authManager->addChild($admin, $student_delete);
        $authManager->addChild($user, $student_delete);


        //Report
        $report_index  = $authManager->createPermission('report_index');
        $authManager->add($report_index);
        $authManager->addChild($admin, $report_index);
        $authManager->addChild($user, $report_index);

        $report_result  = $authManager->createPermission('report_result');
        $authManager->add($report_result);
        $authManager->addChild($admin, $report_result);
        $authManager->addChild($user, $report_result);

        //Teacher
        $teacher_index  = $authManager->createPermission('teacher_index');
        $authManager->add($teacher_index);
        $authManager->addChild($admin, $teacher_index);

        $teacher_update  = $authManager->createPermission('teacher_update');
        $authManager->add($teacher_update);
        $authManager->addChild($admin, $teacher_update);

        $teacher_create  = $authManager->createPermission('teacher_create');
        $authManager->add($teacher_create);
        $authManager->addChild($admin, $teacher_create);

        $teacher_delete  = $authManager->createPermission('teacher_delete');
        $authManager->add($teacher_delete);
        $authManager->addChild($admin, $teacher_delete);

        $teacher_access  = $authManager->createPermission('teacher_access');
        $authManager->add($teacher_access);
        $authManager->addChild($admin, $teacher_access);

        $teacher_accessCreate  = $authManager->createPermission('teacher_access-create');
        $authManager->add($teacher_accessCreate);
        $authManager->addChild($admin, $teacher_accessCreate);

        $teacher_accessDelete  = $authManager->createPermission('teacher_access-delete');
        $authManager->add($teacher_accessDelete);
        $authManager->addChild($admin, $teacher_accessDelete);

        $teacher_group  = $authManager->createPermission('teacher-group');
        $authManager->add($teacher_group);
        $authManager->addChild($admin, $teacher_group);

        $teacher_groupCreate  = $authManager->createPermission('teacher_group-create');
        $authManager->add($teacher_groupCreate);
        $authManager->addChild($admin, $teacher_groupCreate);

        $teacher_groupDelete  = $authManager->createPermission('teacher_group-delete');
        $authManager->add($teacher_groupDelete);
        $authManager->addChild($admin, $teacher_groupDelete);

    }
}