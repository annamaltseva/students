<?php
return [
    'site_login' => [
        'type' => 2,
    ],
    'site_logout' => [
        'type' => 2,
    ],
    'site_index' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'site_login',
            'site_logout',
            'site_index',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'site_login',
            'site_logout',
            'site_index',
            'control_index',
            'control_create',
            'control_update',
            'control_delete',
            'control_rating-quality',
            'control_generate-report',
            'control_generate-quality-report',
            'range_index',
            'range_create',
            'range_update',
            'range_delete',
            'control-attestation_index',
            'control-attestation_create',
            'control-attestation_update',
            'control-attestation_delete',
            'control-attestation_rating',
            'control-attestation_rating-visit',
            'control-attestation_rating-quality',
            'checkout_index',
            'checkout_create',
            'checkout_update',
            'checkout_delete',
            'checkout-rating_index',
            'checkout-rating_create',
            'checkout-rating_update',
            'checkout-rating_delete',
            'checkout_competence',
            'checkout_create-competence',
            'checkout_update-competence',
            'checkout_delete-competence',
            'checkout_work',
            'checkout_create-work',
            'checkout_update-work',
            'checkout_delete-work',
            'checkout_work-competence',
            'checkout_create-work-competence',
            'checkout_delete-work-competence',
            'checkout-result_set-result-quality',
            'checkout-result_set-control-result',
            'checkout-result_set-attestation-result',
            'checkout-result_set-visit-result',
            'checkout-result_set-result',
            'visit_index',
            'visit_create',
            'visit_update',
            'visit_delete',
            'group_index',
            'group_update',
            'group_create',
            'group_delete',
            'student_index',
            'student_update',
            'student_create',
            'student_delete',
            'report_index',
            'report_result',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'control_index',
            'control_create',
            'control_update',
            'control_delete',
            'control_generate-report',
            'control_generate-quality-report',
            'range_index',
            'range_create',
            'range_update',
            'range_delete',
            'control-attestation_index',
            'control-attestation_create',
            'control-attestation_update',
            'control-attestation_delete',
            'control-attestation_rating',
            'control-attestation_rating-visit',
            'control-attestation_rating-quality',
            'checkout_index',
            'checkout_create',
            'checkout_update',
            'checkout_delete',
            'checkout-rating_index',
            'checkout-rating_create',
            'checkout-rating_update',
            'checkout-rating_delete',
            'checkout_competence',
            'checkout_create-competence',
            'checkout_update-competence',
            'checkout_delete-competence',
            'checkout_work',
            'checkout_create-work',
            'checkout_update-work',
            'checkout_delete-work',
            'checkout_work-competence',
            'checkout_create-work-competence',
            'checkout_delete-work-competence',
            'checkout-result_set-result-quality',
            'checkout-result_set-control-result',
            'checkout-result_set-attestation-result',
            'checkout-result_set-visit-result',
            'checkout-result_set-result',
            'visit_index',
            'visit_create',
            'visit_update',
            'visit_delete',
            'year_index',
            'year_update',
            'year_create',
            'year_delete',
            'checkout-form_index',
            'checkout-form_update',
            'checkout-form_create',
            'checkout-form_delete',
            'subject_index',
            'subject_update',
            'subject_create',
            'subject_delete',
            'attestation_index',
            'competence-level_index',
            'competence-level_update',
            'competence-level_create',
            'competence-level_delete',
            'group_index',
            'group_update',
            'group_create',
            'group_delete',
            'student_index',
            'student_update',
            'student_create',
            'student_delete',
            'report_index',
            'report_result',
            'teacher_index',
            'teacher_update',
            'teacher_create',
            'teacher_delete',
            'teacher_access',
            'teacher_access-create',
            'teacher_access-delete',
            'teacher-group',
            'teacher_group-create',
            'teacher_group-delete',
            'teacher_password',
            'admin_index',
            'admin_password',
        ],
    ],
    'control_index' => [
        'type' => 2,
    ],
    'control_create' => [
        'type' => 2,
    ],
    'control_update' => [
        'type' => 2,
    ],
    'control_delete' => [
        'type' => 2,
    ],
    'control_rating-quality' => [
        'type' => 2,
    ],
    'control_generate-report' => [
        'type' => 2,
    ],
    'control_generate-quality-report' => [
        'type' => 2,
    ],
    'range_index' => [
        'type' => 2,
    ],
    'range_create' => [
        'type' => 2,
    ],
    'range_update' => [
        'type' => 2,
    ],
    'range_delete' => [
        'type' => 2,
    ],
    'control-attestation_index' => [
        'type' => 2,
    ],
    'control-attestation_create' => [
        'type' => 2,
    ],
    'control-attestation_update' => [
        'type' => 2,
    ],
    'control-attestation_delete' => [
        'type' => 2,
    ],
    'control-attestation_rating' => [
        'type' => 2,
    ],
    'control-attestation_rating-visit' => [
        'type' => 2,
    ],
    'control-attestation_rating-quality' => [
        'type' => 2,
    ],
    'checkout_index' => [
        'type' => 2,
    ],
    'checkout_create' => [
        'type' => 2,
    ],
    'checkout_update' => [
        'type' => 2,
    ],
    'checkout_delete' => [
        'type' => 2,
    ],
    'checkout-rating_index' => [
        'type' => 2,
    ],
    'checkout-rating_create' => [
        'type' => 2,
    ],
    'checkout-rating_update' => [
        'type' => 2,
    ],
    'checkout-rating_delete' => [
        'type' => 2,
    ],
    'checkout_competence' => [
        'type' => 2,
    ],
    'checkout_create-competence' => [
        'type' => 2,
    ],
    'checkout_update-competence' => [
        'type' => 2,
    ],
    'checkout_delete-competence' => [
        'type' => 2,
    ],
    'checkout_work' => [
        'type' => 2,
    ],
    'checkout_create-work' => [
        'type' => 2,
    ],
    'checkout_update-work' => [
        'type' => 2,
    ],
    'checkout_delete-work' => [
        'type' => 2,
    ],
    'checkout_work-competence' => [
        'type' => 2,
    ],
    'checkout_create-work-competence' => [
        'type' => 2,
    ],
    'checkout_delete-work-competence' => [
        'type' => 2,
    ],
    'checkout-result_set-result-quality' => [
        'type' => 2,
    ],
    'checkout-result_set-control-result' => [
        'type' => 2,
    ],
    'checkout-result_set-attestation-result' => [
        'type' => 2,
    ],
    'checkout-result_set-visit-result' => [
        'type' => 2,
    ],
    'checkout-result_set-result' => [
        'type' => 2,
    ],
    'visit_index' => [
        'type' => 2,
    ],
    'visit_create' => [
        'type' => 2,
    ],
    'visit_update' => [
        'type' => 2,
    ],
    'visit_delete' => [
        'type' => 2,
    ],
    'year_index' => [
        'type' => 2,
    ],
    'year_update' => [
        'type' => 2,
    ],
    'year_create' => [
        'type' => 2,
    ],
    'year_delete' => [
        'type' => 2,
    ],
    'checkout-form_index' => [
        'type' => 2,
    ],
    'checkout-form_update' => [
        'type' => 2,
    ],
    'checkout-form_create' => [
        'type' => 2,
    ],
    'checkout-form_delete' => [
        'type' => 2,
    ],
    'subject_index' => [
        'type' => 2,
    ],
    'subject_update' => [
        'type' => 2,
    ],
    'subject_create' => [
        'type' => 2,
    ],
    'subject_delete' => [
        'type' => 2,
    ],
    'attestation_index' => [
        'type' => 2,
    ],
    'competence-level_index' => [
        'type' => 2,
    ],
    'competence-level_update' => [
        'type' => 2,
    ],
    'competence-level_create' => [
        'type' => 2,
    ],
    'competence-level_delete' => [
        'type' => 2,
    ],
    'group_index' => [
        'type' => 2,
    ],
    'group_update' => [
        'type' => 2,
    ],
    'group_create' => [
        'type' => 2,
    ],
    'group_delete' => [
        'type' => 2,
    ],
    'student_index' => [
        'type' => 2,
    ],
    'student_update' => [
        'type' => 2,
    ],
    'student_create' => [
        'type' => 2,
    ],
    'student_delete' => [
        'type' => 2,
    ],
    'report_index' => [
        'type' => 2,
    ],
    'report_result' => [
        'type' => 2,
    ],
    'teacher_index' => [
        'type' => 2,
    ],
    'teacher_update' => [
        'type' => 2,
    ],
    'teacher_create' => [
        'type' => 2,
    ],
    'teacher_delete' => [
        'type' => 2,
    ],
    'teacher_access' => [
        'type' => 2,
    ],
    'teacher_access-create' => [
        'type' => 2,
    ],
    'teacher_access-delete' => [
        'type' => 2,
    ],
    'teacher-group' => [
        'type' => 2,
    ],
    'teacher_group-create' => [
        'type' => 2,
    ],
    'teacher_group-delete' => [
        'type' => 2,
    ],
    'teacher_password' => [
        'type' => 2,
    ],
    'admin_index' => [
        'type' => 2,
    ],
    'admin_password' => [
        'type' => 2,
    ],
];
