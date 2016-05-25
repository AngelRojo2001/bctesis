<?php

$impresion = $this->usuario_model->getImpresion($this->session->userdata('id_usuario'));
$alto = 7.5;
$pdf = new FPDF('P','mm',array(164,220));
//$pdf->SetMargins(14,77);
$pdf->SetLeftMargin($impresion['SetLeftMargin']);
$pdf->SetTopMargin($impresion['SetTopMargin']);
$pdf->SetRightMargin($impresion['SetRightMargin']);
$pdf->SetFont('Arial', '', 12);
$pdf->AddPage();
$row_alumno = $this->alumno_model->getAlumnoAll($alumno_id);
$mes = '';
switch (date('m')) {
    case '01':
        $mes = 'Enero';
        break;
    case '02':
        $mes = 'Febrero';
        break;
    case '03':
        $mes = 'Marzo';
        break;
    case '04':
        $mes = 'Abril';
        break;
    case '05':
        $mes = 'Mayo';
        break;
    case '06':
        $mes = 'Junio';
        break;
    case '07':
        $mes = 'Julio';
        break;
    case '08':
        $mes = 'Agosto';
        break;
    case '09':
        $mes = 'Septiembre';
        break;
    case '10':
        $mes = 'Octubre';
        break;
    case '11':
        $mes = 'Noviembre';
        break;
    case '12':
        $mes = 'Diciembre';
        break;
}
//$pdf->Cell(0,71,'',1,1);
$pdf->Cell($impresion['apellidos']);
$pdf->Cell(0, $alto, utf8_decode($row_alumno['apellidos'].', '.$row_alumno['nombres']),$impresion['linea'],1);
$pdf->Cell($impresion['carrera']);
$pdf->Cell(0, $alto, utf8_decode($row_alumno['carrera']),$impresion['linea'],1);
$pdf->Cell($impresion['carrera']);
$pdf->Cell(0, $alto, utf8_decode($row_alumno['facultad']),$impresion['linea'],1);
$pdf->Cell($impresion['modalidad']);
$pdf->Cell(0, $alto, utf8_decode($row_alumno['modalidad']),$impresion['linea'],1);
$pdf->MultiCell(0,$alto,utf8_decode($row_alumno['titulo']),$impresion['linea']);
$pdf->SetY($impresion['fecha']);
$pdf->Cell($impresion['fecha_dist']);
$pdf->Cell(15, $alto, date('d'), $impresion['linea']);
$pdf->Cell(45, $alto, $mes, $impresion['linea']);
$pdf->Cell(0, $alto, date('y'), $impresion['linea']);
$pdf->Output();