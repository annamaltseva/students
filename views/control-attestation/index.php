<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Аттестации по контролю";
echo $this->render('@app/views/layouts/part/_control_header',[
    'model' => $model
]);
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create','control_id' => $control_id], ['class' => 'printBtn']) ?>
    </div>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width:40px;']
        ],
        [
            'attribute' => 'attestation.name',
            'label' =>'Аттестация'
        ],
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
            'template' => '{update} {control-form} {rating} {visit} {visit-rating} {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:120px;'],
            'buttons' => [
                'control-form' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-align-justify"></span>',
                        Url::to([
                            '/checkout/index',
                            'control_attestation_id' => $model->id
                        ]), [
                        'title' => 'Формы контроля',
                    ]);
                },
                'rating' => function ($url, $model) {
                    $action = ($model->control->rating_id==1)? 'rating': 'rating-quality';
                    return Html::a(
                        '<span class="glyphicon glyphicon-star"></span>',
                        Url::to([
                            $action,
                            'id' => $model->id
                        ]),                            [
                        'title' => 'Оценивание',
                    ]);
                },
                'visit' => function ($url, $model) {
                    if ($model->control->rating_id == 1) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-calendar"></span>',
                            Url::to([
                                '/visit/index',
                                'control_attestation_id' => $model->id
                            ]),                            [
                            'title' => 'Лекции',
                        ]);
                    } else {
                        return '';
                    }
                },
                'visit-rating' => function ($url, $model) {
                    if ($model->control->rating_id == 1) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-star-empty"></span>',
                            Url::to([
                                'rating-visit',
                                'id' => $model->id
                            ]),                            [
                            'title' => 'Посещаемость',
                        ]);
                    } else {
                        return '';
                    }
                },


            ]

        ]
    ],
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-hover'
    ]
]); ?>
