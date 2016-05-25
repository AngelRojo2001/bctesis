<?php
$objPHPExcel = new Excel();
        
$objPHPExcel->getProperties()->setCreator("CENTRAL")
        ->setLastModifiedBy("CENTRAL")
        ->setTitle("Facultades");

$facultad = $this->facultad_model->getFacultad($facultad_id);
$facultad_nombre = $facultad['facultad'];
$carreras = $this->carrera_model->getCarreraByFacultad($facultad_id);
$pos = 0;
foreach($carreras as $carrera) {
    $carrera_id = $carrera['id'];
    $carrera_nombre = $carrera['carrera'];
    $i = 4;
    $registros = $this->registro_model->getRegistroByCarrera($carrera_id, $anio);
    
    $objPHPExcel->setActiveSheetIndex($pos);
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    
    $objPHPExcel->getActiveSheet()->setCellValue('A1',"TESIS BIBLIOTECA CENTRAL");
    $objPHPExcel->getActiveSheet()->setCellValue('A2',strtoupper($carrera_nombre));
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:M3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A1:M3')->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('A1:M3')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    $objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
    $objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
    
    $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getFont()
            ->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
    $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A3')->getFill()
            ->getStartColor()->setARGB('FF008000');
    $objPHPExcel->getActiveSheet()->setCellValue('A3',"NRO");
    $objPHPExcel->getActiveSheet()->getStyle('B3:C3')->getFill()
            ->getStartColor()->setARGB('FFFF0000');
    $objPHPExcel->getActiveSheet()->setCellValue('B3',"AUTOR");
    $objPHPExcel->getActiveSheet()->setCellValue('C3',"TITULO");
    $objPHPExcel->getActiveSheet()->getStyle('D3:F3')->getFill()
            ->getStartColor()->setARGB('FF008000');
    $objPHPExcel->getActiveSheet()->setCellValue('D3',"TUTOR");
    $objPHPExcel->getActiveSheet()->setCellValue('E3',"FACULTAD");
    $objPHPExcel->getActiveSheet()->setCellValue('F3',"CARRERA");
    $objPHPExcel->getActiveSheet()->getStyle('G3:H3')->getFill()
            ->getStartColor()->setARGB('FFFF0000');
    $objPHPExcel->getActiveSheet()->setCellValue('G3',"AÑO");
    $objPHPExcel->getActiveSheet()->setCellValue('H3',"DEFENSA");
    $objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getFill()
            ->getStartColor()->setARGB('FF008000');
    $objPHPExcel->getActiveSheet()->setCellValue('I3',"VALORACION");
    $objPHPExcel->getActiveSheet()->setCellValue('J3',"MODALIDAD");
    $objPHPExcel->getActiveSheet()->getStyle('K3:M3')->getFill()
            ->getStartColor()->setARGB('FF333399');
    $objPHPExcel->getActiveSheet()->setCellValue('K3',"Nº PAG");
    $objPHPExcel->getActiveSheet()->setCellValue('L3',"DESCRIPTOR");
    $objPHPExcel->getActiveSheet()->setCellValue('M3',"FECHA");
    
    foreach($registros as $registro) {
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$i-3);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$registro['apellidos']." ".$registro['nombres']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$registro['titulo']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$registro['tutor']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$facultad_nombre);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$carrera_nombre);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$i,$registro['anio']);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$i,$registro['nota']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$i,$registro['modalidad']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$i,$registro['paginas']);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$i,$registro['fecha_registro']);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':M'.$i)->getFont()->setSize(10);
        $i++;
    }
    if(strlen($carrera_nombre) > 12) {
        $carrera_nombre = substr($carrera_nombre,0,12);
    }
    $objPHPExcel->getActiveSheet()->setTitle($carrera_nombre);
    $objPHPExcel->createSheet();
    $pos++;
    
    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
        ),
    );
    $objPHPExcel->getActiveSheet()->getStyle('A3:M'.($i-1))
            ->applyFromArray($styleArray);
    
    $objPHPExcel->getActiveSheet()->getStyle('A4:M'.($i-1))
            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(9);
}

$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'."$facultad_nombre $anio".'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');