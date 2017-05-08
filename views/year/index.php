<?php
use yii\grid\GridView;
$this->title = "Учебные года";
?>
<div class="col-md-12">
    <a href="" class="printBtn">Добавить</a>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

        //'id',
        'name',

        //['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>