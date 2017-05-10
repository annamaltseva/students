<?php
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = "Группы студентов";
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create'], ['class' => 'printBtn']) ?>
    </div>
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
            'attribute' => 'user.username',
            'label' =>'Добавил'
        ],
        [
            'attribute' => 'created_at',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'contentOptions' => ['style' => 'width:100px;'],
            'label' =>'Добавлена'
        ],
        [
            'attribute' => 'updated_at',
            'format'    => [ 'date', 'php:d.m.Y' ],
            'label' =>'Изменена',
            'contentOptions' => ['style' => 'width:100px;']
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;']
        ]

    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>