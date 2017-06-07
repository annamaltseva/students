<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Баллы по умолчанию";
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К форме контроля', ['/checkout/index', 'control_attestation_id'=>$model->controlAttestation->id], ['class' => '']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12"><b>Форма контроля:</b> <?=$model->checkoutForm->name?> </div>
    <div class="col-md-6 col-sm-12"><b>Количество:</b> <b><?=$model->quantity?></b> шт.</div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create','checkout_id' => $checkout_id], ['class' => 'printBtn']) ?>
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
            'attribute' => 'work_num',
            'contentOptions' => ['class' => 'text-center'],
            'label' =>'№ работы'
        ],
        [
            'attribute' => 'score',
            'contentOptions' => ['class' => 'text-center'],
            'label' =>'Балл по умолчанию'
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
            'template' => '{update} {competence} {work} {range} {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
        ]
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>
