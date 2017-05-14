<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CompetenceLevel;
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
        <?php
        foreach($competence as $item)
        {
        ?>
        <td><?=$item->checkoutCompetence->name?></td>
        <?php

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
            foreach($competence as $item)
            {
            ?>
            <td>
                <?= Html::dropDownList('id', null,
                    ArrayHelper::map(CompetenceLevel::getAll(), 'id', 'name'),[
                        'class' => 'form-control',
                        'prompt' => 'Выберите компетенцию ...'

                    ]) ?>
            </td>
            <?php

            }
            ?>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>