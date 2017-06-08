<?php
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = "Студенты";
?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Добавить', ['create','group_id' =>$groupID], ['class' => 'printBtn']) ?>
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
            'attribute' => 'group.name',
            'label' =>'Группа'
        ],
        'name',

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
            'template' => '{update} {delete}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;']
        ]
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>