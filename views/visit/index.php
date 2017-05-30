<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Лекции";
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К аттестациям ', ['control-attestation/index', 'control_id'=>$model->control->id], ['class' => '']) ?>
    </div>
</div>
<div class="row" style="margin-bottom: 10px;">

    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->control->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->control->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Аттестация:</b></div><div class="col-md-3 col-sm-9"><?=$model->attestation->name?></div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create', 'control_attestation_id' => $control_attestation_id], ['class' => 'printBtn']) ?>
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
            'attribute' => 'controlAttestation.control.subject.rating',
            'label' =>'Балл за посещение',
            'contentOptions' => ['style' => 'width:50px;', 'class'=>'text-center']
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
                            'control_attestation_id' => $model->control_attestation_id,
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
                            'control_attestation_id'=>$model->control_attestation_id
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
