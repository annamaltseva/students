<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $this->title = "Добавление студента";
} else {
    $this->title = "Изменение студента";
}
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'group_id')
        ->dropDownList(ArrayHelper::map(Group::getAll(), 'id', 'name'), [
            'class'=>'form-control',
            'prompt' => 'Выберите группу ...'
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
        <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена',['index'] ,['class' => 'btn btn-success']);?>

    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>