<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Группы студентов";
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
        'name',

        [
            'attribute' => 'user.name',
            'label' =>'Добавил'
        ],
        [
            'attribute' => 'created_at',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'contentOptions' => ['style' => 'width:100px;'],
            'label' =>'Добавлена'
        ],
        [
            'attribute' => 'updated_at',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'label' =>'Изменена',
            'contentOptions' => ['style' => 'width:100px;']
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{group} {update} {delete}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' =>[
                'group' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-user"></span>',
                        Url::to([
                            '/student/index',
                            'group_id' => $model->id
                        ]),                            [
                        'title' => 'Студенты',
                    ]);
                }

            ]
        ]


    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>