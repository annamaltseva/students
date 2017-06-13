<?php

use app\components\Helper;

$objPHPExcel = new \PHPExcel();

/* устанавливаем бордер ячейкам */
$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$styleArrayAlign = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
    ),
);


$sheet = $objPHPExcel->setActiveSheetIndex(0);
//$sheet->setCellValue('A', 'Hello');
$i=0;
/*
foreach ($data["attestation"] as $attestation) {
    $sheet->setCellValueByColumnAndRow($i,1, $attestation['name']);
    $i++;
}
*/

$results=$data["data"];
$subjects =$data["subject"];
$students = $data["student"];

$rowCountGlobal =2;
foreach ($data["group"] as $group) {
    $cellCountGlobal =0;
    foreach ($data["attestation"] as $attestation) {

        $countCols = 1 + count($data["subject"][$attestation["id"]][$group["id"]]);

        if ($attestation["id"] == 1) $cellCount[1] =$cellCountGlobal;
        $rowCount[$attestation["id"]] =$rowCountGlobal;
        $stepCount = 0;
        if (isset($results[$group["id"]][$attestation["id"]])) {
            $sheet->mergeCellsByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]],$cellCount[$attestation["id"]]+$countCols,$rowCount[$attestation["id"]]);
            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]])
                ->applyFromArray($styleArray);

            $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]], $group['name'].'-'.$attestation["name"]);
            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]])
            ->applyFromArray(array("font" => array( "bold" => true)));



            if ($attestation["id"] == 1) $cellCount[2] = $cellCount[$attestation[2]]+$countCols+1;
            $rowCount[$attestation["id"]] = $rowCount[$attestation["id"]]+1;
            $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]], '№');
            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]])
                ->applyFromArray($styleArray);
            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]])
                ->applyFromArray(array("font" => array( "bold" => true)));

            $stepCount = 1;
            $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]]+$stepCount,$rowCount[$attestation["id"]], 'ФИО');
            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]]+$stepCount,$rowCount[$attestation["id"]],$cellCount[$attestation["id"]])
                ->applyFromArray($styleArray);
            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]]+$stepCount,$rowCount[$attestation["id"]])
            ->applyFromArray(array("font" => array( "bold" => true)));

            if (isset($subjects[$attestation["id"]][$group["id"]])) {
                foreach ($subjects[$attestation["id"]][$group["id"]] as $subject) {
                    $stepCount++;
                    $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]]+$stepCount,$rowCount[$attestation["id"]],$subject["name"]);
                    $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]]+$stepCount,$rowCount[$attestation["id"]])
                        ->applyFromArray($styleArrayAlign)
                        ->getAlignment()->setWrapText(true);

                    $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]]+$stepCount,$rowCount[$attestation["id"]])
                    ->applyFromArray(array("font" => array( "bold" => true)));
                }

            } else {
                $cellCount[$attestation["id"]] = $cellCount[$attestation["id"]] + $stepCount;
                $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]],'-');
                $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]])
                    ->applyFromArray($styleArray);

            }
            $countStud =0;
            foreach ($students[$group["id"]] as $student) {
                $countStud ++;
                $rowCount[$attestation["id"]]= $rowCount[$attestation["id"]]+1;
                $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]],$rowCount[$attestation["id"]],$countStud);
                $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]], $rowCount[$attestation["id"]])
                    ->applyFromArray($styleArray);
                $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]]+1,$rowCount[$attestation["id"]],$student["name"]);
                $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]]+1, $rowCount[$attestation["id"]])
                    ->applyFromArray($styleArray);
                $countRes =1;
                $studentResults = $results[$group["id"]][$attestation["id"]][$student["id"]];
                if (isset($subjects[$attestation["id"]][$group["id"]])) {
                    foreach ($subjects[$attestation["id"]][$group["id"]] as $subject) {
                        $countRes++;
                        if (isset($studentResults[$subject["id"]])) {
                            $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]] + $countRes,
                                $rowCount[$attestation["id"]],
                                Helper::formatNumber($studentResults[$subject["id"]]));
                            $sheet->getStyleByColumnAndRow($cellCount[$attestation["id"]] + $countRes,$rowCount[$attestation["id"]])
                                ->applyFromArray($styleArray);
                        }
                    }
                } else {
                    $sheet->setCellValueByColumnAndRow($cellCount[$attestation["id"]]+$countRes,$rowCount[$attestation["id"]],Helper::formatNumber($studentResults[$subject["id"]]));
                }
            }
        }
    }
    $rowCountGlobal = $rowCount[$attestation["id"]]+1;
    $sheet->setCellValueByColumnAndRow(0,$rowCountGlobal,'');
    $rowCountGlobal ++;
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('report');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="report.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;