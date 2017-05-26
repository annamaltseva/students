<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Доступ к группам";
?>
<div class="row">
    <div class="col-md-6">
        <?=$model->name?>
    </div>
    <div class="col-md-6">
        <?= Html::a('Добавить', ['group-create', 'id' => $model->id], ['class' => 'printBtn']) ?>
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
            'attribute' => 'group.name',
            'label' =>'Группа'
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
            'template' => '{delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'delete' => function ($url, $modelgroup) use ($model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::to([
                            'group-delete',
                            'id' => $model->id,
                            'group_id'=>$modelgroup->id
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
