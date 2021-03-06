<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use app\models\Subject;
use app\models\Rating;
use app\models\CheckoutForm;
use app\models\YearAttestation;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $this->title = "Добавление формы контроля";
} else {
    $this->title = "Изменение формы контроля";
}
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'checkout_form_id')
            ->dropDownList(ArrayHelper::map(CheckoutForm::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите тип формы контроля ...'
            ]);
        ?>
        <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>
        <?php
        /*
        if ($model->control->rating_id ==1) {
            echo $form->field($model, 'score')->textInput(['type' => 'number']);
        }
        */
        ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена',['index'] ,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>