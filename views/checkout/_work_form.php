<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CheckoutWork */
/* @var $form yii\widgets\ActiveForm */

if ($modelWork->isNewRecord) {
    $this->title = "Добавление работы";
} else {
    $this->title = "Изменение работы";
}
echo $this->render('_header',[
    'model' => $model
]);

?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelWork, 'name')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton($modelWork->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>