<?php
use yii\helpers\Html;
?>
<div class="row text-right">
    <div class="col-md-12">
        <?= Html::a('К формам контроля ', ['index'], ['class' => '']) ?>
    </div>
</div>
<div class="row" style="margin-bottom: 20px">
    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Контроль:</b></div><div class="col-md-3 col-sm-9"><?=$model->checkoutForm->name?> - <?=$model->quantity?> шт.</div>
</div>
