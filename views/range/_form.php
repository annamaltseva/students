<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

if ($model->isNewRecord) {
    $this->title = "Добавление формы контроля";
} else {
    $this->title = "Изменение формы контроля";
}
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'rating')?>
        <?= $form->field($model, 'description')->textInput() ?>
        <?= $form->field($model, 'start_rating')->widget(\yii\widgets\MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias' =>  'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
            ]
        ]);?>
        <?= $form->field($model, 'end_rating')->widget(\yii\widgets\MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias' =>  'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'style' =>'text-align:left !important;'
                ]
            ]);?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>