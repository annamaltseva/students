<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Предметы";
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        'name',
        [
            'attribute' => 'rating',
            'contentOptions' => [
                'class' => 'text-center',
                'style' => 'width:100px;'
            ],
            'label' =>'Балл за посещение'
        ],
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