<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Лекции";
echo $this->render('@app/views/layouts/part/_control_header',[
    'model' => $model
]);
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create', 'control_id' => $control_id], ['class' => 'printBtn']) ?>
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
            'attribute' => 'date',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'label' =>'Дата'
        ],
        [
            'attribute' => 'rating',
            'label' =>'Балл'
        ],
        'description',
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
            'template' => '{update}  {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        Url::to([
                            'update',
                            'control_id' => $model->control_id,
                            'id' => $model->id,
                        ]),[
                        'title' => 'Update'
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::to([
                            'delete',
                            'id' => $model->id,
                            'control_id'=>$model->control_id
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
