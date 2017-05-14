<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\CheckoutCompetence;
$this->title = "Добавление компетенции";
?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelWork, 'checkout_competence_id')
            ->dropDownList(ArrayHelper::map(CheckoutCompetence::getAll($model->checkout_id), 'id', 'name'), [
                'class'=>'form-control',
                'prompt' => 'Выберите компетенцию ...'
            ]);
        ?>

        <div class="form-group">
            <?= Html::submitButton($modelWork->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
            <?= Html::a( '<span class="glyphicon glyphicon-ban-circle"></span> Отмена', Yii::$app->request->referrer,['class' => 'btn btn-success']);?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>