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
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К аттестациям ', ['/control-attestation/index', 'control_id'=>$model->control_id], ['class' => '']) ?>
    </div>
</div>
<div class="row" style="margin-bottom: 10px;">

    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->control->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->control->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Аттестация:</b></div><div class="col-md-3 col-sm-9"><?=$model->attestation->name?></div>
</div>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <td width="50px"><b>№</b></td>
        <td width="200px"><b>Студент</b></td>
        <?php
        foreach ($visits as $visit) {
            ?>
            <td  class="text-center"><?=Yii::$app->formatter->asDate($visit->date, "php:d.m.Y");?> <b>(<?=$visit->controlAttestation->control->subject->rating?>)</b></td>
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
                $val = '';

                if (isset($results[$student->id][$visit->id])) {
                    $val =$results[$student->id][$visit->id];
                    $sumRow+=$results[$student->id][$visit->id];
                }
/*
                echo Html::checkbox(
                //echo MaskedInput::widget([
                    'res_'.$student->id.'_'.$visit->id,
                    $val,
                    [
                        'class' =>'field-result',
                        'data-value' =>$visit->controlAttestation->control->subject->rating,
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
*/
                echo MaskedInput::widget([
                    'name' => 'res_'.$student->id.'_'.$visit->id,
                    'id' =>  'res_'.$student->id.'_'.$visit->id,
                    'value' => $val,
                    'options' => [
                        'class' => 'field-result',
                        'onchange' => '
                                  $.post("index.php?r=checkout-result/set-visit-result&student_id='.$student->id.'&visit_id='.$visit->id.'&result="+$(this).val()+"",
                                  function(data){
                                     if (data!="") alert (data);
                                     sum_row =0;
                                     row=$("input[name^=res_'.$student->id.']");
                                     for (i=0;i<row.length;i++) {
                                        if (row[i].value!="") {
                                            sum_row = sum_row + eval(row[i].value)
                                        }
                                     }
                                     $("#rs_'.$student->id.'").html(sum_row);
                                   })
                                   .fail(function() {
                                      alert( "error" );
                                   })
                                ;',

                        'onclick' =>'
                        if ($(this).val()=="") {
                            $(this).val('.$visit->controlAttestation->control->subject->rating.');
                            if ('.$visit->controlAttestation->control->subject->rating.'!=0) { $(this).change();}
                        }
                    '
                    ],
                    'clientOptions' => [
                        'alias' => 'decimal',
                    ],
                ]);

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