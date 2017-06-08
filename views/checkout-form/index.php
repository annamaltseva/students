<?php
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = "Типы форм контроля";
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create'], ['class' => 'printBtn']) ?>
    </div>
</div><?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;']
        ]

    ],

]); ?>