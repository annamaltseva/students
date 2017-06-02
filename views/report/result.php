<?php
use app\components\Helper;
?>
<table align="center" >
    <tr>
        <td class="attestation-label text-center">Таблица успеваемости студентов</td>
    </tr>
    <tr>
        <td class="group-label text-center">за <?=$year->name?> год</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
</table>
<table border="1" align="center" class="report-table" >
    <tr>
        <?php
            foreach ($data["attestation"] as $attestation) {
        ?>
            <td class="attestation-label text-center"><?=$attestation['name']?></td>
        <?php
            }
        ?>
    </tr>
    <?php
    $results=$data["data"];
    $subjects =$data["subject"];
    $students = $data["student"];

    foreach ($data["group"] as $group) {
        $countCols = 2+count($data["attestation"]);
        foreach ($data["attestation"] as $attestation) {
            if (isset($results[$group["id"]][$attestation["id"]])) {
                echo '<td ><table class="data-table" height="100%" border="1" width="100%"><tr>';
                echo '<tr></td><td class="group-label" colspan="' . $countCols . '">' . $group["name"] . '</td></tr>';
                echo '<tr><td class="subject-label">№</td><td class="subject-label">ФИО</td>';
                if (isset($subjects[$attestation["id"]][$group["id"]])) {
                    foreach ($subjects[$attestation["id"]][$group["id"]] as $subject) {
                        ?>
                        <td class="subject-label text-center"><?= $subject["name"] ?></td>
                    <?php
                    }

                } else {
                    echo '<td>-</td>';
                }
                echo '</tr>';
                $i =1;
                foreach ($students[$group["id"]] as $student) {
                    echo '<tr class="value-label"><td align="right">' . $i . '</td>';
                    echo '<td >' . $student["name"] . '</td>';

                    $studentResults = $results[$group["id"]][$attestation["id"]][$student["id"]];
                    if (isset($subjects[$attestation["id"]][$group["id"]])) {
                        foreach ($subjects[$attestation["id"]][$group["id"]] as $subject) {
                            ?>
                            <td class="text-center"><?= Helper::formatNumber($studentResults[$subject["id"]]) ?></td>
                        <?php
                        }
                    } else {
                        echo '<td>-</td>';
                    }
                    $i++;
                }


                echo '</tr></table></td>';
            }
            else {
                echo '<td>Нет данных</td>';
            }


        }
        echo '</tr>';
    }
    ?>
</table>