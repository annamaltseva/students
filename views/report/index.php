<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Year;
use app\models\Group;
use app\models\Subject;
use app\models\ReportForm;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Таблица успеваемости";
?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['result']),
        'options' => ['target' => '_blank']
    ]); ?>

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
    <?= $form->field($model, 'rating_id')
        ->dropDownList(ArrayHelper::map(ReportForm::getRating(), 'id', 'name'), [
            'class'=>'form-control',
            'prompt' => 'Выберите успеваемость ...'
        ]);
    ?>
    <?= $form->field($model, 'view_type')
        ->dropDownList(ArrayHelper::map(ReportForm::getView(), 'id', 'name'), [
            'class'=>'form-control',
            'prompt' => 'Формат'
        ]);
    ?>
    <?php
    echo Html::submitButton('Открыть отчет', [
        'class' => 'btn btn-success',
        'id' => 'btn_report',
    ]);
    ?>

    <?php ActiveForm::end(); ?>
    </div>
</div>