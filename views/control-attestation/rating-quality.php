<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\CompetenceLevel;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

$this->title = "Качественная оценка";
?>
    <div class="row">
        <div class="col-md-12 text-right">
            <?= Html::a('К аттестациям ', ['index', 'control_id'=>$attestation->control_id], ['class' => '']) ?>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-1 col-sm-3"><b>Группа:</b></div><div class="col-md-3 col-sm-9"><?=$model->group->name?></div>
        <div class="col-md-1 col-sm-3"><b>Предмет:</b></div><div class="col-md-3 col-sm-9"><?=$model->subject->name?></div>
        <div class="col-md-1 col-sm-3"><b>Аттестация:</b></div><div class="col-md-3 col-sm-9"><?=$attestation->attestation->name?></div>
    </div>

    <table class="table table-striped table-hover table-bordered" id="example">
        <thead>
        <tr>
            <th rowspan="3"><b>№</b></th>
            <th rowspan="3"><b>Студент</b></th>
            <?php
            if ($attestation->attestation_id==2) {
                echo '<td rowspan="3" class="text-center" ><b>Баллы<br>первая аттестация</b></td>';
            }
            foreach ($checkouts as $checkout) {
                $countCell=0;
                $countWork =0;
                if (isset($works[$checkout["id"]])) {
                    $countWork = $checkout["quantity"];
                    foreach ($works[$checkout["id"]] as $work) {
                        if (count($competences[$checkout["id"]][$work["id"]]) > 1) {
                            $countCell += count($competences[$checkout["id"]][$work["id"]]) - 1;
                        }
                    }
                }
                $kolCell = $countWork + $countCell;
                ?>
                <th
                    <?php if ($kolCell>1)  echo ' colspan="'.$kolCell.'" '; ?>

                    class="text-center"><?=$checkout["name"]?> - <b><?=$checkout["quantity"]?> </b>шт.</th>
            <?php
            }
            ?>
            <th rowspan="3" class="text-center"><b><?=$model->goal->name?></b></th>

        </tr>
        <tr class="row-work">
            <?php
            foreach ($checkouts as $checkout) {
                if (isset($works[$checkout["id"]])) {
                    foreach ($works[$checkout["id"]] as $work) {
                        echo '<th ';
                        if (count($competences[$checkout["id"]][$work["id"]]) > 1) {
                            echo ' colspan="' . count($competences[$checkout["id"]][$work["id"]]) . '"';
                        }
                        echo ' class="text-center">' . $work["name"] . '</th>';
                    }
                } else {
                    echo '<th class="text-center"><span style="color:#ff0000"> Нет работ</span></th>';
                }
            }
            ?>
        </tr>
        <tr class="row-competence">
            <?php
            foreach ($checkouts as $checkout) {
                if (isset($works[$checkout["id"]])) {
                    foreach ($works[$checkout["id"]] as $work) {
                        if (isset($competences[$checkout["id"]][$work["id"]])) {
                            foreach ($competences[$checkout["id"]][$work["id"]] as $competence) {
                                echo '<th class="text-center">' . $competence["name"] . '</th>';
                            }
                        } else {
                            echo '<th class="text-center"><span style="color:#ff0000"> Нет компетенций</span></th>';
                        }
                    }
                } else {
                    echo '<th class="text-center"><span style="color:#ff0000"> Нет компетенций</span></th>';
                }
            }
            ?>
        </tr>

        </thead>
        <tbody>
        <?php
        $i=1;
        foreach ($students as $student)
        {
            ?>
            <tr>
                <td class="text-right"><?=$i?></td>
                <td>
                    <?= Html::a($student->name, ['student-result-quality','control_id' => $checkout->id, 'student_id' => $student->id], ['target' => '_blank'] ) ?>
                </td>

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
                                              if ((att_res=="") || (att_res==undefined)) {att_res =0};

                                              $.post("index.php?r=checkout-result/set-attestation-result&student_id=' . $student->id . '&control_attestation_id=' . $firstAttestation->id . '&result="+$(this).val()+"",
                                              function(data){
                                                 sum_row =0;
                                                 if (($("#rsh_' . $student->id . '").val()!="") && ($("#rsh_' . $student->id . '").val()!=undefined)){
                                                    sum_row = eval($("#rsh_' . $student->id . '").val())
                                                 }
                                                 val= sum_row;
                                                 if (eval(att_res)!=0) {
                                                    val=Math.round((((sum_row+att_res)/2)*100))/100;
                                                 }
                                                 $("#rs_' . $student->id . '").html(val);
                                                 $("#rsh_' . $student->id . '").val(val);
                                                 $("#rsh_' . $student->id . '").change();

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

                    $sumRow =0;
                    $countRow =0;
                    foreach ($checkouts as $checkout) {
                        if (isset($works[$checkout["id"]])) {
                            foreach ($works[$checkout["id"]] as $work) {
                                if (isset($competences[$checkout["id"]][$work["id"]])) {
                                    foreach ($competences[$checkout["id"]][$work["id"]] as $competence) {
                                        $val = null;
                                        $score =0;
                                        if (isset($results[$student->id][$work["id"]][$competence["id"]])) {
                                            $val = $results[$student->id][$work["id"]][$competence["id"]];
                                            $sumRow += $val["value"];
                                            $val = $val["id"];

                                            $countRow++;
                                        }
                                        echo '<td class="text-center">' . Html::dropDownList('res_' . $student->id . '_' . $work["id"] . '_' . $competence["id"],
                                                $val,
                                                ArrayHelper::map(CompetenceLevel::getAll(), 'id', 'name'), [
                                                    'class' => 'form-control competence-level',
                                                    'options' => CompetenceLevel::getScore(),
                                                    'id' => 'res_' . $student->id . '_' . $work["id"] . '_' . $competence["id"],
                                                    'prompt' => 'Выберите уровень ...',
                                                    'onchange' => '
                                                    first_ball =0;
                                                    if ($("#fa_'.$student->id.'").val()!=undefined) {first_ball=$("#fa_'.$student->id.'").val()}
                                              $.post("index.php?r=checkout-result/set-result-quality&student_id=' . $student->id . '&competence_id=' . $competence["id"] . '&work_id=' . $work["id"] . '&level_id="+$(this).val()+"",
                                              function(data){
                                                 //if (data!="") alert (data);
                                                 sum_row = 0;
                                                 count_level = 0;
                                                 row=$("select[name^=res_' . $student->id . ']");

                                                final_score =eval(data);
                                                if (eval(data)!=0) { final_score =Math.round(((eval(data)+eval(first_ball))/2)*100)/100 ;}

                                                 $("#rs_' . $student->id . '").html(final_score);
                                                 $("#rsh_' . $student->id . '").val(eval(data));
                                                 $("#rsh_' . $student->id . '").change();

                                               })
                                               .fail(function() {
                                                  alert( "error" );
                                               }) ;'
                                                ]) . '</td>';
                                    }
                                } else {
                                    echo '<td class="text-center row-competence"><span style="color:#ff0000"> -</span></td>';
                                }
                            }
                        } else {
                            echo '<td class="text-center row-competence"><span style="color:#ff0000"> -</span></td>';
                        }
                    }
                    $avgResult =0;
                    if (isset($controlResults[$model->id][$student->id])) {
                        $avgResult = $controlResults[$model->id][$student->id]["score"];
                    }
                    ?>
                <td class="text-center">
                    <b><span id="rs_<?=$student->id?>" ><?=$avgResult?></span></b>
                    <?php
                        echo Html::hiddenInput('rsh_'.$student->id,$avgResult,[
                            'id'=> 'rsh_'.$student->id,
                            'onchange' => '
                                 $.post("index.php?r=checkout-result/set-control-result&student_id='.$student->id.'&control_id='.$model->id.'&score="+$("#rs_'.$student->id.'").html()+"&range_id=-1",
                                 function(data){
                                    if (data!="") alert (data);
                                 })
                                 .fail(function() {
                                    alert( "error" );
                                 });'



                        ])
                    ?>

                    <input type="hidden" id="rsh1_<?=$student->id?>" value="">
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
    </table>



<?php $this->registerJs('
$(document).ready(function() {
        var table = $("#example").DataTable({
        responsive: true,
        searching: false,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2

        }
     } );
});
');