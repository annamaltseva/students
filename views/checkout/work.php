<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Работы";
echo $this->render('_header',[
    'model' => $model
]);
?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Добавить', ['create-work', 'id' => $model->id], ['class' => 'printBtn']) ?>
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
            'label' =>'Добавил',
            'contentOptions' => ['style' => 'width:180px;']
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
            'template' => '{update} {competence} {rating} {delete}',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        Url::to([
                            'update-work',
                            'id' => $model->checkout_id,
                            'work_id'=>$model->id
                        ]), [
                        'title' => 'Изменить',
                    ]);
                },
                'competence' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-th-list"></span>',
                        Url::to([
                            'work-competence',
                            'id' => $model->checkout_id,
                            'work_id'=>$model->id
                        ]), [
                        'title' => 'Компетенции по работе',
                    ]);
                },
                'rating' => function ($url, $model) {
                    return Html::a(
                       '<span class="glyphicon glyphicon-star"></span>',
                       Url::to([
                            'rating-quality',
                           'id' => $model->checkout_id,
                           'work_id'=>$model->id
                       ]), [
                       'title' => 'Уровни',
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        Url::to([
                            'delete-work',
                            'id' => $model->checkout_id,
                            'work_id'=>$model->id
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