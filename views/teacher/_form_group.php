<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Добавление доступа";
?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'group_id')
            ->dropDownList(ArrayHelper::map(Group::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите группу ...'
            ]);
        ?>


        <div class="form-group">
            <?= Html::submitButton('Добавить' , ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>