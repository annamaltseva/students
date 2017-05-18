<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;
use app\models\Subject;
use app\models\Rating;
use app\models\CheckoutForm;
use app\models\YearAttestation;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Журнал посещений";

echo $this->render('@app/views/layouts/part/_control_header',[
    'model' => $model
]);
?>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <td width="50px"><b>№</b></td>
        <td width="200px"><b>Студент</b></td>
        <?php
        foreach ($visits as $visit) {
            ?>
            <td  class="text-center"><?=Yii::$app->formatter->asDate($visit->date, "php:d.m.Y");?> <b>(<?=$visit->rating?>)</b></td>
        <?php
        }
        ?>
        <td  class="text-center"><b>Итого</b></td>
    </tr>
    <?php
    $i=1;
    foreach ($students as $student)
    {
        ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$student->name?></td>
            <?php
            $sumRow=0;
            foreach ($visits as $visit) {

                    //echo'<td class="text-center"><input type="text" size="1" name="res_'.$result->id.'_'.$checkout->id.'_'.$i.'"></td>';
                    echo '<td class="text-center">';
                    $val = false;

                    if (isset($results[$student->id][$visit->id])) {
                        $val =true;
                        $sumRow+=$results[$student->id][$visit->id];
                    }

                    echo Html::checkbox(
                    //echo MaskedInput::widget([
                        'res_'.$student->id.'_'.$visit->id,
                        $val,
                         [
                            'class' =>'field-result',
                            'data-value' =>$visit->rating,
                            'onchange'=>'
                                  $.post("index.php?r=checkout-result/set-visit-result&student_id='.$student->id.'&visit_id='.$visit->id.'&result="+$(this).prop("checked")+"",
                                  function(data){
                                     if (data!="") alert (data);
                                     sum_row =0;
                                     row=$("input[name^=res_'.$student->id.']");
                                     for (i=0;i<row.length;i++) {
                                        if (row[i].checked){
                                            sum_row = sum_row + eval(row[i].getAttribute("data-value"))
                                        }
                                     }
                                     $("#rs_'.$student->id.'").html(sum_row);
                                   })
                                   .fail(function() {
                                      alert( "error" );
                                   })
                                ;'

                        ]
                    );
                    echo '</td>';
                }
            ?>
            <td class="text-center"><span id="rs_<?=$student->id?>"><?=$sumRow?></span></td>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>