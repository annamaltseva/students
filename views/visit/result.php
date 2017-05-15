<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Количественная оценка";
?>
<div class="row text-right">
    <div class="col-md-12">
        <?= Html::a('К посещаемости ', ['index'], ['class' => '']) ?>
    </div>
</div>
<div class="row" style="margin-bottom: 20px">
    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Дата:</b></div><div class="col-md-3 col-sm-9"><?=$model->date?> - <?=$model->attestation->name?></div>
</div>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <td><b>№</b></td>
        <td><b>Студент</b></td>
        <td><b>Присутствие</b></td>
    </tr>
    <?php
    $i=1;
    foreach ($studentResults as $result)
    {
        ?>
        <tr>
            <td width="5%"><?=$i?></td>
            <td><?=$result->name?></td>
            <td width="5%" class="text-center"><input type="checkbox" ></td>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>