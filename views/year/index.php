<?php
use yii\grid\GridView;
$this->title = "Учебные годы";
?>
<div class="col-md-12">
    <a href="" class="printBtn">Добавить</a>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        'name',

        //['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>