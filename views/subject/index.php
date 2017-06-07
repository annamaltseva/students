<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Предметы";
?>
<div class="col-md-12">
    <?= Html::a('Добавить', ['create'], ['class' => 'printBtn']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        'id',
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:80px;']
    ]
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>