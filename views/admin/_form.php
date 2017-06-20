<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Signup */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Изменение учетных данных";

?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'password')->passwordInput();?>


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>