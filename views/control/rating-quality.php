<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CompetenceLevel;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

$this->title = "Качественная оценка";
echo $this->render('@app/views/layouts/part/_control_header',[
    'model' => $model
]);
?>

<table class="table table-striped table-hover table-bordered" id="example">
    <thead>
    <tr>
        <th rowspan="3"><b>№</b></th>
        <th rowspan="3" width="150px"><b>Студент</b></th>
        <?php
        foreach ($checkouts as $checkout) {
            $countCell=0;
            foreach ($works[$checkout["id"]] as $work) {
                if (count($competences[$checkout["id"]][$work["id"]])>1) {
                    $countCell+=count($competences[$checkout["id"]][$work["id"]])-1;
                }
            }
            $kolCell = $checkout["quantity"]+$countCell;
        ?>
            <th
                <?php if ($kolCell>1)  echo ' colspan="'.$kolCell.'" '; ?>

                class="text-center"><?=$checkout["name"]?> - <b><?=$checkout["quantity"]?> </b>шт.</th>
        <?php
        }
        ?>
        <th rowspan="3" class="text-center"><b>Ср. балл</b></th>
    </tr>
    <tr class="row-work">
        <?php
        foreach ($checkouts as $checkout) {
            foreach ($works[$checkout["id"]] as $work) {
                echo '<th ';
                if (count($competences[$checkout["id"]][$work["id"]])>1) echo ' colspan="'. count($competences[$checkout["id"]][$work["id"]]).'"';
                echo ' class="text-center">'.$work["name"].'</th>';
            }
        }
        ?>
    </tr>
    <tr class="row-competence">
        <?php
        foreach ($checkouts as $checkout) {
            foreach ($works[$checkout["id"]] as $work) {
                if (isset($competences[$checkout["id"]][$work["id"]])) {
                    foreach ($competences[$checkout["id"]][$work["id"]] as $competence) {
                        echo '<th class="text-center">' . $competence["name"] . '</th>';
                    }
                } else {
                    echo '<th class="text-center"><span style="color:#ff0000"> Нет компетенций</span></th>';
                }
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
            <td><?=$i?></td>
            <td><?=$student->name?></td>
            <?php
            $sumRow =0;
            $countRow =0;
            foreach ($checkouts as $checkout) {
                foreach ($works[$checkout["id"]] as $work) {
                    if (isset($competences[$checkout["id"]][$work["id"]])) {
                        foreach ($competences[$checkout["id"]][$work["id"]] as $competence) {
                            $val =null;
                            if (isset($results[$student->id][$work["id"]][$competence["id"]])) {
                                $val =$results[$student->id][$work["id"]][$competence["id"]];
                                $sumRow += $val["value"];
                                $val = $val["id"];
                                $countRow++;
                            }
                            echo '<td class="text-center">' . Html::dropDownList('res_'.$student->id.'_'.$work["id"].'_'.$competence["id"], $val,
                                ArrayHelper::map(CompetenceLevel::getAll(), 'id', 'name'),[
                                        'class' => 'form-control competence-level',
                                        'options' => CompetenceLevel::getScore(),
                                        'id' =>'res_'.$student->id.'_'.$work["id"].'_'.$competence["id"],
                                        'prompt' => 'Выберите уровень ...',
                                        'onchange'=>'
                                              $.post("index.php?r=checkout-result/set-result-quality&student_id='.$student->id.'&competence_id='.$competence["id"].'&work_id='.$work["id"].'&level_id="+$(this).val()+"",
                                              function(data){
                                                 if (data!="") alert (data);
                                                 sum_row = 0;
                                                 count_level = 0;
                                                 row=$("select[name^=res_'.$student->id.']");
                                                 for (i=0;i<row.length;i++) {
                                                 val = $(row[i]).find(":selected").data("score");
                                                    if (val!=undefined){
                                                        sum_row = sum_row +eval(val);
                                                        count_level ++;
                                                    }
                                                 }
                                                 val = Math.round((sum_row/count_level) * 100) / 100;
                                                 $("#rs_'.$student->id.'").html(val);
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
            }
            ?>
            <td class="text-center"><b><span id="rs_<?=$student->id?>" data-rating="<?=$sumRow?>"><?=round($sumRow/$countRow,2)?></span></b></td>
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