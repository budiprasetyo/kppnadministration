<?php
     require("../fpdf/fpdf.php");
     
     	$pdf=new FPDF();
     	$pdf->AddPage();
     	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(180,30,
			'Selamat! PDF berhasil diciptakan!',1,1,'C');
	$pdf->Output();
?>