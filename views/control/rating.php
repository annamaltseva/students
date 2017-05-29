<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

$this->title = "Количественная оценка";
echo $this->render('@app/views/layouts/part/_control_header',[
    'model' => $model
]);

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

<table class="table table-striped table-hover table-bordered" id="example">
    <thead>
    <tr>
        <td rowspan="2" ><b>№</b></td>
        <td rowspan="2" ><b>Студент</b></td>
        <?php
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
        <td rowspan="2" class="text-center"><b><?=$model->goal->name?></b></td>
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
                                     sum_row = sum_row +eval($("#res_'.$student->id.'").data("rating"));

                                     $("#rs_'.$student->id.'").html(sum_row);
                                     rating_id =getRageID(sum_row);
                                     if (rating_id =="") {alert("Количество баллов вне диапазона");return;}
                                     $("#rating_'.$student->id.'").val(rating_id);
                                     $("#rating_'.$student->id.'").change();
                                   })
                                   .fail(function() {
                                      alert( "error" );
                                   })
                                ;',
                            'onclick' =>'
                                if ($(this).val()=="") {
                                    $(this).val('.$checkout->score.');
                                    $(this).change();
                                }
                            '
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
            <td class="text-center"><b><span id="rs_<?=$student->id?>"><?=$sumRow+$sumVisit?></span></b</td>
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