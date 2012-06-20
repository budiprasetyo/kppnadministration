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
			function Footer()
			{
				// Posisi 7 cm dari bawah
				$this->SetY(-70);
				// Times 11
				$this->SetFont('Times','',11);
				// Tanda terima
				$this->Cell(125,10,'Tanda Terima:',0,0,'L');
				//  Referensi nama jabatan
				$qNmjabatan	= mysql_query("SELECT nmjabatan FROM t_pejabt WHERE ketjabatan='0'");
				$rNmjabatan	= mysql_fetch_array($qNmjabatan);
				$nmjabatan		= $rNmjabatan[0];
				$this->Cell(70,10,$nmjabatan,0,1,'L');
				// Next row
				// Diterima oleh
				$this->Cell(40,6,"Diterima oleh",0,0,'L');
				$this->Cell(5,6,":",0,0,'C');
				$this->Cell(70,6,".................................",0,0,'L');
				$this->Cell(80,6,"",0,1,'L');
				// Next row
				// Nama/NIP
				$this->Cell(40,6,"Nama/NIP",0,0,'L');
				$this->Cell(5,6,":",0,0,'C');
				$this->Cell(70,6,".................................",0,0,'L');
				$this->Cell(80,6,"",0,1,'L');
				// Next row
				// Tanggal
				$this->Cell(40,6,"Tanggal",0,0,'L');
				$this->Cell(5,6,":",0,0,'C');
				$this->Cell(80,6,".................................",0,0,'L');
				// Nama pejabat
				$qNama	= mysql_query("SELECT nama,nip FROM t_pejabt WHERE ketjabatan='0'");
				$rNama		= mysql_fetch_array($qNama);
				$nama		= $rNama[0];
				$this->Cell(70,6,$nama,0,1,'L');
				// Next row
				//  Cap dinas
				$this->Cell(40,6,"Cap dinas",0,0,'L');
				$this->Cell(5,6,":",0,0,'C');
				$this->Cell(80,6,"",0,0,'L');
				$nip		= $rNama[1];
				$this->Cell(70,6,$nip,0,1,'L');
				// Next row
				$this->Cell(40,8,"",0,0,'L');
				$this->Cell(5,8,"",0,0,'C');
				$this->Cell(80,8,"",0,0,'L');
				$this->Cell(70,8,"",0,1,'L');
				//  Catatan dan nama kepala kantor
				// Times 8
				$this->SetFont('Times','',8);
				$this->Cell(20,5,"Catatan",0,0,'L');
				$this->Cell(5,5,":",0,0,'C');
				$this->Cell(170,5,"Harap setelah tanda terima diisi",0,1,'L');
				// Next row
				$this->SetFont('Times','',8);
				$this->Cell(20,5,"",0,0,'L');
				$this->Cell(5,5,"",0,0,'C');
				$this->Cell(170,5,"lembar ke-2 mohon dikirim kembali",0,1,'L');
			}
		}
		$pdf = new PDF('P','mm','A4');
		$pdf->AddPage();
		$idskpp	= $_POST['idSkpp'];
		// Konsep SKPP GPP ==========
		if($_POST['reportkonsepskpp'] == 'Konsep'){
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
			$pdf->Ln(7);
			// Jika SKPP adalah SKPP Pindah
			if($_POST['kdjenskpp'] == '01'){
					// Tujuan SKPP
					$qSkpp	= mysql_query("SELECT noskpp,tgskpp,anskpp,tujuanskpp,kotatujuan,kdsatker,satkerbaru,nip,pangkat,alamat FROM d_skpp WHERE id_skpp='$idskpp'")or die(mysql_error);
					$rSkpp	= mysql_fetch_array($qSkpp);
					$tujuanskpp 	= $rSkpp['tujuanskpp'];
					$kotatujuan		= $rSkpp['kotatujuan'];
					$pdf->SetFont('','B','');
					// KPA Satker asal
					$pdf->Cell(190,6,"Yth. KPA ".$tujuanskpp,0,1,'L');
					$pdf->Cell(190,6,"Di ".$kotatujuan,0,1,'L');
					$pdf->Ln(5);
					// Starting with table now
					$pdf->SetFont('','','');
					$pdf->Cell(10,10,"No.",1,0,'C');
					$pdf->Cell(115,10,"Uraian",1,0,'C');
					$pdf->Cell(25,10,"Bilangan",1,0,'C');
					$pdf->Cell(40,10,"Catatan",1,1,'C');
					// Body table
					$pdf->Cell(10,6,"1",'L',0,'C');
					$pdf->Cell(115,6,"Lembar I dan II SKPP Satuan Kerja",'LR',0,'L');
					$pdf->Cell(25,6,"2 (dua)",'R',0,'C');
					$pdf->Cell(40,6,"Disampaikan",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					// Nama Satker
					$kdsatker	= $rSkpp['kdsatker'];
					$nmSatker	= mysql_query("SELECT nmsatker FROM t_satker WHERE kdsatker='$kdsatker'");
					$rnmSatker	= mysql_fetch_array($nmSatker);
					$nmsatker	= $rnmSatker['nmsatker'];
					$pdf->Cell(115,6,$nmsatker.":",'LR',0,'L');
					$pdf->Cell(25,6,"lembar",'R',0,'C');
					$pdf->Cell(40,6,"dengan hormat untuk",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Nomor",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// No SKPP
					$noskpp 	= $rSkpp['noskpp'];
					$pdf->Cell(90,6,$noskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"dipergunakan",'R',1,'C');
					//Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Tanggal",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// Tgl SKPP
					$tgskpp		= $rSkpp['tgskpp'];
					$pdf->Cell(90,6,$tgskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"seperlunya",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Atas Nama",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// Atas nama SKPP
					$anskpp	= $rSkpp['anskpp'];
					$pdf->Cell(90,6,$anskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"NIP",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// NIP
					$nip	= $rSkpp['nip'];
					$pdf->Cell(90,6,$nip,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Pangkat",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// Pangkat
					$pangkat	= $rSkpp['pangkat'];
					$pdf->Cell(90,6,$pangkat,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,10,"2",'L',0,'C');
					$pdf->Cell(115,10,"Tembusan disampaikan kepada:",'LR',0,'L');
					$pdf->Cell(25,10,"",'R',0,'C');
					$pdf->Cell(40,10,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"1.",0,0,'L');
					$pdf->Cell(110,6,"Lembar I kepada Sdr./Sdri.".$anskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					//Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"",0,0,'L');
					// Alamat
					$alamat		= $rSkpp['alamat'];
					$pdf->Cell(110,6,"d.a.".$alamat,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"2.",0,0,'L');
					// Satker baru
					$pdf->Cell(110,6,"Lembar II untuk Satuan Kerja",'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"",0,0,'L');
					// Satker baru
					$satkerbaru		= $rSkpp['satkerbaru'];
					$pdf->Cell(110,6,$satkerbaru,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"3.",0,0,'L');
					// Nama KPPN
					$qKppn		= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
					$rKppn		= mysql_fetch_array($qKppn);
					$nmKppn	= $rKppn['nmkppn'];
					$pdf->Cell(110,6,'Lembar III untuk KPPN '.$nmKppn,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"4.",0,0,'L');
					// Nama Satker asal
					$pdf->Cell(110,6,"Lembar IV pertinggal Satuan Kerja",'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"",0,0,'L');
					// Nama Satker asal
					$pdf->Cell(110,6,$nmsatker,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// End's of table
					$pdf->Cell(10,10,"",'BLR',0,'C');
					$pdf->Cell(115,10,"",'BR',0,'L');
					$pdf->Cell(25,10,"",'BR',0,'C');
					$pdf->Cell(40,10,"",'BR',1,'C');
			}
			// Jika SKPP adalah SKPP Pensiun
			elseif($_POST['kdjenskpp'] == '02'){
				// Tujuan SKPP
				$qSkpp	= mysql_query("SELECT noskpp,tgskpp,anskpp,tujuanskpp,kotatujuan,kdsatker,satkerbaru,nip,pangkat,alamat FROM d_skpp WHERE id_skpp='$idskpp'")or die(mysql_error);
				$rSkpp	= mysql_fetch_array($qSkpp);
				$tujuanskpp 	= $rSkpp['tujuanskpp'];
				$kotatujuan		= $rSkpp['kotatujuan'];
				$pdf->SetFont('','B','');
					// KPA Asal
					$pdf->Cell(190,6,"Yth. KPA ".$tujuanskpp,0,1,'L');
					$pdf->Cell(190,6,"Di ".$kotatujuan,0,1,'L');
					$pdf->Ln(5);
					// Starting with table now
					$pdf->SetFont('','','');
					$pdf->Cell(10,10,"No.",1,0,'C');
					$pdf->Cell(115,10,"Uraian",1,0,'C');
					$pdf->Cell(25,10,"Bilangan",1,0,'C');
					$pdf->Cell(40,10,"Catatan",1,1,'C');
					// Body table
					$pdf->Cell(10,6,"1",'L',0,'C');
					$pdf->Cell(115,6,"Lembar I dan II SKPP Satuan Kerja",'LR',0,'L');
					$pdf->Cell(25,6,"2 (dua)",'R',0,'C');
					$pdf->Cell(40,6,"Disampaikan",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					// Nama Satker
					$kdsatker	= $rSkpp['kdsatker'];
					$nmSatker	= mysql_query("SELECT nmsatker FROM t_satker WHERE kdsatker='$kdsatker'");
					$rnmSatker	= mysql_fetch_array($nmSatker);
					$nmsatker	= $rnmSatker['nmsatker'];
					$pdf->Cell(115,6,$nmsatker.":",'LR',0,'L');
					$pdf->Cell(25,6,"lembar",'R',0,'C');
					$pdf->Cell(40,6,"dengan hormat untuk",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Nomor",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// No SKPP
					$noskpp 	= $rSkpp['noskpp'];
					$pdf->Cell(90,6,$noskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"dipergunakan",'R',1,'C');
					//Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Tanggal",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// Tgl SKPP
					$tgskpp		= $rSkpp['tgskpp'];
					$pdf->Cell(90,6,$tgskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"seperlunya",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Atas Nama",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// Atas nama SKPP
					$anskpp	= $rSkpp['anskpp'];
					$pdf->Cell(90,6,$anskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"NIP",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// NIP
					$nip	= $rSkpp['nip'];
					$pdf->Cell(90,6,$nip,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'L',0,'C');
					$pdf->Cell(20,6,"Pangkat",'L',0,'L');
					$pdf->Cell(5,6,":",0,0,'C');
					// Pangkat
					$pangkat	= $rSkpp['pangkat'];
					$pdf->Cell(90,6,$pangkat,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,10,"2",'L',0,'C');
					$pdf->Cell(115,10,"Tembusan disampaikan kepada:",'LR',0,'L');
					$pdf->Cell(25,10,"",'R',0,'C');
					$pdf->Cell(40,10,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"1.",0,0,'L');
					$pdf->Cell(110,6,"Lembar I dan II kepada PT Taspen (Persero)",'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					//Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"",0,0,'L');
					// Kota Tujuan
					$pdf->Cell(110,6,"di ".$kotatujuan,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"2.",0,0,'L');
					// Pegawai
					$pdf->Cell(110,6,"Lembar III untuk kepada Sdr./Sdri.".$anskpp,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"3.",0,0,'L');
					// Nama KPPN
					$qKppn		= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
					$rKppn		= mysql_fetch_array($qKppn);
					$nmKppn	= $rKppn['nmkppn'];
					$pdf->Cell(110,6,'Lembar IV untuk KPPN '.$nmKppn,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"4.",0,0,'L');
					// Nama Satker asal
					$pdf->Cell(110,6,"Lembar V pertinggal Satuan Kerja",'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// Next Row
					$pdf->Cell(10,6,"",'LR',0,'C');
					$pdf->Cell(5,6,"",0,0,'L');
					// Nama Satker asal
					$pdf->Cell(110,6,$nmsatker,'R',0,'L');
					$pdf->Cell(25,6,"",'R',0,'C');
					$pdf->Cell(40,6,"",'R',1,'C');
					// End's of table
					$pdf->Cell(10,10,"",'BLR',0,'C');
					$pdf->Cell(115,10,"",'BR',0,'L');
					$pdf->Cell(25,10,"",'BR',0,'C');
					$pdf->Cell(40,10,"",'BR',1,'C');
			}
		}
		$pdf->Output();	
?>