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
/* @var $form yii\widgets\ActiveForm */

$this->title = "Количественная оценка";
echo $this->render('@app/views/layouts/part/_control_header',[
    'model' => $model
]);

?>

<table class="table table-striped table-hover table-bordered" id="example">
    <thead>

    <tr>
        <td rowspan="2" ><b>№</b></td>
        <td rowspan="2"  class="student-name"><b>Студент</b></td>
        <?php
        foreach ($checkouts as $checkout) {
        ?>
        <td colspan="<?=$checkout->quantity?>" class="text-center"><?=$checkout->checkoutForm->name?> - <b><?=$checkout->quantity?> </b>шт.</td>
        <?php
        }
        ?>
        <td rowspan="2" class="text-center"><b>Посещ.</b></td>
        <td rowspan="2" class="text-center"><b>Мин. балл</b></td>
        <td rowspan="2" class="text-center"><b>Итого</b></td>
        <td rowspan="2" class="text-center"><b>Оценка</b></td>
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
            <td><?=$count?></td>
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
                    //echo'<td class="text-center"><input type="text" size="1" name="res_'.$result->id.'_'.$checkout->id.'_'.$i.'"></td>';
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

                                     $("#rs_'.$student->id.'").val(sum_row);
                                   })
                                   .fail(function() {
                                      alert( "error" );
                                   })
                                ;'

                        ],
                        'clientOptions' => [
                            'alias' =>  'decimal',
                        ],
                    ]);
                    echo '</td>';
                }
            }
            ?>
            <td class="text-center"><b><span id="res_<?=$student->id?>" data-rating="<?=$sumVisit?>"><?=$sumVisit?></span></b></td>
            <td class="text-center"><b><?=$model->limit_rating?></b></td>
            <td class="text-center"><input type="text" size="1" id = "rs_<?=$student->id?>" value="<?=$sumRow+$sumVisit?>" style="text-align:right"></td>
            <td class="text-center"><input type="text" size="1" id = "222_<?=$student->id?>" value="" style="text-align:right"></td>
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
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        }

   } );
});
');