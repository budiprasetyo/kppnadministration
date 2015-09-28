<?php 
		// Panggil semua fungsi yang dibutuhkan (semuanya ada di folder config)
		require("../fpdf/fpdf.php");
		include("../config/koneksi.php");
		class PDF extends FPDF
		{
			function Header()
			{
				// Logo
				$this->Image('../templates/images/logodepkeu.png',10,10,20);
				// Times bold 13
				$this->SetFont('Times','B',13);
				// Move to the right
				$this->Cell(20);
				// Title 1
				$this->Cell(165,5,'KEMENTERIAN KEUANGAN REPUBLIK INDONESIA',0,1,'C');
				// Times bold 12
				$this->SetFont('Times','B',12);
				// Move to the right
				$this->Cell(20);
				// Title 2
				$this->Cell(165,5,'DIREKTORAT JENDERAL PERBENDAHARAAN',0,1,'C');
				// Times bold 12
				$this->SetFont('Times','B',11);
				// Move to the right
				$this->Cell(20);
				// Title 3
				// Query  kanwil
				$qKanwil	= mysql_query("SELECT nmkanwil FROM t_kanwil WHERE aktif='1'")or die(mysql_error);
				$rKanwil	= mysql_fetch_array($qKanwil);
				$nmKanwil	= $rKanwil['nmkanwil'];
				$this->Cell(165,5,'KANTOR WILAYAH '.$nmKanwil,0,1,'C');
				// Times bold 12
				$this->SetFont('Times','',11);
				// Move to the right
				$this->Cell(20);
				// Title 4
				// Query KPPN
				$qKppn		= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$rKppn		= mysql_fetch_array($qKppn);
				$nmKppn	= $rKppn['nmkppn'];
				$this->Cell(165,4,'KANTOR PELAYANAN PERBENDAHARAAN '.$nmKppn,0,1,'C');
				// Times  8
				$this->SetFont('Times','',8);
				// Move to the right
				$this->Cell(20);
				// Title 5
				$qryKppn	= mysql_query("SELECT almkppn,kotakppn,telkppn,email,kodepos,faxkppn,website,smsgateway FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$rsltKppn	= mysql_fetch_array($qryKppn);
				$almKppn	= $rsltKppn['almkppn']." ".$rsltKppn['kotakppn']." ".$rsltKppn['kodepos']." Telepon: ".$rsltKppn['telkppn']." Faksimile: ".$rsltKppn['faxkppn'];
				$this->Cell(165,4,$almKppn,0,1,'C');
				// Move to the right
				$this->Cell(20);
				// Title 6
				$queryKppn= mysql_query("SELECT email,website,smsgateway FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$resultKppn= mysql_fetch_array($queryKppn);
				$webKppn	= "Website: ".$resultKppn['website']." Email: ".$resultKppn['email']." SMS Gateway: ".$resultKppn['smsgateway'];
				$this->Cell(165,3,$webKppn,0,1,'C');
				// Draw line
				$this->Line(10,39.5,200,39.5);
				$this->Line(10,40,200,40);
				// Line break
				$this->Ln(5);
			}
		}
		$pdf = new PDF('P','mm','A4');
		$pdf->AddPage();
		// Konsep SKPP ==========
		$pdf->SetFont('Times','',11);
		// Today's date
		$months 	= Array (1=>"Januari", 2=>"Pebruari", 3=>"Maret", 4=>"April",	5=>"Mei", 6=>"Juni", 7=>"Juli", 8=>"Agustus", 9=>"September", 10=>"Oktober", 11=>"Nopember", 12=>"Desember");
		$bln		= $months[date("n")];
		$tgl			= date("d");
		$thn		= date("Y");
		$pdf->Cell(190,7,$tgl." ".$bln." ".$thn,0,1,'R');
		// SURAT PENGANTAR
		$pdf->SetFont('','BUI','');
		$pdf->Cell(190,6,'SURAT PENGANTAR',0,1,'C');
		// Nomor SP
		$pdf->SetFont('','','');
		$pdf->Cell(190,6,'Nomor: SP-         /WPB.14/KP.02/2011',0,1,'C');
		// Line break
		$pdf->Ln(10);
		// Tujuan SKPP
		
		$pdf->SetFont('','B','');
		$
		$pdf->Output();	
?>