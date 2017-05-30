<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Компетенции";
echo $this->render('_header_checkout',[
    'model' => $model
]);
?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Добавить', ['create-competence', 'id' => $model->id], ['class' => 'printBtn']) ?>
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
            'attribute' => 'user.name',
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
            'template' => '{update} {delete}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        Url::to([
                            'update-competence',
                            'id' => $model->checkout_id,
                            'competence_id'=>$model->id
                        ]), [
                        'title' => 'Изменить',
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::to([
                            'delete-competence',
                            'id' => $model->checkout_id,
                            'competence_id'=>$model->id
                        ]), [
                        'title' => 'Удалить',
                        'data-confirm'=>'Are you sure you want to delete this item?'
                    ]);
                },
            ]

        ]

    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>