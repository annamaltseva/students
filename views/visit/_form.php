<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use app\models\Subject;
use kartik\date\DatePicker;
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
        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'language' => 'ru',
                'options'=>[
                    'class'=>'form-control',
                    'placeholder' => ' Укажите дату лекции...'
                ],
                'pluginOptions' => [
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true,
                    'autoclose'=>true
            ]
        ]) ?>
        <?= $form->field($model, 'rating')->textInput(['type' => 'number']) ?>
        <?= $form->field($model, 'description')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>