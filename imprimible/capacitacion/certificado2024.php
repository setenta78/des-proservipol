<?
include ('./../imprimible.class/class.ezpdf.php');
include("./../imprimible.class/fpdf.php");

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->Image('../../img/'.$certificado.'.png', 5, 5, 280, 200, 'png');
$pdf->SetTextColor(95,95,95);
$pdf->Ln(68);
$pdf->Cell(140);
$pdf->AddFont('GreatVibes-Regular', '','GreatVibes-Regular.php');
$pdf->SetFont('GreatVibes-Regular','',24);
$pdf->Cell(0,0,$nombre,0,0,'J');
$pdf->Ln(63);
$pdf->Cell(165);
$pdf->SetFont('helvetica','I',12);
$pdf->Cell(0,0,iconv('UTF-8', 'ISO-8859-2', 'Situación: Aprobado'),0,0,'J');
$pdf->Ln(6);
$pdf->Cell(150);
$pdf->Cell(0,0,iconv('UTF-8', 'ISO-8859-2', 'Fecha de Aprobación: ').$mesCertDesc.' '.$anno,0,0,'J');
$pdf->Ln(6);
$pdf->Cell(160);
$pdf->Cell(0,0,'Valido Hasta: '.$mesValDesc.' '.$annoValidez,0,0,'J');
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetFont('helvetica','I',9);
$pdf->Ln(45);
$pdf->Cell(230);
$pdf->Cell(52,5,iconv('UTF-8', 'ISO-8859-2', 'Fecha emisión: ').date("Y/m/d H:i:s"),0,0,'J');
$pdf->Ln(7);
$pdf->Cell(52,5,iconv('UTF-8', 'ISO-8859-2', 'Puede revisar la validez de su certificado en proservipol.carabineros.cl en el apartado de "Validar Certificado" ingresando el siguiente Código de verificación: '),0,0,'J');
$pdf->SetFont('helvetica','B',11);
$pdf->Cell(170);
$pdf->Cell(52,5,$cod_ver,0,0,'B');
$pdf->Output();

?>