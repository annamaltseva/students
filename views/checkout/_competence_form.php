<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $this->title = "Добавление компетенции";
} else {
    $this->title = "Изменение компетенции";
}
echo $this->render('_header',[
    'model' => $model
]);

?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelCompetence, 'name')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton($modelCompetence->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>