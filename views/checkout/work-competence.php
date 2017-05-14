<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Компетенции по работе";
?>
    <div class="row">
        <div class="col-md-6">
            <?= Html::a('К работам', ['checkout/work', 'id' => $model->checkout_id ], ['class' => '']) ?>
        </div>
        <div class="col-md-6">
            <?= Html::a('Добавить', ['create-work-competence', 'id' => $model->checkout_id, 'work_id' =>$model->id], ['class' => 'printBtn']) ?>
        </div>
    </div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        'checkoutCompetence.name',

        [
            'attribute' => 'user.name',
            'label' =>'Добавил',
            'contentOptions' => ['style' => 'width:180px;']
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
            'template' => ' {delete}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::to([
                            'delete-work-competence',
                            'checkout_id' => $model->checkoutCompetence->checkout_id,
                            'work_id' => $model->checkout_work_id,
                            'id'=>$model->id
                        ]), [
                        'title' => 'Удалить',
                        'data-confirm'=>'Are you sure you want to delete this item?'
                    ]);
                },
            ]

        ]

    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>