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
            'template' => '{update} {rating} {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'rating' => function ($url, $model) {
                    $action = ($model->rating_id==1)? 'rating': 'work';
                    return Html::a(
                        '<span class="glyphicon glyphicon-list-alt"></span>',
                        Url::to([
                            $action,
                            'id' => $model->id
                        ]),                            [
                        'title' => 'Баллы',
                    ]);
                },
            ]

        ]
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>
