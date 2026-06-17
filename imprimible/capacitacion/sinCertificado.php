<?
include ('./../imprimible.class/class.ezpdf.php');
include("./../imprimible.class/fpdf.php");

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->Image('../../images/NewBarra.png', 0, 0, 300, 210, 'png');
$pdf->Image('../../images/logo2017.fw.png', 0, 0, 60, 30, 'png');
$pdf->Ln(80);
$pdf->Cell(65);
$pdf->SetFont('helvetica','I',36);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(52,5,'Certificado no encontrado',0,0,'J');
$pdf->Output();

?>