<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="logo__img" src="/images/logo.png"  widht="250px" alt="Политехнический университет Петра Великого">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    ?>
    <div style="width:200px;border:0px solid red;float:left;">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Справочники',
                'items' => [
                    ['label' => 'Учебные года', 'url' => ['/year/index']],
                    ['label' => 'Типы формы контроля', 'url' => ['/checkout-form/index']],
                    ['label' => 'Предметы', 'url' => ['/subject/index']],
                    ['label' => 'Аттестации', 'url' => ['/attestation/index']],
                    ['label' => 'Методы оценки', 'url' => ['/rating/index']],
                    ['label' => 'Уровни компетенции', 'url' => ['/competence-level/index']],
                ],
            ],
            [
                'label' => 'Студенты',
                'items' => [
                    ['label' => 'Группы', 'url' => ['/group/index']],
                    ['label' => 'Студенты', 'url' => ['/student/index']],
                ],
            ],
            [
                'label' => 'Оценивание',
                'items' => [
                    ['label' => 'Аттестации по годам', 'url' => ['/year-attestation/index']],
                    ['label' => 'Формы контроля', 'url' => ['/checkout/index']],
                ],
            ],
            ['label' => 'Преподаватели', 'url' => ['/teacher/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container"  style="margin-top:60px">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
