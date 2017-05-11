<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn  btn-success', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
