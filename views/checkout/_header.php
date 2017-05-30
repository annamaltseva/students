<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К аттестациям ', ['/control-attestation/index', 'control_id'=>$model->id], ['class' => '']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Аттестация:</b></div><div class="col-md-3 col-sm-9"><?=$attestation->name?></div>
</div>
