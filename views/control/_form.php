<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use app\models\Subject;
use app\models\Goal;
use app\models\Year;
use yii\helpers\ArrayHelper;
use app\models\Rating;

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
        <?= $form->field($model, 'year_id')
            ->dropDownList(ArrayHelper::map(Year::getAll(), 'id','name'  ), [
                'class'=>'form-control',
                'prompt' => 'Выберите год...'
            ]);
        ?>
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
        <?= $form->field($model, 'goal_id')
            ->dropDownList(ArrayHelper::map(Goal::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите цель ...'
            ]);
        ?>
        <?= $form->field($model, 'rating_id')
            ->dropDownList(ArrayHelper::map(Rating::getAll(), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите метод оценки ...'
            ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена',['index'] ,['class' => 'btn btn-success']);?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>