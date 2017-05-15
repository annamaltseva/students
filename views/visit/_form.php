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
        <?= $form->field($model, 'year_attestation_id')
            ->dropDownList(ArrayHelper::map(YearAttestation::getAll(), 'id',
                function($modellist, $defaultValue) {
                    return $modellist["year"]["name"].'-'.$modellist["attestation"]["name"];
                }            ), [
                'class'=>'form-control',
                'prompt' => 'Выберите аттестацию...'
            ]);
        ?>
        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'language' => 'ru',
                'options'=>[
                    'class'=>'form-control',
                    'placeholder' => 'Начало встречи ...'
                ],
                'pluginOptions' => [
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true,
                    'autoclose'=>true
            ]
        ]) ?>
        <?= $form->field($model, 'group_id')
            ->dropDownList(ArrayHelper::map(Group::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите группу...'
            ]);
        ?>
        <?= $form->field($model, 'subject_id')
            ->dropDownList(ArrayHelper::map(Subject::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите предмет ...'
            ]);
        ?>
        <?= $form->field($model, 'rating')->textInput(['type' => 'number']) ?>
        <?= $form->field($model, 'description')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>