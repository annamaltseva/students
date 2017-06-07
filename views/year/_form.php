<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Year */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $this->title = "Добавление года";
} else {
    $this->title = "Изменение года";
}
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена',['index'] ,['class' => 'btn btn-success']);?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>