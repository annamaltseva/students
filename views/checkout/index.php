<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Формы контроля";
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К аттестациям ', ['/control-attestation/index', 'control_id'=>$model->id], ['class' => '']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Аттестация:</b></div><div class="col-md-3 col-sm-9"><?=$attestation->name?></div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= Html::a('Добавить', ['create','control_attestation_id' => $control_attestation_id], ['class' => 'printBtn']) ?>
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
            'attribute' => 'checkoutForm.name',
            'label' =>'Тип'
        ],
        [
            'attribute' => 'quantity',
            'contentOptions' => ['class' => 'text-center'],
            'label' =>'Кол'
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
            'template' => '{update} {competence} {work} {range} {delete} ',
            'header' => 'Действия',
            'contentOptions' => ['style' => 'width:100px;'],
            'buttons' => [
                'rating' => function ($url, $model) {
                    if ($model->controlAttestation->control->rating_id==1) {

                        return Html::a(
                            '<span class="glyphicon glyphicon-star"></span>',
                            Url::to([
                                'rating',
                                'id' => $model->id
                            ]),                            [
                            'title' => 'Баллы',
                        ]);

                    } else {
                        return '';
                    }

                },
                'work' => function ($url, $model) {

                    if ($model->controlAttestation->control->rating_id==1) {
                        return '';
                    } else {
                        return Html::a(
                            '<span class="glyphicon glyphicon-align-justify"></span>',
                            Url::to([
                                'work',
                                'id' => $model->id
                            ]), [
                            'title' => 'Работы',
                        ]);
                    }
                },
                'competence' => function ($url, $model) {

                    if ($model->controlAttestation->control->rating_id==1) {
                        return '';
                    } else {
                        return Html::a(
                            '<span class="glyphicon glyphicon-th-list"></span>',
                            Url::to([
                                'competence',
                                'id' => $model->id
                            ]), [
                            'title' => 'Компетенции',
                        ]);
                    }
                },
                'range' => function ($url, $model) {
                    if ($model->controlAttestation->control->rating_id==1) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pushpin"></span>',
                            Url::to([
                                '/checkout-rating/index',
                                'checkout_id' => $model->id
                            ]), [
                            'title' => 'Баллы по умолчанию',
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
