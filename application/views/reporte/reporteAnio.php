<?php
$objPHPExcel = new Excel();

$objPHPExcel->getProperties()->setCreator("CENTRAL")
        ->setLastModifiedBy("CENTRAL")
        ->setTitle("TESIS");

$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName("Arial");
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->setCellValue('A1',"TESIS");

$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName("Comic Sans MS");
$objPHPExcel->getActiveSheet()->getStyle('B2:N2')->getFont()->setName("Times New Roman");
$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->setCellValue('A2',"FAC/CAR");
$objPHPExcel->getActiveSheet()->setCellValue('B2',"ENE");
$objPHPExcel->getActiveSheet()->setCellValue('C2',"FEB");
$objPHPExcel->getActiveSheet()->setCellValue('D2',"MAR");
$objPHPExcel->getActiveSheet()->setCellValue('E2',"ABR");
$objPHPExcel->getActiveSheet()->setCellValue('F2',"MAY");
$objPHPExcel->getActiveSheet()->setCellValue('G2',"JUN");
$objPHPExcel->getActiveSheet()->setCellValue('H2',"JUL");
$objPHPExcel->getActiveSheet()->setCellValue('I2',"AGO");
$objPHPExcel->getActiveSheet()->setCellValue('J2',"SEP");
$objPHPExcel->getActiveSheet()->setCellValue('K2',"OCT");
$objPHPExcel->getActiveSheet()->setCellValue('L2',"NOV");
$objPHPExcel->getActiveSheet()->setCellValue('M2',"DIC");
$objPHPExcel->getActiveSheet()->setCellValue('N2',"TOTAL");

$registros = $this->registro_model->getRegistroByAnio($anio);
$i = 2;
$facultad = '';
$carrera = '';
foreach($registros as $registro){
    if ($facultad != $registro['facultad']) {
        $i++;
        $facultad = $registro['facultad'];
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()
                ->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,strtoupper($facultad));
    }
    if ($carrera != $registro['carrera']) {
        $i++;
        $carrera = $registro['carrera'];
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,strtoupper($carrera));
    }
    
    switch ($registro['mes']) {
        case 1:
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$registro['cantidad']);
            break;
        case 2:
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$registro['cantidad']);
            break;
        case 3:
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$registro['cantidad']);
            break;
        case 4:
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$registro['cantidad']);
            break;
        case 5:
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$registro['cantidad']);
            break;
        case 6:
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$registro['cantidad']);
            break;
        case 7:
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$i,$registro['cantidad']);
            break;
        case 8:
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$registro['cantidad']);
            break;
        case 9:
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$registro['cantidad']);
            break;
        case 10:
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$registro['cantidad']);
            break;
        case 11:
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$i,$registro['cantidad']);
            break;
        case 12:
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$i,$registro['cantidad']);
            break;
    }
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$i,"=SUM(B$i:M$i)");
    $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
}
$i++;

$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()
        ->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,"TOTAL DEL MES");
$objPHPExcel->getActiveSheet()->getStyle('A3:A'.$i)->getFont()->setName("Comic Sans MS");
$objPHPExcel->getActiveSheet()->getStyle('A3:A'.$i)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A3:A'.$i)->getFont()->setSize(10);

$tam = 1;

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth($tam);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(7);

$alpha = 'B';
$j = $i - 1;
for($k = 1; $k <= 12; $k++){
	$objPHPExcel->getActiveSheet()->setCellValue($alpha.$i,"=SUM($alpha". 3 .":$alpha$j)");
	$objPHPExcel->getActiveSheet()->getCell($alpha.$i)->getCalculatedValue();
	$objPHPExcel->getActiveSheet()->getColumnDimension($alpha)->setWidth(7);
	$alpha++;
}
$objPHPExcel->getActiveSheet()->setCellValue($alpha.$i,"=SUM(B$i:M$i)");
$objPHPExcel->getActiveSheet()->getCell($alpha.$i)->getCalculatedValue();

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
);
$objPHPExcel->getActiveSheet()->getStyle('A2:N'.$i)
        ->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->setTitle("Hoja 1");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TESIS '.$anio.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
?>