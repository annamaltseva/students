<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Attestation;
use app\models\Rating;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $this->title = "Добавление аттестации";
} else {
    $this->title = "Изменение аттестации";
}
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'attestation_id')
            ->dropDownList(ArrayHelper::map(Attestation::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите аттестацию ...'
            ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>