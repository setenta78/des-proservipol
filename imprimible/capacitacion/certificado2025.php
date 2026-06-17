<?
include ('./../imprimible.class/class.ezpdf.php');
include("./../imprimible.class/fpdf.php");

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->Image('../../img/'.$certificado.'.png', 5, 5, 280, 200, 'png');
$pdf->SetTextColor(95,95,95);
$pdf->Ln(60);
$pdf->Cell(100);
$pdf->AddFont('GreatVibes-Regular', '','GreatVibes-Regular.php');
$pdf->SetFont('GreatVibes-Regular','',24);
$pdf->Cell(0,0,$nombre,0,0,'J');
$pdf->Ln(64);
$pdf->Cell(124);
$pdf->SetFont('helvetica','I',12);
$pdf->Cell(0,0,iconv('UTF-8', 'ISO-8859-2', 'Situación: '),0,0,'J');
$pdf->Cell(-133);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(100,0,iconv('UTF-8', 'ISO-8859-2', 'Aprobado'),0,0,'J');
$pdf->SetFont('helvetica','I',12);
$pdf->Ln(6);
$pdf->Cell(101);
$pdf->Cell(0,0,iconv('UTF-8', 'ISO-8859-2', 'Fecha de Aprobación: '),0,0,'J');
$pdf->Cell(-133);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(0,0,iconv('UTF-8', 'ISO-8859-2', $mesCertDesc.' '.$anno),0,0,'J');
$pdf->Ln(6);
$pdf->Cell(117);
$pdf->SetFont('helvetica','I',12);
$pdf->Cell(0,0,'Valido Hasta: ',0,0,'J');
$pdf->Cell(-133);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(100,0,iconv('UTF-8', 'ISO-8859-2', $mesValDesc.' '.$annoValidez),0,0,'J');
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetFont('helvetica','I',9);
$pdf->Ln(54);
$pdf->Cell(194);
$pdf->Cell(55,5,iconv('UTF-8', 'ISO-8859-2', 'Fecha emisión: ').date("Y/m/d H:i:s"),0,0,'J');
$pdf->Ln(5);
$pdf->Cell(60,5,iconv('UTF-8', 'ISO-8859-2', 'Puede revisar la validez de su certificado en proservipol.carabineros.cl en el apartado de "Validar Certificado" ingresando el siguiente Código de verificación: '),0,0,'J');
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(162);
$pdf->Cell(52,5,$cod_ver,0,0,'B');
$pdf->Output();

?>