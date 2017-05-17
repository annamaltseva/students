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

$this->title = "Количественная оценка";
echo $this->render('_header',[
    'model' => $model
]);
?>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <td><b>№</b></td>
        <td><b>Студент</b></td>
        <?php
            for ($i=1;$i<=$model->quantity;$i++)
            {
                echo '<td class="text-center"><b>'.$i.'</b></td>';
            }
        ?>
    </tr>
    <?php
    $i=1;
    foreach ($studentResults as $result)
    {
    ?>
    <tr>
         <td><?=$i?></td>
         <td><?=$result->name?></td>
        <?php
        for ($i=1;$i<=$model->quantity;$i++)
        {
            echo'<td class="text-center"><input type="text" size="1"></td>';
        }
        ?>

    </tr>
    <?php
        $i++;
     }
    ?>
</table>