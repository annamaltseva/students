<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use yii\helpers\Url;
$this->title = "Формы контроля";
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create'], ['class' => 'printBtn']) ?>
    </div>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        [
            'attribute' => 'year.name',
            'label' =>'Год'
        ],
        [
            'attribute' => 'attestation.name',
            'label' =>'Аттестация'
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
            'attribute' => 'rating.name',
            'label' =>'Метод оценки'
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
            'template' => '{update} {competence} {work} {rating} {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'rating' => function ($url, $model) {
                    $action = ($model->rating_id==1)? 'rating': 'rating-quality';
                    if ($model->rating_id==1) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-star"></span>',
                            Url::to([
                                'rating',
                                'id' => $model->id
                            ]),                            [
                            'title' => 'Баллы',
                        ]);
                    } else {
                        return '';
                    }

                },
                'work' => function ($url, $model) {
                    if ($model->rating_id==1) {
                        return '';
                    } else {

                        return Html::a(
                            '<span class="glyphicon glyphicon-align-justify"></span>',
                            Url::to([
                                'work',
                                'id' => $model->id
                            ]), [
                            'title' => 'Работы',
                        ]);
                    }
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
