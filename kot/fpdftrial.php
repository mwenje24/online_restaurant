<?php 

require('../assets/fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
$x = 20;
$pdf->Cell(100, $x, 'Hello World', 0, 0, 'C');
$pdf->Cell(90, $x, 'Hello World two', 0, 0, 'C');
$pdf->Line(10, 25, 200, 25);
$pdf->Ln(5);

$pdf->Cell(100, $x+10, 'Hello World three', 0, 0, 'C');
$pdf->Cell(90, $x+10, 'Hello World four', 0, 0, 'C');
$pdf->Line(10, 35, 200, 35);
$pdf->Ln(5);

$pdf->Cell(100, $x+20, 'Hello World three', 0, 0, 'C');
$pdf->Cell(90, $x+20, 'Hello World four', 0, 0, 'C');
$pdf->Line(10, 35, 200, 35);
$pdf->Ln(5);

$pdf->Output();

?>