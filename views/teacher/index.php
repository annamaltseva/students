<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use yii\helpers\Url;
$this->title = "Преподаватели";
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
            'username',
            'name',
            'email',
            [
                'label' => 'Статус',
                'value' => function ($model) {
                    return User::getUserStatus($model->status);
                },
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
                'template' => '{update} {password} {access} {group} {delete} ',
                'header' => 'Действия',
                'contentOptions' => ['style' => 'width:100px;'],
                'buttons' => [
                    'password' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-wrench"></span>',
                            Url::to([
                                'password',
                                'id' => $model->id
                            ]),                            [
                             'title' => 'Password',
                        ]);
                    },
                    'access' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-book"></span>',
                            Url::to([
                                'access',
                                'id' => $model->id
                            ]),                            [
                            'title' => 'Доступ к предметам',
                        ]);
                    },
                    'group' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-user"></span>',
                            Url::to([
                                'group',
                                'id' => $model->id
                            ]),                            [
                            'title' => 'Доступ к группам',
                        ]);
                    },
                ]
            ]
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover'
        ]
    ]); ?>
