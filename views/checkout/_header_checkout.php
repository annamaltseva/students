<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К формам контроля ', ['/checkout/index', 'control_attestation_id'=>$model->controlAttestation->id], ['class' => '']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2 col-sm-6"><b>Форма контроля:</b></div><div class="col-md-3 col-sm-6"><?=$model->checkoutForm->name?> - <?=$model->quantity?> шт</div>
</div>
