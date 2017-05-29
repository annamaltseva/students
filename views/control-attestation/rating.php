<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

$this->title = "Количественная оценка";

$strJS =' var range=[];';
$i=0;
foreach ($ranges as $range) {
    $strJS.= 'range['.$i.'] ={id:"'.$range->id.'",start_rating:"'.$range->start_rating.'",end_rating:"'.$range->end_rating.'" };';
    $i++;
}
$strJS.='function getRageID(score) {
                for (i=0; i < range.length;i++){
                    if (eval(score) >= eval(range[i]["start_rating"]) && eval(score) <= eval(range[i]["end_rating"])){
                        return range[i]["id"];
                    }
                }
                return \'\';
            }
    ';
$this->registerJs($strJS,View::POS_HEAD);
?>
<div class="row">
    <div class="col-md-12 text-right">
        <?= Html::a('К аттестациям ', ['index', 'control_id'=>$attestation->control_id], ['class' => '']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->group->name?></div>
    <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->subject->name?></div>
    <div class="col-md-1 col-sm-3"><b>Аттестация:</b></div><div class="col-md-3 col-sm-9"><?=$attestation->attestation->name?></div>
</div>
    <table class="table table-striped table-hover table-bordered" id="example">
        <thead>
        <tr>
            <td rowspan="2" ><b>№</b></td>
            <td rowspan="2" ><b>Студент</b></td>
            <?php
            if ($attestation->attestation_id==2) {
            echo '<td rowspan="2" class="text-center" ><b>Баллы<br>первая аттестация</b></td>';
             }
            foreach ($checkouts as $checkout) {
                ?>
                <td colspan="<?=$checkout->quantity?>" class="text-center">
                    <?=$checkout->checkoutForm->name?> - <b><?=$checkout->quantity?> </b>шт.
                    <br>
                    <?php
                    if ($checkout->score) {
                        echo 'Балл по умолчанию: <b>'.$checkout->score.'</b>';
                    }
                    ?>
                </td>
            <?php
            }
            ?>
            <td rowspan="2" class="text-center"><b>Посещ.</b></td>
            <td rowspan="2" class="text-center"><b>Итого</b></td>
            <?php
            if ($attestation->attestation_id==2) {
                ?>
                <td rowspan="2" class="text-center"><b><?= $model->goal->name ?></b></td>
            <?php
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach ($checkouts as $checkout) {
                for ($i=1;$i<=$checkout->quantity;$i++)
                {
                    echo '<td class="text-center"><b>'.$i.'</b></td>';
                }
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $count=1;
        foreach ($students as $student)
        {
            ?>
            <tr>
                <td class="text-right"><?=$count?></td>
                <td><?=$student->name?></td>
                <?php
                $attResult =0;
                if ($attestation->attestation_id==2) {
                    $attResult =$firstAttestationResult[$student->id];

                    echo '<td class="text-center">';
                    if (count($firstAttestation->checkouts)>0) {
                        echo '<b><span id="fa_'.$student->id.'" data-rating="'.$attResult.'">'.$attResult.'</span></b>';
                    } else {
                        if (!is_null($firstAttestation)) {
                            echo MaskedInput::widget([
                                'name' => 'fa_' . $student->id,
                                'id' => 'fa_' . $student->id,
                                'value' => $attResult,
                                'options' => [
                                    'class' => 'field-result',
                                    'onchange' => '
                                  att_res=eval($(this).val());
                                  $.post("index.php?r=checkout-result/set-attestation-result&student_id=' . $student->id . '&control_attestation_id=' . $firstAttestation->id . '&result="+$(this).val()+"",
                                  function(data){
                                     if (data!="") alert (data);
                                     sum_row =0;

                                     row=$("input[name^=res_' . $student->id . ']");
                                     for (i=0;i<row.length;i++) {
                                        if (row[i].value!=""){
                                            sum_row = sum_row +eval(row[i].value)
                                        }
                                     }



                                     sum_row = sum_row +eval($("#res_' . $student->id . '").data("rating")) +att_res;


                                     $("#rs_' . $student->id . '").html(sum_row);
                                     if ((' . $attestation->attestation_id . '==2 ) ) {
                                     rating_id =getRageID(sum_row);
                                     if (rating_id =="") {alert("Количество баллов вне диапазона "+sum_row);return;}
                                     $("#rating_' . $student->id . '").val(rating_id);
                                     $("#rating_' . $student->id . '").change();
                                     }
                                   })
                                   .fail(function() {
                                      alert( "error" );
                                   })
                                ;',
                                    /*
                                    'onclick' =>'
                                    if ($(this).val()=="") {
                                        $(this).val('.$checkout->score.');
                                        if ('.$checkout->score.'!=0) { $(this).change();}
                                    }
                                '*/
                                ],
                                'clientOptions' => [
                                    'alias' => 'decimal',
                                ],
                            ]);
                        }

                    }





                    echo '</td>';
                }

                $sumRow = 0;
                $sumVisit = 0;
                if (isset($visits[$student->id])) {
                    $sumVisit = $visits[$student->id];
                }

                foreach ($checkouts as $checkout) {
                    for ($i=1;$i<=$checkout->quantity;$i++)
                    {
                        echo '<td class="text-center">';
                        $val = '';
                        if (isset($results[$student->id][$checkout->id][$i])) {
                            $val =$results[$student->id][$checkout->id][$i];
                            $sumRow+=$val;
                        }
                        echo MaskedInput::widget([
                            'name' => 'res_'.$student->id.'_'.$checkout->id.'_'.$i,
                            'value' =>$val,
                            'options' => [
                                'class' =>'field-result',
                                'onchange'=>'
                                  $.post("index.php?r=checkout-result/set-result&student_id='.$student->id.'&checkout_id='.$checkout->id.'&work_num='.$i.'&result="+$(this).val()+"",
                                  function(data){
                                     if (data!="") alert (data);
                                     sum_row =0;
                                     row=$("input[name^=res_'.$student->id.']");
                                     for (i=0;i<row.length;i++) {
                                        if (row[i].value!=""){
                                            sum_row = sum_row +eval(row[i].value)
                                        }
                                     }
                                     att_res=0;
                                     if ($("#fa_'.$student->id.'").data("rating")!=undefined) {att_res=$("#fa_'.$student->id.'").data("rating");}
                                     if ($("#fa_'.$student->id.'").val()!=undefined) {att_res=$("#fa_'.$student->id.'").val();}
                                     sum_row = sum_row +eval($("#res_'.$student->id.'").data("rating"))+eval(att_res);

                                     $("#rs_'.$student->id.'").html(sum_row);
                                     if (('.$attestation->attestation_id.'==2 ) ) {
                                     rating_id =getRageID(sum_row);
                                     if (rating_id =="") {alert("Количество баллов вне диапазона "+sum_row);return;}
                                     $("#rating_'.$student->id.'").val(rating_id);
                                     $("#rating_'.$student->id.'").change();
                                     }
                                   })
                                   .fail(function() {
                                      alert( "error" );
                                   })
                                ;'
                                /*,
                                'onclick' =>'
                                if ($(this).val()=="") {
                                    $(this).val('.$checkout->score.');
                                    if ('.$checkout->score.'!=0) { $(this).change();}
                                }

                            '*/
                            ],
                            'clientOptions' => [
                                'alias' =>  'decimal',
                            ],
                        ]);
                        echo '</td>';
                    }
                }
                $rangeID =null;
                if (isset($controlResults[$model->id][$student->id])) {
                    $rangeID = $controlResults[$model->id][$student->id]["range_id"];
                }
                ?>
                <td class="text-center"><b><span id="res_<?=$student->id?>" data-rating="<?=$sumVisit?>"><?=$sumVisit?></span></b></td>
                <td class="text-center"><b><span id="rs_<?=$student->id?>"><?=$sumRow+$sumVisit+$attResult?></span></b</td>
                <?php
                if ($attestation->attestation_id==2) {
                    ?>

                <td class="text-center">
                    <?= Html::dropDownList('rating_'.$student->id, $rangeID,
                        ArrayHelper::map($ranges,
                            'id',
                            function($modellist) {
                                return $modellist["rating"].' - (от '.$modellist["start_rating"].' до '.$modellist["end_rating"].' баллов) - '.$modellist["description"];
                            }
                        ),
                        [
                            'class' => 'form-control competence-level',
                            'prompt' => 'Выберите оценку ...',
                            'id' => 'rating_'.$student->id,
                            'onchange'=>'
                             $.post("index.php?r=checkout-result/set-control-result&student_id='.$student->id.'&control_id='.$model->id.'&score="+$("#rs_'.$student->id.'").html()+"&range_id="+$(this).val(),
                             function(data){
                                if (data!="") alert (data);
                             })
                             .fail(function() {
                                alert( "error" );
                             });'
                        ]) ?>
                </td>
                <?php
                    }
                ?>
            </tr>
            <?php
            $count++;
        }
        ?>
        </tbody>
    </table>

<?php $this->registerJs('

$(document).ready(function() {
        var table = $("#example").DataTable({
        responsive: true,
        searching: false,
        scrollX: true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        }

   } );
});
');