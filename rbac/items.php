<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'login',
            'logout',
            'index',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'login',
            'logout',
            'index',
            'control_index',
            'control_create',
            'control_update',
            'control_delete',
            'control_rating-quality',
            'control_rating',
            'range_index',
            'range_create',
            'range_update',
            'range_delete',
            'checkout_index',
            'checkout_create',
            'checkout_update',
            'checkout_delete',
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
            'visit_index',
            'visit_create',
            'visit_update',
            'visit_delete',
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
    'control_rating' => [
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
];
