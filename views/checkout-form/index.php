<?php
use yii\grid\GridView;
$this->title = "Формы контроля";
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:50px;']
        ],
        'name',

    ],
]); ?>