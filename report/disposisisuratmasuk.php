<?php
require_once(dirname(dirname(__FILE__)) . '/fpdf/fpdf.php');
require_once(dirname(dirname(__FILE__)) . '/config/koneksi.php');
require_once(dirname(dirname(__FILE__)) . '/config/helper.php');

$helper				= new helper();
$idsurat			= $_POST['idsurat'];
$noagenda			= $_POST['noagenda'];
$nomorsuratmasuk	= $_POST['nomorsuratmasuk'];
$tglsurat			= $_POST['tglsurat'];
$asalsurat			= $_POST['asalsurat'];
$perihal			= $_POST['perihal'];
$disposisi			= $_POST['disposisi'];
$Batasselesai		= $_POST['batasselesai'];
$batasselesai		= $helper->dateConvert($Batasselesai);
// header dan footer
class PDF extends FPDF{
	
	function Header()
			{
				// Logo
				$this->Image(dirname(dirname(__FILE__)) . '/templates/images/logodepkeu.png',1,1,1.5,1.5);
				// Times bold 13
				$this->SetFont('Times','B',9);
				// Move to the right
				$this->Cell(0.5);
				// Title 1
				$this->Cell(13,0.4,'KEMENTERIAN KEUANGAN REPUBLIK INDONESIA',0,1,'C');
				// Times bold 12
				$this->SetFont('Times','B',8);
				// Move to the right
				$this->Cell(0.5);
				// Title 2
				$this->Cell(13,0.4,'DIREKTORAT JENDERAL PERBENDAHARAAN',0,1,'C');
				// Times bold 12
				$this->SetFont('Times','B',7);
				// Move to the right
				$this->Cell(0.5);
				// Title 3
				// Query  kanwil
				$qKanwil	= mysql_query("SELECT nmkanwil FROM t_kanwil WHERE aktif='1'")or die(mysql_error);
				$rKanwil	= mysql_fetch_object($qKanwil);
				$nmKanwil	= $rKanwil->nmkanwil;
				$this->Cell(13,0.4,'KANTOR WILAYAH '.$nmKanwil,0,1,'C');
				// Times bold 12
				$this->SetFont('Times','',7);
				// Move to the right
				$this->Cell(0.5);
				// Title 4
				// Query KPPN
				$qKppn		= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$rKppn		= mysql_fetch_array($qKppn);
				$nmKppn	= $rKppn['nmkppn'];
				$this->Cell(13,0.3,'KANTOR PELAYANAN PERBENDAHARAAN '.$nmKppn,0,1,'C');
				// Times  8
				$this->SetFont('Times','',5);
				// Move to the right
				$this->Cell(0.5);
				// Title 5
				$qryKppn	= mysql_query("SELECT almkppn,kotakppn,telkppn,email,kodepos,faxkppn,website,smsgateway FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$rsltKppn	= mysql_fetch_array($qryKppn);
				$almKppn	= $rsltKppn['almkppn']." ".$rsltKppn['kotakppn']." ".$rsltKppn['kodepos']." Telepon: ".$rsltKppn['telkppn']." Faksimile: ".$rsltKppn['faxkppn'];
				$this->Cell(13,0.3,$almKppn,0,1,'C');
				// Move to the right
				$this->Cell(0.5);
				// Title 6
				$queryKppn= mysql_query("SELECT email,website,smsgateway FROM t_kppn WHERE kddefa='1'")or die(mysql_error);
				$resultKppn= mysql_fetch_array($queryKppn);
				$webKppn	= "Website: ".$resultKppn['website']." Email: ".$resultKppn['email']." SMS Gateway: ".$resultKppn['smsgateway'];
				$this->Cell(13,0.3,$webKppn,0,1,'C');
				// Draw line
				//$this->Line(1.0,3.95,20.0,3.95);
				//$this->Line(1.0,4.0,20.0,4.0);
				$timezone = "Asia/Jakarta";
				if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
				$datedisposisi= date("Y-m-d H:i:s");
				$idsurat	= $_POST['idsurat'];
				$username 	= $_POST['username']; 
				// Update user, tanggal, status pencetakan disposisi. Status proses ='2'
				if(isset($_POST['reportcetakdisposisi']) && $_POST['reportcetakdisposisi'] == "Cetak"){
					$statproses			= $_POST['statproses'];
					if($statproses == 1){
						mysql_query("UPDATE d_suratmasuk SET usertrmsekret='$username', timetrmsekret='$datedisposisi', statproses='2' WHERE idsurat='$idsurat'");
					}elseif($statproses == 2){
						mysql_query("UPDATE d_suratmasuk SET statproses='3' WHERE idsurat='$idsurat'");
					}
				}
				// Line break
				$this->Ln(0.3);
			}
			
	
	function Footer(){
	$this->SetTextColor(015,015,015);
	$this->SetFont('','U');
	$this->SetY(-2,5);
	}
}
//menampilkan data
$query	= mysql_query("SELECT DISTINCT timeloket FROM d_suratmasuk WHERE idsurat='$idsurat'");
$hasil	= mysql_fetch_object($query);
	$Dateloket	= strtotime($hasil->timeloket);
	$dateloket	= date("d-m-Y",$Dateloket);
	
$pdf=new PDF('P','cm','A5');
$pdf->Open();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B','6');
$pdf->Cell(13,0.4,'LEMBAR DISPOSISI','B',0,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','','6');
$pdf->Cell(13,0.4,'PERHATIAN: Dilarang memisahkan sehelai surat pun yang tergabung dalam berkas ini','B',0,'C',0);
$pdf->Ln();
$pdf->Cell(3,0.4,'Tanggal Penerimaan Surat:',0,0,'L');
$pdf->Cell(0.4,0.4,$dateloket,0,0,'L');
$pdf->Cell(5,0.4,'No.Agenda:',0,0,'R');
$pdf->Cell(2,0.4,$noagenda,0,1,'R');
//next row
$pdf->Line(1,4.6,14,4.6);
$pdf->Cell(1.75,0.4,'No./Tgl.Surat:',0,0,'L');
$pdf->Cell(3.35,0.4,$nomorsuratmasuk,0,0,'L');
$pdf->Cell(2,0.4,'/',0,0,'L');
$pdf->Cell(1,0.4,$tglsurat,0,1,'L');
//next row
$pdf->Cell(1.75,0.4,'Dari               :',0,0,'L');
$pdf->Cell(2,0.4,$asalsurat,0,1,'L');
//next row
$pdf->Cell(1.75,0.4,'Perihal          :',0,0,'L');
$pdf->Cell(2,0.4,$perihal,0,1,'L');
//next row
$pdf->Cell(1.75,0.4,'Sifat              :',0,0,'L');
$pdf->Line(3.4,5.9,3.6,5.9); //checkbox kilat
$pdf->Line(3.4,5.9,3.4,6.1);
$pdf->Line(3.4,6.1,3.6,6.1);
$pdf->Line(3.6,5.9,3.6,6.1);
$pdf->Cell(1.5,0.4,'Kilat',0,0,'L');
$pdf->Line(5.9,5.9,5.9,6.1); //garis y //checkbox sangat segera
$pdf->Line(6.1,5.9,6.1,6.1);
$pdf->Line(5.9,6.1,6.1,6.1);
$pdf->Line(5.9,5.9,6.1,5.9);
if($_POST['sangatsegera'] == "1")
{
	$pdf->Line(5.9,5.9,6.1,6.1); //garis silang
	$pdf->Line(5.9,6.1,6.1,5.9); //garis silang
}
$pdf->Cell(3.2,0.4,'Sangat Segera',0,0,'L');
$pdf->Line(8.4,5.9,8.4,6.1); //garis y1 //checkbox segera
$pdf->Line(8.6,5.9,8.6,6.1); //garis y2
$pdf->Line(8.4,6.1,8.6,6.1); //garis x1
$pdf->Line(8.4,5.9,8.6,5.9); //garis x2
if($_POST['segera'] == "1")
{
	$pdf->Line(8.4,5.9,8.6,6.1); //garis silang
	$pdf->Line(8.4,6.1,8.6,5.9); //garis silang
}
$pdf->Cell(2.3,0.4,'Segera',0,0,'L');
$pdf->Line(10.5,5.9,10.5,6.1); //garis y1 //checkbox biasa
$pdf->Line(10.7,5.9,10.7,6.1); //garis y2
$pdf->Line(10.5,5.9,10.7,5.9); //garis x1
$pdf->Line(10.5,6.1,10.7,6.1); //garis x2
if($_POST['biasa'] == "1")
{
	$pdf->Line(10.5,5.9,10.7,6.1); //garis silang
	$pdf->Line(10.5,6.1,10.7,5.9); //garis silang
}
$pdf->Cell(2.3,0.4,'Biasa',0,1,'L');
$pdf->Line(1,6.5,14,6.5);
//next row
$pdf->Ln();
$pdf->SetFont('Arial','UB','6');
$pdf->Cell(3.47,0.4,'DISPOSISI KEPALA KANTOR:',0,'L',0);
$pdf->Ln(0.5);
$pdf->SetFont('Arial','','6');
$pdf->Rect(2.5,7.2,0.2,0.2,'D'); //checkbox kasubag umum
if($_POST['um'] == "1"){
$pdf->Line(2.5,7.2,2.7,7.4);
$pdf->Line(2.5,7.4,2.7,7.2);
}
$pdf->Cell(3.47,0.4,'Kasubag Umum',0,'L',0);
$pdf->Rect(7.5,7.2,0.2,0.2,'D'); //checkbox kasi verak
if($_POST['vr'] == "1"){
$pdf->Line(7.5,7.2,7.7,7.4);
$pdf->Line(7.5,7.4,7.7,7.2);
}
$pdf->Cell(4.47,0.4,'Kasi Verak',0,'L',0);
$pdf->Ln();
$pdf->Rect(2.5,7.6,0.2,0.2,'D'); //checkbox kasi pencairan dana
if($_POST['pd'] == "1"){
$pdf->Line(2.5,7.6,2.7,7.8);
$pdf->Line(2.5,7.8,2.7,7.6);
}
$pdf->Cell(3.95,0.4,'Kasi Pencairan Dana',0,'L',0);
$pdf->Rect(7.5,7.6,0.2,0.2,'D'); //checkbox kasi bank giro pos
if($_POST['bp'] == "1"){
$pdf->Line(7.5,7.6,7.7,7.8);
$pdf->Line(7.5,7.8,7.7,7.6);
}
$pdf->Cell(4.8,0.4,'Kasi Bank Giro Pos',0,'L',0);
$pdf->Ln();
$pdf->Rect(2.5,8,0.2,0.2,'D'); //checkbox sekretariat
if($_POST['sk'] == "1"){
$pdf->Line(2.5,8,2.7,8.2);
$pdf->Line(2.5,8.2,2.7,8);
}
$pdf->Cell(3,0.4,'Sekretariat',0,'L',0);
$pdf->Line(1,8.5,14,8.5);
$pdf->Ln(0.7);
$pdf->SetFont('Arial','UB','6');
$pdf->Cell(1.68,0.4,'PETUNJUK:',0,'L',0);
$pdf->Ln(0.5);
$pdf->SetFont('Arial','','6');
$pdf->Rect(2.5,9.2,0.2,0.2,'D'); //checkbox proses
$pdf->Cell(2.68,0.4,'Proses',0,'L',0);
$pdf->Rect(6.1,9.2,0.2,0.2,'D'); //checkbox jawab
if($_POST['jawab'] == "1")
{
	$pdf->Line(6.1,9.2,6.3,9.4);
	$pdf->Line(6.1,9.4,6.3,9.2);
}
$pdf->Cell(3.5,0.4,'Jawab',0,'L',0);
$pdf->Rect(9.8,9.2,0.2,0.2,'D'); //checkbox simpan
if($_POST['simpan'] == "1")
{
	$pdf->Line(9.8,9.2,10,9.4);
	$pdf->Line(9.8,9.4,10,9.2);
}
$pdf->Cell(3.8,0.4,'Simpan',0,'L',0);
$pdf->Ln();
$pdf->Rect(2.5,9.6,0.2,0.2,'D'); //checkbox laksanakan
$pdf->Cell(3.16,0.4,'Laksanakan',0,'L',0);
$pdf->Rect(6.1,9.6,0.2,0.2,'D'); //checkbox edarkan
if($_POST['edarkan'] == "1")
{
	$pdf->Line(6.1,9.6,6.3,9.8);
	$pdf->Line(6.1,9.8,6.3,9.6);
}
$pdf->Cell(3.2,0.4,'Edarkan',0,'L',0);
$pdf->Rect(9.8,9.6,0.2,0.2,'D'); //checkbox ingatkan
if($_POST['ingatkan'] == "1")
{
	$pdf->Line(9.8,9.6,10,9.8);
	$pdf->Line(9.8,9.8,10,9.6);
}
$pdf->Cell(3.73,0.4,'Ingatkan',0,'L',0);
$pdf->Ln();
$pdf->Rect(2.5,10,0.2,0.2,'D'); //checkbox pedomani
$pdf->Cell(2.97,0.4,'Pedomani',0,'L',0);
$pdf->Rect(6.1,10,0.2,0.2,'D'); //checkbox teliti dan pendapat
if($_POST['telitipendapat'] == "1")
{
	$pdf->Line(6.1,10,6.3,10.2);
	$pdf->Line(6.1,10.2,6.3,10);
}
$pdf->Cell(4.2,0.4,'Teliti & Pendapat',0,'L',0);
$pdf->Rect(9.8,10,0.2,0.2,'D'); //checkbox perbanyak
$pdf->Cell(3.8,0.4,'Perbanyak .... kali',0,'L',0);
$pdf->Ln();
$pdf->Rect(2.5,10.4,0.2,0.2,'D'); //checkbox untuk diketahui
if($_POST['untukdiketahui'] == "1")
{
	$pdf->Line(2.5,10.4,2.7,10.6);
	$pdf->Line(2.5,10.6,2.7,10.4);
}
$pdf->Cell(3.52,0.4,'Untuk Diketahui',0,'L',0);
$pdf->Rect(6.1,10.4,0.2,0.2,'D'); //checkbox bicarakan dengan saya
if($_POST['bicarakandgsaya'] == "1")
{
	$pdf->Line(6.1,10.4,6.3,10.6);
	$pdf->Line(6.1,10.6,6.3,10.4);
}
$pdf->Cell(4.3,0.4,'Bicarakan dengan Saya',0,'L',0);
$pdf->Cell(3.13,0.4,'asli kepada .........',0,'L',0);
$pdf->Ln(0.7);
$pdf->SetFont('Arial','UB','6');
$pdf->Cell(3.5,0.4,'CATATAN KEPALA KANTOR:',0,1,'L',0);
$pdf->SetFont('Arial','','6');
$pdf->Cell(3.5,0.4,$disposisi,0,1,'L');
if($batasselesai != "00-00-0000"){
$pdf->Cell(3.5,0.4,'Tanggal batas penyelesaian surat tanggapan:',0,0,'L');
$pdf->SetFont('Arial','IB','6');
$pdf->Cell(1.0);
$pdf->Cell(0,0.4,$batasselesai,0,0,'L');
}
$pdf->Line(1,10.8,14,10.8);
$pdf->Ln(2.0);
$pdf->SetFont('Arial','UB','6');
$pdf->Cell(5.1,0.4,'DISPOSISI KASUBAG UMUM/KEPALA SEKSI:',0,'L',0);
$pdf->Ln(0.5);
$pdf->SetFont('Arial','','6');
$pdf->Cell(1.382,0.4,'Kepada  :',0,'L',0);
$pdf->Ln();
$pdf->Cell(1.38,0.4,'Petunjuk:',0,'L',0);
$pdf->Ln();

$pdf->Output();
?>
