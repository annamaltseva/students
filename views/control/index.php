<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Контроль успешности обучения";
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create','control_id' => $control_id], ['class' => 'printBtn']) ?>
    </div>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:40px;']
        ],
        [
            'attribute' => 'year.name',
            'label' =>'Год'
        ],
        [
            'attribute' => 'group.name',
            'label' =>'Группа'
        ],
        [
            'attribute' => 'subject.name',
            'label' =>'Предмет'
        ],
        [
            'attribute' => 'goal.name',
            'label' =>'Цель'
        ],
        [
            'attribute' => 'rating.name',
            'label' =>'Метод оценки'
        ],
        [
            'attribute' => 'controlStatus.name',
            'label' =>'Статус'
        ],
        [
            'attribute' => 'user.name',
            'label' =>'Добавил'
        ],

        [
            'attribute' => 'created_at',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'contentOptions' => ['style' => 'width:50px;'],
            'label' =>'Добавлен'
        ],
        [
            'attribute' => 'updated_at',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'label' =>'Изменен',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {range} {attestation} {visit} {visit-rating} {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:50px;'],
            'buttons' => [
                'visit' => function ($url, $model) {
                    if ($model->rating_id==1) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-calendar"></span>',
                            Url::to([
                                '/visit/index',
                                'control_id' => $model->id
                            ]),                            [
                            'title' => 'Лекции',
                        ]);
                    } else {
                        return '';
                    }
                },
                'attestation' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-tasks"></span>',
                            Url::to([
                                '/control-attestation/index',
                                'control_id' => $model->id
                            ]),                            [
                            'title' => 'Аттестации',
                        ]);
                },

                'visit-rating' => function ($url, $model) {
                    if ($model->rating_id==1) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-star-empty"></span>',
                            Url::to([
                                'rating-visit',
                                'id' => $model->id
                            ]),                            [
                            'title' => 'Посещаемость',
                        ]);
                    } else {
                        return '';
                    }
                },
                'range' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-resize-horizontal"></span>',
                        Url::to([
                            '/range/index',
                            'control_id' => $model->id
                        ]), [
                        'title' => 'Диапазоны оценок',
                    ]);
                },
                'competence' => function ($url, $model) {
                    if ($model->rating_id==1) {
                        return '';
                    } else {

                        return Html::a(
                            '<span class="glyphicon glyphicon-th-list"></span>',
                            Url::to([
                                'competence',
                                'id' => $model->id
                            ]), [
                            'title' => 'Компетенции',
                        ]);
                    }
                },
            ]

        ]
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>
