<?php 
		// Panggil semua fungsi yang dibutuhkan (semuanya ada di folder config)
		require("../fpdf/fpdf.php");
		include("../config/koneksi.php");
		class PDF extends FPDF
		{
			function Header()
			{
				// Logo
				$this->Image('../templates/images/logodepkeu.png',10,10,10);
				// Times bold 13
				$this->SetFont('Times','',9);
				// Move to the right
				$this->Cell(10);
				// Title 1
				$this->Cell(165,3,'KEMENTERIAN KEUANGAN REPUBLIK INDONESIA',0,1,'L');
				// Times bold 12
				$this->SetFont('Times','',9);
				// Move to the right
				$this->Cell(10);
				// Title 2
				$this->Cell(165,3,'DIREKTORAT JENDERAL PERBENDAHARAAN',0,1,'L');
				// Times bold 12
				$this->SetFont('Times','',9);
				// Move to the right
				$this->Cell(10);
				// Title 3
				// Query  kanwil
				$qKanwil	= mysql_query("SELECT nmkanwil FROM t_kanwil WHERE aktif='1'")or die(mysql_error);
				$rKanwil	= mysql_fetch_array($qKanwil);
				$nmKanwil	= $rKanwil['nmkanwil'];
				$this->Cell(165,3,'KANTOR WILAYAH '.$nmKanwil,0,1,'L');
				// Times bold 12
				$this->SetFont('Times','',9);
				// Move to the right
				$this->Cell(10);
				// Title 4
				// Query KPPN
				$qKppn		= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$rKppn		= mysql_fetch_array($qKppn);
				$nmKppn	= $rKppn['nmkppn'];
				$this->Cell(165,3,'KANTOR PELAYANAN PERBENDAHARAAN '.$nmKppn,0,1,'L');
				// Times  8
				$this->SetFont('Times','',11);
				// Move to the right
				$this->Cell(20);
				// Line break
				$this->Ln(5);
				$timezone = "Asia/Jakarta";
				if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
				$dateKonsep	= date("Y-m-d H:i:s");
				// Judul Kop Tabel
				// SURAT PENGANTAR
				$this->SetFont('','BI','');
				$this->Cell(190,5,'KONFIRMASI PENERIMAAN NEGARA',0,1,'C');
				$this->SetFont('','','');
				$this->SetFont('Times','',8);
				// Today's date
				$months 	= Array (1=>"Januari", 2=>"Pebruari", 3=>"Maret", 4=>"April",	5=>"Mei", 6=>"Juni", 7=>"Juli", 8=>"Agustus", 9=>"September", 10=>"Oktober", 11=>"Nopember", 12=>"Desember");
				$bln		= $months[date("n")];
				$tgl			= date("d");
				$thn		= date("Y");
				$this->Cell(190,7,"Tanggal: ".$tgl." ".$bln." ".$thn,0,1,'C');
				// Line break
				$this->Ln(7);
			}
		}
		$pdf = new PDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Times','B',7);
		$pdf->Cell(5,5,'No.',1,0,'C');
		$pdf->Cell(20,5,'NPWP',1,0,'C');
		$pdf->Cell(50,5,'Nama WP',1,0,'C');
		$pdf->Cell(40,5,'NTPN - NTB',1,0,'C');
		$pdf->Cell(35,5,'Nama Bank/Pos',1,0,'C');
		$pdf->Cell(10,5,'Akun',1,0,'C');
		$pdf->Cell(23,5,'Nilai Setor',1,1,'C');
		// Jumlah data yang akan dilakukan loop
		$jumldata		= $_POST['jumldata'];
		$pdf->SetFont('Times','',7);
		// Loop
		for($i = 1; $i <= $jumldata; $i++) { 
		if(isset($_POST['cetak'.$i]) > 0){
		// No.
		$pdf->Cell(5,5,$i,1,0,'C');
		$kdnpwp	= $_POST['kdnpwp'.$i];
		$pdf->Cell(20,5,$kdnpwp,1,0,'C');
		$nmwajbay	= trim($_POST['nmwajbay'.$i]);
		$pdf->Cell(50,5,$nmwajbay,1,0,'L');
		$kdntpp	= trim($_POST['kdntpp'.$i]);
		$kdntb		= trim($_POST['kdntb'.$i]);
		$pdf->Cell(40,5,$kdntpp.'-'.$kdntb,1,0,'C');
		$nmbankpos	= $_POST['nmbankpos'.$i];
		$pdf->Cell(35,5,$nmbankpos,1,0,'L');
		$kdmap	= $_POST['kdmap'.$i];
		$pdf->Cell(10,5,$kdmap,1,0,'C');
		$nilsetor	= $_POST['nilsetor'.$i];
		$pdf->Cell(23,5,$nilsetor,1,1,'R');
			}
		}
		// Posisi 7 cm dari bawah
		$pdf->SetY(-70);
		// Times 11
		$pdf->SetFont('Times','',11);
		// Tanda terima
		$pdf->Cell(125,10,'Tanda Terima:',0,0,'L');
		//  Referensi nama jabatan
		$qNmjabatan	= mysql_query("SELECT nmjabatan FROM t_pejabt WHERE ketjabatan='6'");
		$rNmjabatan	= mysql_fetch_array($qNmjabatan);
		$nmjabatan		= $rNmjabatan[0];
		$pdf->Cell(70,10,$nmjabatan,0,1,'L');
		// Next row
		// Diterima oleh
		$pdf->Cell(40,6,"Diterima oleh",0,0,'L');
		$pdf->Cell(5,6,":",0,0,'C');
		$pdf->Cell(70,6,".................................",0,0,'L');
		$pdf->Cell(80,6,"",0,1,'L');
		// Next row
		// Nama/NIP
		$pdf->Cell(40,6,"Nama/NIP",0,0,'L');
		$pdf->Cell(5,6,":",0,0,'C');
		$pdf->Cell(70,6,".................................",0,0,'L');
		$pdf->Cell(80,6,"",0,1,'L');
		// Next row
		// Tanggal
		$pdf->Cell(40,6,"Tanggal",0,0,'L');
		$pdf->Cell(5,6,":",0,0,'C');
		$pdf->Cell(80,6,".................................",0,0,'L');
		// Nama pejabat
		$qNama	= mysql_query("SELECT nama,nip FROM t_pejabt WHERE ketjabatan='6'");
		$rNama		= mysql_fetch_array($qNama);
		$nama		= $rNama[0];
		$pdf->Cell(70,6,$nama,0,1,'L');
		// Next row
		//  Cap dinas
		$pdf->Cell(40,6,"Cap dinas",0,0,'L');
		$pdf->Cell(5,6,":",0,0,'C');
		$pdf->Cell(80,6,"",0,0,'L');
		$nip		= $rNama[1];
		$pdf->Cell(70,6,$nip,0,1,'L');
		// Next row
		$pdf->Cell(40,8,"",0,0,'L');
		$pdf->Cell(5,8,"",0,0,'C');
		$pdf->Cell(80,8,"",0,0,'L');
		$pdf->Cell(70,8,"",0,1,'L');
		
		$pdf->Output();	
?>