<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Checkout;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $this->title = "Добавление балла";
} else {
    $this->title = "Изменение балла";
}
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'work_num')
            ->dropDownList(Checkout::getWorkNumbers($model->checkout_id), [
                'class'=>'form-control',
                'prompt' => 'Выберите номер работы ...'
            ]);
        ?>
        <?= $form->field($model, 'score')->textInput(['type' => 'number']) ?>
        <?php
        /*
        if ($model->control->rating_id ==1) {
            echo $form->field($model, 'score')->textInput(['type' => 'number']);
        }
        */
        ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>