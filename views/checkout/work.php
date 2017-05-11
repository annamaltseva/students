<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use app\models\Subject;
use app\models\Rating;
use app\models\CheckoutForm;
use app\models\YearAttestation;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Качественная оценка";
echo $this->render('_header',[
    'model' => $model
]);
?>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <td><b>№</b></td>
        <td><b>Студент</b></td>
        <td><b>Балл</b></td>
    </tr>
    <?php
    $i=1;
    foreach ($studentResults as $result)
    {
        ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$result->name?></td>
            <td><input type="text" size="5"></td>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>