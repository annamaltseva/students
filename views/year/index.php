<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Учебные годы";
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
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
        ]

        //['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>