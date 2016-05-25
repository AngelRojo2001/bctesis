<?php
$mesDesc = "";
switch ($mes) {
    case 1:
        $mesDesc = "Enero";
        break;
    case 2:
        $mesDesc = "Febrero";
        break;
    case 3:
        $mesDesc = "Marzo";
        break;
    case 4:
        $mesDesc = "Abril";
        break;
    case 5:
        $mesDesc = "Mayo";
        break;
    case 6:
        $mesDesc = "Junio";
        break;
    case 7:
        $mesDesc = "Julio";
        break;
    case 8:
        $mesDesc = "Agosto";
        break;
    case 9:
        $mesDesc = "Septiembre";
        break;
    case 10:
        $mesDesc = "Octubre";
        break;
    case 11:
        $mesDesc = "Noviembre";
        break;
    case 12:
        $mesDesc = "Diciembre";
        break;
}

$objPHPExcel = new Excel();
$objPHPExcel->getProperties()->setCreator("CENTRAL")
        ->setLastModifiedBy("CENTRAL")
        ->setTitle("TESIS");

$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName("Arial");
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->setCellValue('A1',"Reporte del mes de $mesDesc del $anio");

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setName("Times New Roman");
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->setCellValue('A2',"Nro");
$objPHPExcel->getActiveSheet()->setCellValue('B2',"CODIGO");
$objPHPExcel->getActiveSheet()->setCellValue('C2',"AUTOR");
$objPHPExcel->getActiveSheet()->setCellValue('D2',"TITULO");
$objPHPExcel->getActiveSheet()->setCellValue('E2',"CARRERA");
$objPHPExcel->getActiveSheet()->setCellValue('F2',"FACULTAD");
$objPHPExcel->getActiveSheet()->setCellValue('G2',"AÑO");
$objPHPExcel->getActiveSheet()->setCellValue('H2',"FECHA");

$registros = $this->registro_model->getRegistroByMesAnio($mes, $anio);
$i = 3;

foreach ($registros as $registro) {
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $i-2);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $registro['codigo']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $registro['apellidos'].', '.$registro['nombres']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $registro['titulo']);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $registro['carrera']);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $registro['facultad']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $registro['anio']);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $registro['fecha']);
    $i++;
}

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
);
$objPHPExcel->getActiveSheet()->getStyle('A2:H'.($i-1))
        ->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A3:H'.($i-1))
        ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(11);

$objPHPExcel->getActiveSheet()->setTitle("Hoja 1");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte '.$mesDesc.' '.$anio.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');