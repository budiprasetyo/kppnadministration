<?php

global $timezone;
$timezone 	= "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

// Halaman utama (Home)
if ($_GET['module']=='home'){
}

// Modul perekaman data surat masuk secara manual
elseif($_GET['module'] == 'terimasuratmasukmanual'){
echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
	
		
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  enctype='multipart/form-data'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat masuk manual</h1>
					<p>Data Surat Masuk Manual</p>
					<label>Nomor Agenda
					<span class='small'>Agd suratmasuk cth:1 atau 12</span>
					</label>
					<input type='text' id='noagenda' class='required' minlength='1' name='noagendaman' maxlength='10'  onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'nomorsuratmasuk')\" />
	
					<label>Nomor Surat
					<span class='small'>Isikan no.surat masuk</span>
					</label>
					<input type='text' id='nomorsuratmasuk' class='required' minlength='3' name='nomorsuratmasuk' maxlength='50' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tglsurat')\" />
					
					<label>Tanggal Surat
					<span class='small'>Isikan tgl.surat masuk</span>
					</label>
					<input type='text' id='tanggal' name='tglsurat'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
					
					<label>Asal Surat
					<span class='small'>Isikan asal surat masuk</span>
					</label>
					<input type='text' id='asalsurat' name='asalsurat'  class='required' minlength='1' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tujuansurat')\" />
				
					<label>Tujuan Surat
					<span class='small'>Isikan tujuan surat masuk</span>
					</label>
					<input type='text' id='tujuansurat' name='tujuansurat'  class='required' minlength='3' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
					<label>Perihal
					<span class='small'>Isikan perihal surat masuk</span>
					</label>
					<input type='text' id='perihal' name='perihal'  class='required' minlength='2' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" />
					
					<label>Upload Surat
					<span class='small'>Pilih file surat masuk yang telah di-<i>scanning</i> (tanpa spasi)</span>
					</label>
					<input type='file' id='file' name='file'  minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertdatasuratmasuk' />
					<div class='spacer'></div>
				</form>
		</div>";
}

// Modul Rekam Data Surat Masuk ==================================================================================//
elseif($_GET['module']=='terimasuratmasuk'){
	$year 		= date('Y');
	$qMaxagd	= mysql_query("SELECT MAX(noagenda) maxAgd FROM d_suratmasuk WHERE substring(timeloket,1,4) = '$year'");
	$rMaxagd	= mysql_fetch_array($qMaxagd);
	
	//penambahan setiap nomor agenda
	$noagd		= $rMaxagd['maxAgd'];
	//kode nomor agenda, you can change here
	$jenAgd		= 'AGD';
	$noUrut		= (int) $noagd;
	$noUrut++;
	//hasil akhir nomor agenda
	$newAgd	= $jenAgd.'-'.sprintf("%05s",$noUrut);
	
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
	
		
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  enctype='multipart/form-data'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat masuk</h1>
					<p>Data Surat Masuk</p>
					<label>Nomor Agenda
					<span class='small'>Nomor agenda</span>
					</label>
					<input type='text' id='noagenda' class='required' minlength='3' name='noagenda' maxlength='10' value='$newAgd' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'nomorsuratmasuk')\" />
	
					<label>Nomor Surat
					<span class='small'>Isikan no.surat masuk</span>
					</label>
					<input type='text' id='nomorsuratmasuk' class='required' minlength='3' name='nomorsuratmasuk' maxlength='50' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tglsurat')\" />
					
					<label>Tanggal Surat
					<span class='small'>Isikan tgl.surat masuk</span>
					</label>
					<input type='text' id='tanggal' name='tglsurat'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
					
					<label>Asal Surat
					<span class='small'>Isikan asal surat masuk</span>
					</label>
					<input type='text' id='asalsurat' name='asalsurat'  class='required' minlength='1' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tujuansurat')\" />
				
					<label>Tujuan Surat
					<span class='small'>Isikan tujuan surat masuk</span>
					</label>
					<input type='text' id='tujuansurat' name='tujuansurat'  class='required' minlength='3' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
					<label>Perihal
					<span class='small'>Isikan perihal surat masuk</span>
					</label>
					<input type='text' id='perihal' name='perihal'  class='required' minlength='2' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" />
					
					<label>Upload Surat
					<span class='small'>Pilih file surat masuk yang telah di-<i>scanning</i> (tanpa spasi)</span>
					</label>
					<input type='file' id='file' name='file'  minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertdatasuratmasuk' />
					<div class='spacer'></div>
				</form>
		</div>";
}
// Modul Form Perekaman Data Surat Masuk -----------------------------------------------------------------------------------------------------------------------------//
elseif($_POST['Insertdatasuratmasuk'] == 'Rekam'){	
	$NoAgenda		= explode("-",$_POST['noagenda']);
	$kodeagenda		= $NoAgenda[0];
	$noagenda		= $NoAgenda[1];
	if($_POST['noagendaman']){
		$noagenda	= sprintf("%05s",$_POST['noagendaman']);
		$kodeagenda	= "AGD";
	}
	$nosuratmasuk	= $_POST['nomorsuratmasuk'];
	$asalsurat		= $_POST['asalsurat'];
	$tujuansurat	= $_POST['tujuansurat'];
	$Tglsurat		= $_POST['tglsurat'];	
	$tglsurat		= $helper->dateConvert($Tglsurat);
	$perihal		= $_POST['perihal'];
	$username		= $_SESSION[namauser];
	$timeloket		= date("Y-m-d H:i:s");
	
	$lokasi_file	=$_FILES['file']['tmp_name'];
	$nama_file		=$_FILES['file']['name'];
	
	//statproses = 1 -- terima loket umum
	mysql_query("INSERT INTO d_suratmasuk(kodeagenda,noagenda,nomorsuratmasuk,asalsurat,tujuansurat,tglsurat,perihal,userloket,timeloket,file,statproses) 
				VALUES('$kodeagenda','$noagenda','$nosuratmasuk','$asalsurat','$tujuansurat','$tglsurat','$perihal','$username','$timeloket','$nama_file','1')");
	// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
	$direktori		='suratmasuk/'.basename($nama_file);
	
	move_uploaded_file($lokasi_file,$direktori);
	
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Entri Data Surat Masuk'>
			<center><b>Data surat masuk dengan nomor surat: <font color='#ffff00'><i>" . $nosuratmasuk . "</i></font> dan perihal <font color='#ffff00'><i>" . $perihal . "</i></font> berhasil direkam</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
			</form>";
}

// Modul Cetak Disposisi ---------------------------------------------------------------------------------------------------------------------------------------------------------------------/
elseif($_GET['module']=='cetakdisposisi'){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Cetak Disposisi Surat Masuk</h1>
					<p>Form ini digunakan untuk melakukan pencetakan disposisi</p>
			</form>
		</div>
					<br />
					<br />
					<div id='normaltable'>
			
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>No. Surat</th>
					<th width='15%'>Tgl. Surat</th>
					<th width='15%'>Asal Surat</th>
					<th width='15%'>Perihal</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSurat		= mysql_query("SELECT statproses,idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal,disposisi,batasselesai,um,pd,bp,vr,sk,sangatsegera,segera,biasa,setuju,tolak,telitipendapat,untukdiketahui,selesaikan,sesuaicatatan,untukperhatian,edarkan,jawab,perbaiki,bicarakandgsaya,bicarakanbersama,ingatkan,simpan,disiapkan,harapdihadiridiwakili FROM d_suratmasuk WHERE statproses<'4' ORDER BY statproses, noagenda DESC,nomorsuratmasuk")or die(mysql_error);
			$no	=1;
			$oddcol			= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSurat	= mysql_fetch_object($qDataSurat)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSurat->noagenda</td>
						<td>$rDataSurat->nomorsuratmasuk</td>
						<td>$rDataSurat->tglsurat</td>
						<td>$rDataSurat->asalsurat</td>
						<td>$rDataSurat->perihal</td>
						<td>
							<form name='form1' method='post' action='report/disposisisuratmasuk.php'>
								<input type='hidden' name='username' value='$username' />
								<input type='hidden' name='idsurat' value='$rDataSurat->idsurat' />
								<input type='hidden' name='noagenda' value='$rDataSurat->noagenda' />
								<input type='hidden' name='nomorsuratmasuk' value='$rDataSurat->nomorsuratmasuk' />
								<input type='hidden' name='tglsurat' value='$rDataSurat->tglsurat' />
								<input type='hidden' name='asalsurat' value='$rDataSurat->asalsurat' />
								<input type='hidden' name='perihal' value='$rDataSurat->perihal' />
								<input type='hidden' name='disposisi' value='$rDataSurat->disposisi' />
								<input type='hidden' name='batasselesai' value='$rDataSurat->batasselesai' />
								<input type='hidden' name='statproses' value='$rDataSurat->statproses' />
								<input type='hidden' name='um' value='$rDataSurat->um' />
								<input type='hidden' name='pd' value='$rDataSurat->pd' />
								<input type='hidden' name='bp' value='$rDataSurat->bp' />
								<input type='hidden' name='vr' value='$rDataSurat->vr' />
								<input type='hidden' name='sk' value='$rDataSurat->sk' />
								
								<input type='hidden' name='sangatsegera' value='$rDataSurat->sangatsegera' />
								<input type='hidden' name='segera' value='$rDataSurat->segera' />
								<input type='hidden' name='biasa' value='$rDataSurat->biasa' />
								<input type='hidden' name='setuju' value='$rDataSurat->setuju' />
								<input type='hidden' name='tolak' value='$rDataSurat->tolak' />
								<input type='hidden' name='telitipendapat' value='$rDataSurat->telitipendapat' />
								<input type='hidden' name='untukdiketahui' value='$rDataSurat->untukdiketahui' />
								<input type='hidden' name='selesaikan' value='$rDataSurat->selesaikan' />
								<input type='hidden' name='sesuaicatatan' value='$rDataSurat->sesuaicatatan' />
								<input type='hidden' name='untukperhatian' value='$rDataSurat->untukperhatian' />
								<input type='hidden' name='edarkan' value='$rDataSurat->edarkan' />
								<input type='hidden' name='jawab' value='$rDataSurat->jawab' />
								<input type='hidden' name='perbaiki' value='$rDataSurat->perbaiki' />
								<input type='hidden' name='bicarakandgsaya' value='$rDataSurat->bicarakandgsaya' />
								<input type='hidden' name='bicarakanbersama' value='$rDataSurat->bicarakanbersama' />
								<input type='hidden' name='ingatkan' value='$rDataSurat->ingatkan' />
								<input type='hidden' name='simpan' value='$rDataSurat->simpan' />
								<input type='hidden' name='disiapkan' value='$rDataSurat->disiapkan' />
								<input type='hidden' name='harapdihadiridiwakili' value='$rDataSurat->harapdihadiridiwakili' />
								
								<input type='submit' class='normaltablesubmit' name='reportcetakdisposisi' value='Cetak' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank'; return true;\"  />
							</form>
						</td>
					</tr>";
				$no++;
			}
			echo "</table>
					</div>
					</form>";

}

// Modul Tabel Disposisi Pejabat/Kepala Kantor ========================================================================================//
elseif($_GET['module']=='disposisiPejabat'){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Tabel Disposisi Surat Masuk</h1>
					<p>Form ini digunakan untuk melakukan pencatatan disposisi </p>
			</form>
		</div>
					<br />
					<br />
					<div id='normaltable'>
			
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>No. Surat</th>
					<th width='15%'>Tgl. Surat</th>
					<th width='15%'>Asal Surat</th>
					<th width='15%'>Perihal</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSurat		= mysql_query("SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal FROM d_suratmasuk WHERE statproses='2' ORDER BY statproses, noagenda DESC,nomorsuratmasuk")or die(mysql_error);
			$no	=1;
			$oddcol			= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSurat	= mysql_fetch_object($qDataSurat)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSurat->noagenda</td>
						<td>$rDataSurat->nomorsuratmasuk</td>
						<td>$rDataSurat->tglsurat</td>
						<td>$rDataSurat->asalsurat</td>
						<td>$rDataSurat->perihal</td>
						<td>
							<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
								<input type='hidden' name='username' value='$username' />
								<input type='hidden' name='idsurat' value='$rDataSurat->idsurat' />
								<input type='submit' class='normaltablesubmit' name='catatdisposisi' value='Disposisi' />
							</form>
						</td>
					</tr>";
				$no++;
			}
			echo "</table>
					</div>
					</form>";
}

// Modul Catat Disposisi ---------------------------------------------------------------------------------------//
elseif($_POST['catatdisposisi']=='Disposisi') {
	$username	= $_POST['username'];
	$idsurat	= $_POST['idsurat'];
	echo "	<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
		</script>
	<div id='stylized' class='myform'>
	<form id='form' name='formShowBAArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
	<h1>Form rekam disposisi</h1> 
		<p>Form ini digunakan Kepala Kantor untuk mencatat disposisi</p>
		<br />	
		
			<label>Sangat Segera</label>
			<input type='checkbox' class='checkbox' name='sangatsegeraCek' />
			
			<label>Segera</label>
			<input type='checkbox' class='checkbox' name='segeraCek' />
				
			<label>Biasa</label>
			<input type='checkbox' class='checkbox' name='biasaCek' />
		
		<br />
		<br />
		<br />
		<br />
		<br />	
		<p></p>
		<p class='header'>Disposisi Kepala Kantor Kepada</p>
			<label>Seksi Umum</label>
			<input type='checkbox' class='checkbox' name='seksiumCek' />
					
			<label>Seksi Pencairan Dana</label>
			<input type='checkbox' class='checkbox' name='seksipdCek' />
					
			<label>Seksi Bank Giro Pos</label>
			<input type='checkbox' class='checkbox' name='seksibpCek' />
			
			<label>Seksi Verak</label>
			<input type='checkbox' class='checkbox' name='seksivrCek' />
				
			<label>Sekretariat</label>
			<input type='checkbox' class='checkbox' name='sekretariatCek' />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
		
		<p></p>	
		<p class='header'>Petunjuk</p>	
			<label>Setuju</label>
			<input type='checkbox' class='checkbox' name='setujuCek' />
			
			<label>Selesaikan</label>
			<input type='checkbox' class='checkbox' name='selesaikanCek' />
			
			<label>Jawab</label>
			<input type='checkbox' class='checkbox' name='jawabCek' />
			
			<label>Ingatkan</label>
			<input type='checkbox' class='checkbox' name='ingatkanCek' />
			
			<label>Tolak</label>
			<input type='checkbox' class='checkbox' name='tolakCek' />
			
			<label>Sesuai Catatan</label>
			<input type='checkbox' class='checkbox' name='sesuaicatatanCek' />
			
			<label>Perbaiki</label>
			<input type='checkbox' class='checkbox' name='perbaikiCek' />
			
			<label>Simpan</label>
			<input type='checkbox' class='checkbox' name='simpanCek' />
			
			<label>Teliti & Pendapat</label>
			<input type='checkbox' class='checkbox' name='telitipendapatCek' />
			
			<label>Untuk Perhatian</label>
			<input type='checkbox' class='checkbox' name='untukperhatianCek' />
			
			<label>Bicarakan Dengan Saya</label>
			<input type='checkbox' class='checkbox' name='bicarakandengansayaCek' />
			
			<label>Disiapkan</label>
			<input type='checkbox' class='checkbox' name='disiapkanCek' />
			
			<label>Untuk Diketahui</label>
			<input type='checkbox' class='checkbox' name='untukdiketahuiCek' />
			
			<label>Edarkan</label>
			<input type='checkbox' class='checkbox' name='edarkanCek' />
			
			<label>Bicarakan Bersama</label>
			<input type='checkbox' class='checkbox' name='bicarakanbersamaCek' />
			
			<label>Harap Dihadiri/Diwakili</label>
			<input type='checkbox' class='checkbox' name='harapdihadiridiwakiliCek' />
			
			<label>Catatan Disposisi</label>
			<textarea id='disposisi' rows='7' columns='3' name='disposisi' maxlength='300' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tanggal')\"></textarea>
		
			<label>Batas Waktu Tindak Lanjut
			<span class='small'>Isikan batas waktu tindak lanjut dengan surat tanggapan</span>
			</label>
			<input type='text' id='tanggal' name='batasselesai'  minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			

			<input type='hidden' name='username' value='$username' />
			<input type='hidden' name='idsurat' value='$idsurat' />
			<input type='submit' value='Rekam' class='button' id='submit' name='rekamdisposisi' />
		
			<div class='spacer'></div>
			</form>
		</div>";			
}

// Modul Simpan Disposisi -----------------------------------------------------------------------------------//
elseif($_POST['rekamdisposisi']=='Rekam'){
	$idsurat	= $_POST['idsurat'];
	$username	= $_POST['username'];
	$seksium	= $_POST['seksiumCek'];
	if($seksium == "on"){ 
		$seksium = "1";
		}
	else{
		$seksium = "0";
	}
	$seksipd	= $_POST['seksipdCek'];
	if($seksipd == "on"){ 
		$seksipd = "1";
		}
	else{
		$seksipd = "0";
	}
	$seksibp	= $_POST['seksibpCek'];
	if($seksibp == "on"){ 
		$seksibp = "1";
		}
	else{
		$seksibp = "0";
	}
	$seksivr	= $_POST['seksivrCek'];
	if($seksivr == "on"){ 
		$seksivr = "1";
		}
	else{
		$seksivr = "0";
	}
	$sekretariat = $_POST['sekretariatCek'];
	if($sekretariat == "on")
	{
		$sekretariat = "1";
	}
	else
	{
		$sekretariat = "0";
	}
	$sangatsegera 	= $_POST['sangatsegeraCek'];
	if($sangatsegera == "on")
	{
		$sangatsegera = "1";
	}
	else
	{
		$sangatsegera = "0";
	}
	$segera 		= $_POST['segeraCek'];
	if($segera == "on")
	{
		$segera = "1";
	}
	else
	{
		$segera = "0";
	}
	$biasa 			= $_POST['biasaCek'];
	if($biasa == "on")
	{
		$biasa = "1";
	}
	else
	{
		$biasa = "0";
	}
	$setuju 		= $_POST['setujuCek'];
	if($setuju == "on")
	{
		$setuju = "1";
	}
	else
	{
		$setuju = "0";
	}
	$tolak 			= $_POST['tolakCek'];
	if($tolak == "on")
	{
		$tolak = "1";
	}
	else
	{
		$tolak = "0";
	}
	$telitipendapat = $_POST['telitipendapatCek'];
	if($telitipendapat == "on")
	{
		$telitipendapat = "1";
	}
	else 
	{
		$telitipendapat = "0";
	}
	$untukdiketahui	= $_POST['untukdiketahuiCek'];
	if($untukdiketahui == "on")
	{
		$untukdiketahui = "1";
	}
	else
	{
		$untukdiketahui = "0";
	}
	$selesaikan 	= $_POST['selesaikanCek'];
	if($selesaikan == "on")
	{
		$selesaikan = "1";
	}
	else
	{
		$selesaikan = "0";
	}
	$sesuaicatatan 	= $_POST['sesuaicatatanCek'];
	if($sesuaicatatan == "on")
	{
		$sesuaicatatan = "1";
	}
	else
	{
		$sesuaicatatan = "0";
	}
	$untukperhatian	= $_POST['untukperhatianCek'];
	if($untukperhatian == "on")
	{
		$untukperhatian = "1";
	}
	else
	{
		$untukperhatian = "0";
	}
	$edarkan		= $_POST['edarkanCek'];
	if($edarkan == "on")
	{
		$edarkan = "1";
	}
	else
	{
		$edarkan = "0";
	}
	$jawab 			= $_POST['jawabCek'];
	if($jawab == "on")
	{
		$jawab = "1";
	}
	else
	{
		$jawab = "0";
	}
	$perbaiki 		= $_POST['perbaikiCek'];
	if($perbaiki == "on")
	{
		$perbaiki = "1";
	}
	else
	{
		$perbaiki = "0";
	}
	$bicarakandgsaya	= $_POST['bicarakandengansayaCek'];
	if($bicarakandgsaya == "on")
	{
		$bicarakandgsaya = "1";
	}
	else
	{
		$bicarakandgsaya = "0";
	}
	$bicarakanbersama	= $_POST['bicarakanbersamaCek'];
	if($bicarakanbersama == "on")
	{
		$bicarakanbersama = "1";
	}
	else
	{
		$bicarakanbersama = "0";
	}
	$ingatkan			= $_POST['ingatkanCek'];
	if($ingatkan == "on")
	{
		$ingatkan = "1";
	}
	else
	{
		$ingatkan = "0";
	}
	$simpan			= $_POST['simpanCek'];
	if($simpan == "on")
	{
		$simpan = "1";
	}
	else
	{
		$simpan = "0";
	}
	$disiapkan		= $_POST['disiapkanCek'];
	if($disiapkan == "on")
	{
		$disiapkan = "1";
	}
	else
	{
		$disiapkan = "0";
	}
	$harapdihadiridiwakili = $_POST['harapdihadiridiwakiliCek'];
	if($harapdihadiridiwakili == "on")
	{
		$harapdihadiridiwakili = "1";
	}
	else
	{
		$harapdihadiridiwakili = "0";
	}
	
	$disposisi	= $_POST['disposisi'];
	$tanggal	= $_POST['batasselesai'];	
	$batasselesai = $helper->dateConvert($tanggal);
	$timepejabat= date("Y-m-d H:i:s");
	// query updating tables for Disposisi Kepala Kantor/Pejabat statproses=3
	mysql_query("UPDATE d_suratmasuk SET userpejabat='$username',timepejabat='$timepejabat',batasselesai='$batasselesai',disposisi='$disposisi',um='$seksium',pd='$seksipd',bp='$seksibp',vr='$seksivr',sk='$sekretariat',sangatsegera='$sangatsegera',segera='$segera',biasa='$biasa',setuju='$setuju',tolak='$tolak',telitipendapat='$telitipendapat',untukdiketahui='$untukdiketahui',selesaikan='$selesaikan',sesuaicatatan='$sesuaicatatan',untukperhatian='$untukperhatian',edarkan='$edarkan',jawab='$jawab',perbaiki='$perbaiki',bicarakandgsaya='$bicarakandgsaya',bicarakanbersama='$bicarakanbersama',ingatkan='$ingatkan',simpan='$simpan',disiapkan='$disiapkan',harapdihadiridiwakili='$harapdihadiridiwakili',statproses='2' WHERE idsurat='$idsurat'");
	// pop up for confirmation
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Perekaman Disposisi'>
			<center><b>Disposisi untuk surat masuk dengan catatan disposisi: <font color='#ffff00'><i>" . $disposisi . "</i></font> berhasil disimpan</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
			</form>";
}

// Modul terima dan proses surat masuk untuk Kepala Seksi =====================================================================//
elseif($_GET['module'] == "terimaprosessuratmasuk"){
	$username	= $_SESSION[namauser];
	$Seksi		= substr($_SESSION[seksi],1,2);
	$seksi		= strtolower($Seksi);
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Tabel Terima dan Proses Surat Masuk</h1>
					<p>Form ini digunakan untuk melakukan penerimaan dan pemrosesan surat masuk oleh kepala seksi </p>
			</form>
		</div>
					<br />
					<br />
					<div id='normaltable'>
			
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>No. Surat</th>
					<th width='15%'>Tgl. Surat</th>
					<th width='15%'>Asal Surat</th>
					<th width='15%'>Perihal</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSurat		= mysql_query("SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal FROM d_suratmasuk WHERE statproses='3' AND $seksi='1' ORDER BY statproses, noagenda DESC,nomorsuratmasuk")or die(mysql_error);
			$no	=1;
			$oddcol			= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSurat	= mysql_fetch_object($qDataSurat)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSurat->noagenda</td>
						<td>$rDataSurat->nomorsuratmasuk</td>
						<td>$rDataSurat->tglsurat</td>
						<td>$rDataSurat->asalsurat</td>
						<td>$rDataSurat->perihal</td>
						<td>
							<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
								<input type='hidden' name='username' value='$username' />
								<input type='hidden' name='idsurat' value='$rDataSurat->idsurat' />
								<input type='submit' class='normaltablesubmit' name='prosessurat' value='Terima' onClick=\"setTimeout('location.reload(true);',1000); return true;\"  />
							</form>
						</td>
					</tr>";
				$no++;
			}
			echo "</table>
					</div>
					</form>";

}
// Modul eksekusi penerimaan surat masuk kepala seksi -----------------------------------------------------------------------------------//
elseif($_POST['prosessurat']=='Terima'){
	$username	= $_POST['username'];
	$idsurat	= $_POST['idsurat'];
	$timekasi	= date("Y-m-d H:i:s");
	$q			= mysql_query("SELECT batasselesai FROM d_suratmasuk WHERE idsurat='$idsurat'");
	$r			= mysql_fetch_object($q);
	if($r->batasselesai == "0000-00-00"){
		mysql_query("UPDATE d_suratmasuk SET userkasi='$username', timekasi='$timekasi', statproses='4' WHERE idsurat='$idsurat'");
	}else{
		mysql_query("UPDATE d_suratmasuk SET userkasi='$username', timekasi='$timekasi', statproses='5' WHERE idsurat='$idsurat'");	
	}
}

// Modul tabel monitoring surat masuk kepala seksi dan kepala kantor ================================================================//
elseif($_GET['module'] == "monitoringsuratmasuk"){
	$username	= $_SESSION[namauser];
	$section	= strtolower($_SESSION[seksi]);
	$Seksi		= substr($_SESSION[seksi],1,2);
	$seksi		= strtolower($Seksi);
	switch($section)
	{
		case "aum":
			$section = "um";
			break;
		case "apd":
			$section = "pd";
			break;
		case "avr":
			$section = "vr";
			break;
		case "abp":
			$section = "bp";
			break;
		case "all":
			$section = "um";
			break;
	}
	echo "<div id='stylizedtable' class='mytable'>
			<h1>Form monitoring surat masuk</h1> 
			<p>Tayangan</p>
			<div id='stylizedtablesp2d'>	
			<script type='text/javascript'>
			setTimeout('location.reload();',30000);
			</script>
			<table name='monitoringsuratmasuk' cellpadding='1' cellspacing='1'>
			<tr>	
			<th width='10%'>No.Agenda</th>
			<th width='10%'>No.Surat</th>
			<th width='10%'>Tgl.Surat</th>
			<th width='20%'>Asal Surat</th>
			<th width='30%'>Perihal</th>
			<th width='10%'>Batas Selesai</th>
			<th width='10%'>File</th>
			<tr>
			<tr>
			<td bgcolor='#dbeeb8' colspan='6'></td>	
			</tr>";
	$querykk	= "SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal,date_format(batasselesai,'%d-%m-%Y') AS batasselesai,file FROM d_suratmasuk WHERE batasselesai!='00-00-0000' AND (kodesuratkeluar='' OR nomorsuratkeluar='') ORDER BY statproses, noagenda DESC,nomorsuratmasuk";
	$querynotkk = "SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal,date_format(batasselesai,'%d-%m-%Y') AS batasselesai,file FROM d_suratmasuk WHERE batasselesai!='00-00-0000' AND $section='1' AND (kodesuratkeluar='' OR nomorsuratkeluar='') ORDER BY statproses, noagenda DESC,nomorsuratmasuk";
	if($seksi == "k"){
			$querydata = $querykk;
		}else{
			$querydata = $querynotkk;
		}
	$qDataSurat		= mysql_query($querydata)or die(mysql_error);
	while($rData	= mysql_fetch_array($qDataSurat)){
		$noagenda		= $rData['noagenda'];
		$nomorsuratmasuk= $rData['nomorsuratmasuk'];
		$tglsurat		= $rData['tglsurat'];
		$asalsurat		= $rData['asalsurat'];
		$perihal		= $rData['perihal'];
		$file			= $rData['file'];
		$batasselesai	= $rData['batasselesai'];
		$now			= date("d-m-Y");
		echo "
				<tr class='sp2d' height='60'>
				<td>$noagenda</td>
				<td><font color='#FFFFFF'>$nomorsuratmasuk</font></td>
				<td><font color='#FFFFFF'>$tglsurat</font></td>
				<td><font color='#33FFCC'>$asalsurat</font></td>
				<td>$perihal</td>
				<td>";
					switch($batasselesai){
						case 00-00-0000:
						echo "<b>$batasselesai</b>";
						break;
						case $batasselesai > $now:
						echo "<font color='#CEEC96'><b>$batasselesai</b></font>";
						break;
						case $batasselesai = $now:
						echo "<font color='#ffff00'><b>$batasselesai</b></font>";
						break;
						case $batasselesai > $now:
						echo "<font color='#ff0000'><b>$batasselesai</b></font>";
						break;
					}
				echo "</td>
				<td><b><i><a href='suratmasuk/$file' target='_blank'>$file</a></b></i></td>
				</tr>";
	}
	echo"</table>
			</div>
			</div>";	
}


// Modul Form pencarian surat masuk =======================================================================================//
elseif($_GET['module']=='searchsuratmasuk'){
	echo "<script type=\"text/javascript\">
			$(document).ready(function() {
					$('#tglawalsurat').datepicker({
						changeMonth: true,
						changeYear: true
					});
			});
			$(document).ready(function() {
					$('#tglakhirsurat').datepicker({
						changeMonth: true,
						changeYear: true
					});
			});
			$(document).ready(function() {
					$('#timeloket').datepicker({
						changeMonth: true,
						changeYear: true
					});
			});
		</script>
			<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form multikategori pencarian data surat masuk</h1>
			<p>Form ini digunakan dalam pencarian data surat masuk</p>
			
			<label>Tgl.Terima Surat</label>
			<input type='checkbox' class='checkbox' name='timeloketCek' />
			<input type='text' id='timeloket' name='timeloket' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nomorsuratmasuk')\" />
						
			<label>Nomor Surat</label>
			<input type='checkbox' class='checkbox' name='nomorsuratmasukCek' />
			<input type='text' id='nomorsuratmasuk' minlength='3' name='nomorsuratmasuk' maxlength='20' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tglsurat')\" />
			
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<p><center><b>Range Tanggal Surat</b></center></p>
			<label>Tgl.Awal Surat</label>
			<input type='checkbox' class='checkbox' name='tglawalsuratCek' />
			<input type='text' id='tglawalsurat' name='tglawalsurat' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tglakhirsurat')\" />
			
			<label>Tgl.Akhir Surat</label>
			<input type='checkbox' class='checkbox' name='tglakhirsuratCek' />
			<input type='text' id='tglakhirsurat' name='tglakhirsurat' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
			
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<p></p>
					
			<label>Asal Surat</label>
			<input type='checkbox' class='checkbox' name='asalsuratCek' />
			<input type='text' id='asalsurat' name='asalsurat'  maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
			<label>Perihal</label>
			<input type='checkbox' class='checkbox' name='perihalCek' />
			<input type='text' id='perihal' name='perihal' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
			
			<input type='submit' value='Cari' class='button' id='submit' name='cariDokSuratMasuk' />
			<div class='spacer'></div>
			</form>
			</div>";
}

// Modul  Search Surat Masuk----------------------------------------------------------------------------------------------------------------------------------------------//
elseif($_POST['cariDokSuratMasuk'] == "Cari"){
	$timeloketCek			= $_POST['timeloketCek'];
	$Timeloket				= $_POST['timeloket'];
	$timeloket				= $helper->dateConvert($Timeloket);
	$nomorsuratmasukCek		= $_POST['nomorsuratmasukCek'];
	$tglawalsuratCek		= $_POST['tglawalsuratCek'];
	$tglakhirsuratCek		= $_POST['tglakhirsuratCek'];
	$asalsuratCek			= $_POST['asalsuratCek'];
	$perihalCek				= $_POST['perihalCek'];
	$nomorsuratmasuk		= $_POST['nomorsuratmasuk'];
	$Tglawalsurat			= $_POST['tglawalsurat'];
	$Tglakhirsurat			= $_POST['tglakhirsurat'];
	$tglawalsurat			= $helper->dateConvert($Tglawalsurat);
	$tglakhirsurat			= $helper->dateConvert($Tglakhirsurat);
	$asalsurat				= $_POST['asalsurat'];
	$perihal				= $_POST['perihal'];
	
	$bagianWhere="";
		
	if(isset($timeloketCek)){
		$timeloket;
		if(empty($bagianWhere)){
			$bagianWhere .= "date(timeloket)='$timeloket'";
		}
	}
	if(isset($nomorsuratmasukCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "nomorsuratmasuk='$nomorsuratmasuk'";
		}
		else{
			$bagianWhere .= " AND nomorsuratmasuk='$nomorsuratmasuk'";
		}
	}
	if(isset($tglawalsuratCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "tglsurat>='$tglawalsurat' ";
		}
		else{
			$bagianWhere .= " AND tglsurat>='$tglawalsurat'";
		}
	}
	if(isset($tglakhirsuratCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "tglsurat<='$tglakhirsurat'";
		}
		else{
			$bagianWhere .= " AND tglsurat<='$tglakhirsurat'";
		}
	}
	if(isset($asalsuratCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "asalsurat REGEXP '$asalsurat'";
		}
		else{
			$bagianWhere .= " AND asalsurat REGEXP '$asalsurat'";
		}
	}
	if(isset($perihalCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "perihal REGEXP '$perihal'";
		}
		else{
			$bagianWhere .= " AND perihal REGEXP '$perihal'";
		}
	}

	$queryCek	= "SELECT nomorsuratmasuk,tglsurat,asalsurat,perihal FROM d_suratmasuk WHERE ".$bagianWhere;
	$qCek		= mysql_query($queryCek)or die(mysql_error());
	$rCek		= mysql_fetch_row($qCek);

	if($rCek > 0){
		
		echo "<div id='stylized' class='myform'>
				<form id='form' name='formSearchSuratMasuk' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<h1>Form hasil pencarian data surat masuk</h1> 
					<p>Hasil pencarian data surat masuk</p>
					</form>
					</div>
					<br />	
					<table border='0' class='normaltable'>
							<tr>
								<th width='7%'>No.</th>
								<th width='25%'>No. Surat</th>
								<th width='20%'>Tgl. Surat</th>
								<th width='25%'>Asal Surat</th>
								<th width=''>Perihal</th>
								<th width='20%'>Surat Tanggapan</th>
								<th width='20%'>File Surat Masuk</th>
								<th width='7%'>Gudang</th>
								<th width='7%'>No.Rak</th>
								<th width='7%'>No.Baris</th>
								<th width='7%'>No.Box</th>
								<th width='40%' colspan='2'>Action</th>
							</tr>";
								
								$query		= "SELECT a.idsurat,a.nomorsuratmasuk,date_format(a.tglsurat,'%d-%m-%Y') AS tglsurat,a.asalsurat,a.perihal,CONCAT(a.nomorsuratkeluar,a.kodesuratkeluar) AS nomorsuratkeluar,a.file,a.um,a.pd,a.bp,a.vr,a.sk,b.nm_gudang,b.kd_rak,b.no_rak,b.kd_baris,b.no_baris,b.kd_box,b.no_box FROM d_suratmasuk a LEFT JOIN d_arsipsuratmasuk b ON a.idsurat=b.idsurat WHERE ".$bagianWhere;
								$qCari		= mysql_query($query)or die(mysql_error());
								$no	= 1;
								$oddcol		= "#CCFF99";
								$evencol	= "#CCDD88";
								while($rCari		= mysql_fetch_array($qCari)){
									if($no % 2 == 0) {$color = $evencol;}
									else{$color = $oddcol;}
											$idsurat			= $rCari['idsurat'];
											$nomorsuratmasuk	= $rCari['nomorsuratmasuk'];
											$tglsurat			= $rCari['tglsurat'];
											$asalsurat			= $rCari['asalsurat'];
											$perihal			= $rCari['perihal'];
											$nomorsuratkeluar	= $rCari['nomorsuratkeluar'];
											$file				= $rCari['file'];
											$gudang				= $rCari['nm_gudang'];
											if($rCari['no_rak'] == '')
											{
												$rak	= "";
											}
											else
											{
												$rak				= $rCari['kd_rak']."-".$rCari['no_rak'];
											}
											if($rCari['no_baris'] == '')
											{
												$baris	= "";
											}
											else
											{
												$baris				= $rCari['kd_baris']."-".$rCari['no_baris'];
											}
											if($rCari['no_box'] == '')
											{
												$box	= "";
											}
											else
											{
												$box				= $rCari['kd_box']."-".$rCari['no_box'];
											}
										
								echo"<tr bgcolor='$color'>
											<td>$no</td>
											<td>$nomorsuratmasuk</td>
											<td>$tglsurat</td>
											<td>$asalsurat</td>
											<td>$perihal</td>
											<td>$nomorsuratkeluar</td>
											<td><b><i><a href='suratmasuk/$file' target='_blank'>$file</a></b></i></td>
											<td>$gudang</td>
											<td>$rak</td>
											<td>$baris</td>
											<td>$box</td>
											<td><form method='post' action='".$_SERVER['PHP_SELF']."'><input type='hidden' name='idsurat' value='".$idsurat."' /><input type='submit' name='ubahsuratmasuk' value='Ubah' class='normaltablesubmit' /></form></td>
											<td><form method='post' action='".$_SERVER['PHP_SELF']."'><input type='hidden' name='idsurat' value='".$idsurat."' /><input type='submit' name='hapussuratmasuk' value='Hapus' class='normaltablesubmit' /></form></td>";
									$no++;
									}
									echo
									"
									</tr>	
									</table>
									<form method='post' action='".$_SERVER['PHP_SELF']."'>";
											$n = 1;
											$qnArsip = mysql_query($query);
											while($rnArsip = mysql_fetch_object($qnArsip)){
												echo "
												<input type='hidden' name='idsurat".$n."' value='".$rnArsip->idsurat."' />
												<input type='hidden' name='nomorsuratmasuk".$n."' value='".$rnArsip->nomorsuratmasuk."' />
												<input type='hidden' name='tglsurat".$n."' value='".$rnArsip->tglsurat."' />
												<input type='hidden' name='asalsurat".$n."' value='".$rnArsip->asalsurat."' />
												<input type='hidden' name='perihal".$n."' value='".$rnArsip->perihal."' />
												<input type='hidden' name='file".$n."' value='".$rnArsip->file."' />
												";
												$n++;
											}
											$n = $n - 1;
											echo "
											<br />
											<input type='hidden' name='jumldata' value='".$n."' />
											<input type='submit' name='arsipsuratmasuk' value='Arsipkan' class='normaltablesubmit' />
									</form>
						<br />";
	}
	else{
				echo "<script type='text/javascript'>
						alert('Data tersebut tidak ditemukan');
				</script>";			
	}
}	

// Modul Ubah Surat Masuk ---------------------------------------------------------------
elseif($_POST['ubahsuratmasuk'] == 'Ubah')
{
	echo "<script type=\"text/javascript\">
			$(document).ready(function() {
					$('#tglsurat').datepicker();
			});
		</script>";
	$idsurat = $_POST['idsurat'];
	
	$qUpdate = mysql_query("SELECT idsurat,nomorsuratmasuk,date_format(tglsurat,'%d/%m/%Y') AS tglsurat,asalsurat,perihal,nomorsuratkeluar,kodesuratkeluar,file FROM d_suratmasuk WHERE idsurat='$idsurat'");
	$rUpdate = mysql_fetch_object($qUpdate);
	
	$idsurat			= $rUpdate->idsurat;
	$nomorsuratmasuk 	= $rUpdate->nomorsuratmasuk;
	$tglsurat			= $rUpdate->tglsurat;
	$asalsurat			= $rUpdate->asalsurat;
	$perihal			= $rUpdate->perihal;
	$nomorsuratkeluar	= $rUpdate->nomorsuratkeluar;
	$kodesuratkeluar	= $rUpdate->kodesuratkeluar;
	$file				= $rUpdate->file;

	
		echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' enctype='multipart/form-data' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form update data surat masuk</h1>
			<p>Form ini digunakan untuk melakukan perubahan data surat masuk</p>
				
			<label>Nomor Surat Masuk</label>
			<input type='text' id='nomorsuratmasuk' minlength='3' name='nomorsuratmasuk' value='$nomorsuratmasuk' maxlength='20' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tglsurat')\" />
			
			<label>Tgl.Surat Masuk</label>
			<input type='text' id='tglsurat' name='tglsurat' value='$tglsurat' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
				
			<label>Asal Surat</label>
			<input type='text' id='asalsurat' name='asalsurat' value='$asalsurat' maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
			
			<label>Perihal</label>
			<input type='text' id='perihal' name='perihal' value='$perihal' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" />
			
			<label>File
				<span class='small'>Apabila file yang diupload tidak berubah, biarkan kosong.</span>
				<span class='small'>File awal: <b>$file</b></span>
			</label>
			<input type='file' id='file' name='file' maxlength='45' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
			<input type='hidden' value='$idsurat' name='idsurat' />
			<input type='submit' value='Simpan' class='button' id='submit' name='simpanUpdateSuratMasuk' />
			<div class='spacer'></div>
			</form>
			</div>";
}
// Simpan Hasil Update Surat Masuk--------------------------------------------------------------------
elseif($_POST['simpanUpdateSuratMasuk'] == 'Simpan')
{
	echo "<script type='text/javascript'>
		$(document).ready(function() {
			$('#promptkonfirmasi').dialog({
				modal: true
			});
		});
	</script>";
	
	$idsurat			= $_POST['idsurat'];
	$nomorsuratmasuk 	= $_POST['nomorsuratmasuk'];
	$tglSurat 			= $_POST['tglsurat'];
	$tglsurat			= $helper->dateConvert($tglSurat);
	$asalsurat			= $_POST['asalsurat'];
	$perihal			= $_POST['perihal'];
	$file				= $_POST['file'];
	
	$lokasi_file	=$_FILES['file']['tmp_name'];
	$nama_file		=$_FILES['file']['name'];
	
	
	if($file == 0)
	{
		$qUpdate = mysql_query("UPDATE d_suratmasuk SET nomorsuratmasuk='$nomorsuratmasuk',tglsurat='$tglsurat',asalsurat='$asalsurat',perihal='$perihal' WHERE idsurat=$idsurat");
		
		echo "<div id='promptkonfirmasi' title='Konfirmasi Update Data Surat Masuk'>
		<center><b>Data surat masuk dengan nomor surat: <font color='#ffff00'><i>" . $nosuratmasuk . "</i></font> dan perihal <font color='#ffff00'><i>" . $perihal . "</i></font> berhasil diubah</b></center>
		<br />
		<br />
		<table border='0' align='center'>
		<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
		</form>";
	}
	else
	{
		$qUpdate = mysql_query("UPDATE d_suratmasuk SET nomorsuratmasuk='$nomorsuratmasuk',tglsurat='$tglsurat',asalsurat='$asalsurat',perihal='$perihal',file='$file' WHERE idsurat=$idsurat");
		
		$direktori		='suratmasuk/'.basename($nama_file);
		move_uploaded_file($lokasi_file,$direktori);
		
		echo "<div id='promptkonfirmasi' title='Konfirmasi Update Data Surat Masuk'>
		<center><b>Data surat masuk dengan nomor surat: <font color='#ffff00'><i>" . $nosuratmasuk . "</i></font> dan perihal <font color='#ffff00'><i>" . $perihal . "</i></font> berhasil diubah</b></center>
		<br />
		<br />
		<table border='0' align='center'>
		<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
		</form>";
	}
}
// Modul Hapus Surat Masuk ---------------------------------------------------------------------------
elseif($_POST['hapussuratmasuk'] == 'Hapus')
{
	$idsurat = $_POST['idsurat'];
	
	mysql_query("DELETE FROM d_suratmasuk WHERE idsurat='$idsurat'");
	header("location: media.php?module=searchsuratmasuk");
}

// Modul Arsipkan Surat Masuk ---------------------------------------------------------------
elseif($_POST['arsipsuratmasuk'] == 'Arsipkan')
{
	
	echo "
	<div id='stylized' class='myform'>
		<form id='form' name='formArsipSuratMasuk' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form pengarsipan surat masuk</h1> 
			<p>Pemilihan surat masuk yang hendak diarsipkan</p>
			
			
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<label>Gudang</label>
			<select name='nm_gudang'  onkeypress='return handleEnter(this,event)'>
						<option value='' selected='selected'>-- Pilih Gudang--</option>";
			
						$qRgudang	= mysql_query("SELECT nm_gudang,ket_gudang FROM r_gudang ORDER BY id_gudang");
						while($rRgudang	= mysql_fetch_object($qRgudang))
						{
							echo "<option value = '".$rRgudang->nm_gudang."'>".$rRgudang->nm_gudang." - ".$rRgudang->ket_gudang."</option>";
						}
						
			echo "
			</select>
			
						
			<label>Kode Rak</label>
			<select name='kd_rak' onkeypress='return handleEnter(this,event)'>
						<option value='' selected='selected'>-- Pilih Kode Rak--</option>";
			
						$qRrak	= mysql_query("SELECT kd_rak,ket_rak FROM r_rak ORDER BY id_rak");
						while($rRrak	= mysql_fetch_object($qRrak))
						{
							echo "<option value = '".$rRrak->kd_rak."'>".$rRrak->kd_rak." - ".$rRrak->ket_rak."</option>";
						}
						
			echo "
			</select>
			
			<label>Nomor Rak</label>
			<input type='text' id='no_rak' name='no_rak' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kd_baris')\" />
				
									
			<label>Kode Baris</label>
			<select name='kd_baris' onkeypress='return handleEnter(this,event)'>
						<option value='' selected='selected'>-- Pilih Kode Baris--</option>";
			
						$qRbaris	= mysql_query("SELECT kd_baris,ket_baris FROM r_baris ORDER BY id_baris");
						while($rRbaris	= mysql_fetch_object($qRbaris))
						{
							echo "<option value = '".$rRbaris->kd_baris."'>".$rRbaris->kd_baris." - ".$rRbaris->ket_baris."</option>";
						}
						
			echo "
			</select>
			
			<label>Nomor Baris</label>
			<input type='text' id='no_baris' name='no_baris' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kd_box')\" />
			
												
			<label>Kode Box</label>
			<select name='kd_box' onkeypress='return handleEnter(this,event)'>
						<option value='' selected='selected'>-- Pilih Kode Box--</option>";
			
						$qRbox	= mysql_query("SELECT kd_box,ket_box FROM r_box ORDER BY id_box");
						while($rRbox	= mysql_fetch_object($qRbox))
						{
							echo "<option value = '".$rRbox->kd_box."'>".$rRbox->kd_box." - ".$rRbox->ket_box."</option>";
						}
						
			echo "
			</select>
			
			<label>Nomor Box</label>
			<input type='text' id='no_box' name='no_box' maxlength='5' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'arsip1')\" />
			
			<div class='spacer'></div>
				
		
	<br />	
	";
	$jumldata 	= $_POST['jumldata'];
	$oddcol		= "#CCFF99";
	$evencol	= "#CCDD88";
	echo "
		<table border='1' class='normaltable' width='80%' colpadding='2px' style='border-collapse:collapse; border-color:#CEEC96;'>
			<tbody>
				<tr>
					<th>No.Surat</th>
					<th>Tgl.Surat</th>
					<th>Asal Surat</th>
					<th>Perihal</th>
					<th>File</th>
					<th>Arsip</th>
				</tr>
		";
	$i = 1;
	for($i = 1; $i <= $jumldata; $i++)
	{
	$id = $_POST['idsurat'.$i];
	$qArsipSurat	= mysql_query("SELECT a.idsurat, a.nomorsuratmasuk, a.tglsurat, a.asalsurat, a.perihal, a.file FROM d_suratmasuk a LEFT JOIN d_arsipsuratmasuk b ON a.idsurat=b.idsurat WHERE a.idsurat='$id' AND b.idsurat is null ORDER BY a.tglsurat");
	$rArsipSurat	= mysql_fetch_array($qArsipSurat);
	//while($rArsipSurat = mysql_fetch_array($qArsipSurat))
		if($i % 2 == 0) {$color = $evencol;}
		else{$color = $oddcol;}
		
		$idsurat 			= $rArsipSurat['idsurat'];
		$nomorsuratmasuk 	= $rArsipSurat['nomorsuratmasuk'];
		$tglsurat		 	= $rArsipSurat['tglsurat'];
		$asalsurat		 	= $rArsipSurat['asalsurat'];
		$perihal		 	= $rArsipSurat['perihal'];
		$file			 	= $rArsipSurat['file'];
		
		echo "
				<tr bgcolor=".$color.">
					<td>".$nomorsuratmasuk."</td>
					<td>".$tglsurat."</td>
					<td>".$asalsurat."</td>
					<td>".$perihal."</td>
					<td><b><i><a href='suratmasuk/".$file."' target='_blank'>".$file."</a></i></b></td>
					<td>
						<input type='hidden' name='idsurat".$i."' value=".$idsurat." />
						<input type='checkbox' id='arsip".$i."' name='arsip".$i."' value=".$i." />
					</td>
				</tr>
		";
	}
	echo "
			</tbody>
		</table>
		<br />
		<input type='hidden' name='jumldata' value=".$jumldata." />
		<input type='submit' name='btn_arsipsuratmasuk' value='Arsipkan' class='normaltablesubmit' />
		</form>
		<div class='spacer'></div>
	</form>
	</div>
	";
	 
}

// Penyimpanan Surat Masuk Sebagai Data Arsip -------------------------------------------------------//
elseif($_POST['btn_arsipsuratmasuk'] == 'Arsipkan')
{
	$jumldata 	= $_POST['jumldata'];
	
	$nm_gudang 	= $_POST['nm_gudang'];
	$kd_rak		= $_POST['kd_rak'];
	$no_rak		= sprintf("%04s",$_POST['no_rak']);
	$kd_baris	= $_POST['kd_baris'];
	$no_baris	= sprintf("%04s",$_POST['no_baris']);
	$kd_box		= $_POST['kd_box'];
	$no_box		= sprintf("%05s",$_POST['no_box']);
	for($i = 1; $i <= $jumldata; $i++)
	{
		if(!empty($_POST['arsip'.$i]))
		{
			$idsurat[]	= '("'.$_POST["idsurat".$i].'", "'.$nm_gudang.'", "'.$kd_rak.'", "'.$no_rak.'", "'.$kd_baris.'", "'.$no_baris.'", "'.$kd_box.'", "'.$no_box.'")';
		}
	}
	
	$qInsSuratMasuk = "INSERT INTO d_arsipsuratmasuk(idsurat, nm_gudang, kd_rak, no_rak, kd_baris, no_baris, kd_box, no_box) VALUES " . implode(',',$idsurat);
	mysql_query($qInsSuratMasuk);
}
// Modul Pengantar Surat Masuk ======================================================================//
elseif($_GET['module'] == 'pengantarsuratmasuk'){
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
			</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
			});
			
			$(document).ready(function(){
				$('#form').validate();
				$('#tglawal').datepicker();
			});
			
			$(document).ready(function(){
				$('#form').validate();
				$('#tglakhir').datepicker();
			});
	
  			</script>
			<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form pencetakan rekapitulasi surat masuk</h1>
			<p>Form ini digunakan untuk melakukan pencetakan rekapitulasi surat masuk</p>
			<h3>Range Tanggal Penerimaan Surat Masuk</h3>
			<br />
			
				<label>Tanggal Awal
				<span class='small'>Isikan tgl awal</span>
				</label>
				<input type='text' id='tglawal' name='tglawal'  class='required' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'statproses')\" />
				
				<label>Tanggal Akhir
				<span class='small'>Isikan tgl akhir</span>
				</label>
				<input type='text' id='tglakhir' name='tglakhir'  class='required' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'seksi')\" />
				
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
			<p></p>
			
			<label>Seksi
					<span class='small'>Seksi</span>
					</label>
					<select name='seksi' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" >
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='all'>Semua Seksi</option>
						<option value='um'>Sub Bagian Umum</option>
						<option value='pd'>Seksi Pencairan Dana</option>
						<option value='bp'>Seksi Bank/Giro Pos</option>
						<option value='vr'>Seksi Verak</option>
					</select>
					
					<input type='submit' value='Tayang' class='button' id='submit' name='Tayangcetakrekapsuratmasuk'  />
					<div class='spacer'></div>
			</form>
		</div>";
	}
	
// Tampilkan tabel pilihan cetak pengantar surat masuk ----------------------------------------------//
elseif($_POST['Tayangcetakrekapsuratmasuk'] == "Tayang"){
	$tglawal 	= $helper->dateConvert($_POST['tglawal']);
	$tglakhir	= $helper->dateConvert($_POST['tglakhir']);
	$seksi		= $_POST['seksi'];
	// query tiap seksi
	if($seksi ==  "all"){
		$query = "SELECT CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,DATE_FORMAT(tglsurat,'%d-%m-%Y') AS tglsurat,perihal,DATE(timeloket) FROM d_suratmasuk WHERE DATE(timeloket) BETWEEN '$tglawal' AND '$tglakhir' AND (um = '1' OR pd = '1' OR bp ='1' OR vr = '1')";
	}elseif($seksi == "um"){
		$query = "SELECT CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,DATE_FORMAT(tglsurat,'%d-%m-%Y') AS tglsurat,perihal,DATE(timeloket) FROM d_suratmasuk WHERE DATE(timeloket) BETWEEN '$tglawal' AND '$tglakhir' AND um = '1'";
	}elseif($seksi == "pd"){
		$query = "SELECT CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,DATE_FORMAT(tglsurat,'%d-%m-%Y') AS tglsurat,perihal,DATE(timeloket) FROM d_suratmasuk WHERE DATE(timeloket) BETWEEN '$tglawal' AND '$tglakhir' AND pd = '1'";
	}elseif($seksi == "bp"){
		$query = "SELECT CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,DATE_FORMAT(tglsurat,'%d-%m-%Y') AS tglsurat,perihal,DATE(timeloket) FROM d_suratmasuk WHERE DATE(timeloket) BETWEEN '$tglawal' AND '$tglakhir' AND bp ='1'";
	}elseif($seksi == "vr"){
		$query = "SELECT CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,DATE_FORMAT(tglsurat,'%d-%m-%Y') AS tglsurat,perihal,DATE(timeloket) FROM d_suratmasuk WHERE DATE(timeloket) BETWEEN '$tglawal' AND '$tglakhir' AND vr = '1'";
	}
	// query mengecek data
	$qcek		= mysql_query("SELECT nomorsuratmasuk FROM d_suratmasuk WHERE DATE(timeloket) BETWEEN '$tglawal' AND '$tglakhir'");
	$rcek		= mysql_num_rows($qcek);
	if($tglawal > $tglakhir){
		echo "<script type='text/javascript'>
			alert('Tanggal awal Anda lebih besar daripada tanggal akhir, mohon perbaiki entri tanggal Anda!');
			window.location.replace('media.php?module=pengantarsuratmasuk')
		</script>";
	}elseif($rcek < 1){
		echo "<script type='text/javascript'>
			alert('Data dimaksud pada range tanggal tidak ada, mohon perbaiki entri tanggal Anda!');
			window.location.replace('media.php?module=pengantarsuratmasuk')
		</script>";
	}else{
		
		echo "<div id='stylized' class='myform'>
	     <form id='form' name='formShowDataSuratMasuk' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
		     <h1>Tabel Pencetakan Rekapitulasi Surat Masuk</h1> 
		     <p>Tabel yang menampilkan data surat masuk untuk keperluan pencetakan rekapitulasi surat masuk</p>
	     </form>
     </div>
     <br />	
				     
    <form name='form1' method='post' action='report/reportcetaksuratmasuk.php'>
     <table class='normaltable' border='0'>
	     <tr>
		     <th width='6%' height='40'>No.</th>
		     <th width='10%'>No.Agenda</th>
		     <th width='15%'>No.Surat</th>
		     <th width='15%'>Asal Surat</th>
		     <th width='10%'>Tgl.Surat</th>
		     <th width='30%'>Perihal</th>
		     <th width='5%'>Cek</th>
	     </tr>";
		
		$q		= mysql_query($query);
		$no	= 1;
	    $oddcol		= "#CCFF99";
	    $evencol		= "#CCDD88";
		while($r 	= mysql_fetch_object($q)){
			if($no % 2 == 0) {$color = $evencol;}
			else{$color = $oddcol;}
			echo"<tr bgcolor='$color'>
		     <td height='80'>$no</td>
		     <td>$r->noagenda</td>
		     <td>$r->nomorsuratmasuk</td>
		     <td>$r->asalsurat</td>
		     <td>$r->tglsurat</td>
		     <td>$r->perihal</td>
		     <td><input type='checkbox' class='checkbox'  name='cetak$no' value='$no' />
	     </tr>";
	     $no++;
		}
		echo "</table>";		
		$n = 1;
		$qData	= mysql_query($query);
		while($rData = mysql_fetch_array($qData)){
			$noagenda			= $rData['noagenda'];
			$nomorsuratmasuk	= $rData['nomorsuratmasuk'];
			$asalsurat			= $rData['asalsurat'];
			$tglsurat			= $rData['tglsurat'];
			$perihal			= $rData['perihal'];
			
			echo "<input type='hidden' name='noagenda$n' value='$noagenda' />
			<input type='hidden' name='nomorsuratmasuk$n' value='$nomorsuratmasuk' />
			<input type='hidden' name='asalsurat$n' value='$asalsurat' />
			<input type='hidden' name='tglsurat$n' value='$tglsurat' />
			<input type='hidden' name='perihal$n' value='$perihal' />";
			$n++;
		}
		$n = $n-1;
		echo "<input type='hidden' name='jumldata' value='$n' />
				<input type='submit' value='Cetak' class='button1' id='submit' name='cetakrekapsuratmasuk' onClick=\"this.form.target='_blank'; return true;\"  />
			    </form>";
	}
}

//Modul Form Surat Tanggapan ========================================================================//
elseif($_GET['module'] == 'surattanggapan'){
	$username	= $_SESSION[namauser];
	$Seksi		= $_SESSION[seksi];
	$seksi		= strtolower($Seksi);
	$SeksiA		= substr($_SESSION[seksi],1,2);
	$seksiA		= strtolower($SeksiA);
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Tabel Surat Tanggapan</h1>
					<p>Form ini digunakan untuk menampilkan data surat masuk yang memerlukan surat tanggapan</p>
			</form>
		</div>
					<br />
					<br />
					<div id='normaltable'>
			
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>No. Surat</th>
					<th width='15%'>Tgl. Surat</th>
					<th width='15%'>Asal Surat</th>
					<th width='15%'>Perihal</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			$querykk	= "SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal,date_format(batasselesai,'%d-%m-%Y') AS batasselesai,file FROM d_suratmasuk WHERE batasselesai!='00-00-0000' AND (kodesuratkeluar='' OR nomorsuratkeluar='') AND statproses='5' ORDER BY statproses, noagenda DESC,nomorsuratmasuk";
			$querynotkkA= "SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal,date_format(batasselesai,'%d-%m-%Y') AS batasselesai,file FROM d_suratmasuk WHERE batasselesai!='00-00-0000' AND $seksiA='1' AND (kodesuratkeluar='' OR nomorsuratkeluar='') AND statproses='5' ORDER BY statproses, noagenda DESC,nomorsuratmasuk";
			$querynotkk = "SELECT idsurat,CONCAT(kodeagenda,'-',noagenda) AS noagenda,nomorsuratmasuk,asalsurat,date_format(date(tglsurat),'%d-%m-%Y') AS tglsurat,perihal,date_format(batasselesai,'%d-%m-%Y') AS batasselesai,file FROM d_suratmasuk WHERE batasselesai!='00-00-0000' AND $seksi='1' AND (kodesuratkeluar='' OR nomorsuratkeluar='') AND statproses='5' ORDER BY statproses, noagenda DESC,nomorsuratmasuk";
			if($seksiA == "k"){
					$querydata = $querykk;
			}
			elseif($seksiA == "um" || $seksiA == "pd" || $seksiA == "bp" || $seksiA == "vr"){
					$querydata = $querynotkkA;
			}
			else{
					$querydata = $querynotkk;
			}
			$qDataSurat		= mysql_query($querydata)or die(mysql_error);
			$no	=1;
			$oddcol			= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSurat	= mysql_fetch_object($qDataSurat)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSurat->noagenda</td>
						<td>$rDataSurat->nomorsuratmasuk</td>
						<td>$rDataSurat->tglsurat</td>
						<td>$rDataSurat->asalsurat</td>
						<td>$rDataSurat->perihal</td>
						<td>
							<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
								<input type='hidden' name='username' value='$username' />
								<input type='hidden' name='idsurat' value='$rDataSurat->idsurat' />
								<input type='submit' class='normaltablesubmit' name='prosessurattanggapan' value='Proses' />
							</form>
						</td>
					</tr>";
				$no++;
			}
			echo "</table>
					</div>
					</form>";

}

// Modul pengambilan nomor surat tanggapan atas surat masuk ----------------------------------------------------------------------------------------//
elseif($_POST['prosessurattanggapan'] == 'Proses'){
	$username	= $_POST['username'];
	$idsurat	= $_POST['idsurat'];
	
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
	
		
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat keluar</h1>
					<p><b>Step I</b> - Data Surat Keluar</p>
					
					<label>Tanggapan Dari
					<span class='small'>Isikan wewenang tanggapan</span>
					</label>
					<select name='seksi'>
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='kk'>Kepala Kantor</option>
						<option value='um'>Sub Bagian Umum</option>
						<option value='pd'>Pencairan Dana</option>
						<option value='bp'>Bank & Giro Pos</option>
						<option value='vr'>Verifikasi & Akuntansi</option>
					</select>
					
					<label>Jenis Surat
					<span class='small'>Isikan jenis nomor surat keluar</span>
					</label>
					<select name='nomorsuratkeluar'>
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='S'>S</option>
						<option value='SP'>SP</option>
						<option value='SPD'>SPD</option>
						<option value='SKPA'>SKPA</option>
						<option value='SPK'>SPK</option>
						<option value='SP2LK'>SP2LK</option>
						<option value='SP2S'>SP2S</option>
						<option value='SP3S'>SP3S</option>
						<option value='SI'>SI</option>
						<option value='SE'>SE</option>
						<option value='ST'>ST</option>
						<option value='SKU'>SKU</option>
						<option value='BA'>BA</option>
						<option value='BAST'>BAST</option>
						<option value='KET'>KET</option>
						<option value='KEP'>KEP</option>
						<option value='ND'>ND</option>
						<option value='NP'>NP</option>
						<option value='PEM'>PEM</option>
						<option value='PRIN'>PRIN</option>
						<option value='UND'>UND</option>
					</select>
					
				
					<label>Tanggal Surat
					<span class='small'>Isikan tgl.surat masuk</span>
					</label>
					<input type='text' id='tanggal' name='tglsurat'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
					
					<label>Tujuan Surat
					<span class='small'>Isikan tujuan surat keluar</span>
					</label>
					<input type='text' id='tujuansurat' name='tujuansurat'  class='required' minlength='3' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
					<label>Perihal
					<span class='small'>Isikan perihal surat keluar</span>
					</label>
					<input type='text' id='perihal' name='perihal'  class='required' minlength='2' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='hidden' name='username' value='$username' />
					<input type='hidden' name='idsurat' value='$idsurat' />
					<input type='submit' value='Rekam' class='button' id='submit' name='Ambilnomorsuratkeluar' />
					<div class='spacer'></div>
				</form>
		</div>";
}
// Modul pengambilan nomor surat keluar ===================================================================================//
elseif($_POST['Ambilnomorsuratkeluar']=='Rekam'){
	$username			= $_POST['username'];
	$idsurat			= $_POST['idsurat'];
	$seksi				= $_POST['seksi'];
	
	// query kode surat keluar
	$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
	$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
	$wpb				= $rKodesuratkeluar->wpb;
	$kp					= $rKodesuratkeluar->kp;
	$yearnow			= substr($_POST['tglsurat'],-4);
	// penomoran surat berdasarkan seksi
	switch($seksi){
		case kk:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case um:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case pd:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case bp:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case vr:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
	}
	$nomorsuratkeluar	= $_POST['nomorsuratkeluar'];
	// converting for mysql databases yyyy-mm-dd
	$tglsurat			= $helper->dateConvert($_POST['tglsurat']);
	$tujuansurat		= $_POST['tujuansurat'];
	$perihal			= $_POST['perihal'];
	// query max nomor surat keluar
	$qMaxnoklr	= mysql_query("SELECT MAX(SUBSTRING_INDEX(SUBSTRING_INDEX(nomorsuratkeluar,'-',2),'-',-1)) maxNoklr FROM d_suratkeluar WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(nomorsuratkeluar,'-',1),'-',-1) = '$nomorsuratkeluar' AND YEAR(tglsurat) = '$yearnow'");
	$rMaxnoklr	= mysql_fetch_array($qMaxnoklr);
	
	// penambahan setiap nomor surat keluar
	$noklr		= $rMaxnoklr['maxNoklr'];
	// casting to integer
	$NoUrut 	= (int) substr($noklr,1,5);
	$NoUrut++;
	$newNoklr	= $nomorsuratkeluar . "-" . sprintf("%05s", $NoUrut);
	
	// nomor surat keluar final
	$nomorsuratkeluar	= $newNoklr . $kodesuratkeluar;
	
	
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  enctype='multipart/form-data'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat keluar</h1>
					<p><b>Step II</b> - Data Surat Keluar</p>
					<label>Nomor Surat
					<span class='small'>Nomor Surat</span>
					</label>
					<input type='text' id='nomorsuratkeluar' minlength='3' name='nomorsuratkeluar'  value='$nomorsuratkeluar' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'file')\" />
					
					<label>Upload Surat
					<span class='small'>Pilih file surat keluar yang telah di-<i>scanning</i> (tanpa spasi)</span>
					</label>
					<input type='file' id='file' name='file'  onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='hidden' name='tglsurat' value='$tglsurat' />
					<input type='hidden' name='tujuansurat' value='$tujuansurat' />
					<input type='hidden' name='perihal' value='$perihal' />					
					<input type='hidden' name='username' value='$username' />
					<input type='hidden' name='idsurat' value='$idsurat' />
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertdatasuratkeluar' />
					<div class='spacer'></div>
				</form>
		</div>";
		
}

// Modul insert data surat keluar ===============================================================================//

elseif($_POST['Insertdatasuratkeluar']=='Rekam'){
		$idsurat	= $_POST['idsurat'];
		$username	= $_POST['username'];
		$NomorSuratKeluar	= $_POST['nomorsuratkeluar'];
		$Nomorsuratkeluar 	= explode('/',$NomorSuratKeluar);
		$nomorsuratkeluar 	= $Nomorsuratkeluar[0];
		$kodesuratkeluar	= $Nomorsuratkeluar[1] . "/" . $Nomorsuratkeluar[2] . "/" . $Nomorsuratkeluar[3];
		$tglsurat	= $_POST['tglsurat'];
		$tujuansurat= $_POST['tujuansurat'];
		$perihal	= $_POST['perihal'];
		
		$lokasi_file	=$_FILES['file']['tmp_name'];
		$nama_file		=$_FILES['file']['name'];
		
		$q				= mysql_query("SELECT nomorsuratmasuk FROM d_suratmasuk WHERE idsurat='$idsurat'");
		$r				= mysql_fetch_object($q);
		$nomorsuratmasuk= $r->nomorsuratmasuk;
		$timepelaksana	= date("Y-m-d H:i:s");
		
		//insert to d_suratkeluar
		mysql_query("INSERT INTO d_suratkeluar(nomorsuratkeluar,kodesuratkeluar,tujuansurat,tglsurat,perihal,nomorsuratmasuk,file,userpelaksana,timepelaksana) 
					VALUES('$nomorsuratkeluar','$kodesuratkeluar','$tujuansurat','$tglsurat','$perihal','$nomorsuratmasuk','$nama_file','$username','$timepelaksana')");
		// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
		$direktori		='suratkeluar/'.basename($nama_file);
		
		move_uploaded_file($lokasi_file,$direktori);
		//update to d_suratmasuk
		mysql_query("UPDATE d_suratmasuk SET nomorsuratkeluar='$nomorsuratkeluar',kodesuratkeluar='$kodesuratkeluar',statproses='6' WHERE idsurat='$idsurat'");
		
		// pop up for confirmation
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Perekaman Data Surat Keluar'>
			<center><b>Data untuk surat keluar dengan nomor surat: <font color='#ffff00'><i>" . $NomorSuratKeluar . "</i></font> berhasil direkam</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
			</form>";
	}

// Modul surat keluar manual----------------------------------------------------------------------------------------//
elseif($_GET['module'] == 'suratkeluarmanual'){
	$username	= $_SESSION[namauser];
	$seksi		= strtolower(trim($_SESSION[seksi]));
	
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
	
		
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat keluar manual</h1>
					<p><b>Step I</b> - Data Surat Keluar Manual</p>
					
					<label>Seksi
					<span class='small'>Seksi</span>
					</label>
					<select name='seksi'>
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='kk'>Kepala Kantor</option>";
						switch($seksi)
						{
							case "um":
								echo "<option value='um'>Sub Bagian Umum</option>";
								echo "<option value='um'>Pencairan Dana</option>";
								echo "<option value='um'>Bank & Giro Pos</option>";
								echo "<option value='um'>Verifikasi & Akuntansi</option>";
								break;
							case "aum":
								echo "<option value='um'>Sub Bagian Umum</option>";
								break;
							case "pd":
								echo "<option value='pd'>Pencairan Dana</option>";
								break;
							case "apd":
								echo "<option value='pd'>Pencairan Dana</option>";
								break;
							case "bp":
								echo "<option value='bp'>Bank & Giro Pos</option>";
								break;
							case "abp":
								echo "<option value='bp'>Bank & Giro Pos</option>";
								break;
							case "vr":
								echo "<option value='vr'>Verifikasi & Akuntansi</option>";
								break;
							case "avr":
								echo "<option value='vr'>Verifikasi & Akuntansi</option>";
								break;
							case "all":
								echo "<option value='vr'>Sub Bagian Umum</option>";
								break;
						}
					echo "
					</select>
					
					<label>Jenis Surat
					<span class='small'>Isikan jenis nomor surat keluar</span>
					</label>
					<select name='nomorsuratkeluar'>
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='S'>S</option>
						<option value='SP'>SP</option>
						<option value='SPD'>SPD</option>
						<option value='SKPA'>SKPA</option>
						<option value='SPK'>SPK</option>
						<option value='SP2LK'>SP2LK</option>
						<option value='SP2S'>SP2S</option>
						<option value='SP3S'>SP3S</option>
						<option value='SI'>SI</option>
						<option value='SE'>SE</option>
						<option value='ST'>ST</option>
						<option value='SKU'>SKU</option>
						<option value='BA'>BA</option>
						<option value='BAST'>BAST</option>
						<option value='KET'>KET</option>
						<option value='KEP'>KEP</option>
						<option value='ND'>ND</option>
						<option value='NP'>NP</option>
						<option value='PEM'>PEM</option>
						<option value='PRIN'>PRIN</option>
						<option value='UND'>UND</option>
					</select>
					
					<label>Nomor Surat Keluar
					<span class='small'>No. srt keluar contoh:1 atau 13</span>
					</label>
					<input type='text' id='nomorsurat' name='nomorsurat'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tanggal')\" />
					
					
					<label>Tanggal Surat
					<span class='small'>Isikan tgl.surat keluar</span>
					</label>
					<input type='text' id='tanggal' name='tglsurat'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
					
					<label>Tujuan Surat
					<span class='small'>Isikan tujuan surat keluar</span>
					</label>
					<input type='text' id='tujuansurat' name='tujuansurat'  class='required' minlength='3' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
					<label>Perihal
					<span class='small'>Isikan perihal surat keluar</span>
					</label>
					<input type='text' id='perihal' name='perihal'  class='required' minlength='2' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='hidden' name='username' value='$username' />
					<input type='submit' value='Rekam' class='button' id='submit' name='Ambilnomorsuratkeluarumum' />
					<div class='spacer'></div>
				</form>
		</div>";
}

// Modul pengambilan nomor surat keluar----------------------------------------------------------------------------------------//
elseif($_GET['module'] == 'suratkeluar'){
	$username	= $_SESSION[namauser];
	$seksi		= strtolower(trim($_SESSION[seksi]));
	
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
	
		
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat keluar</h1>
					<p><b>Step I</b> - Data Surat Keluar</p>
					
					<label>Seksi
					<span class='small'>Seksi</span>
					</label>
					<select name='seksi'>
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='kk'>Kepala Kantor</option>";
						switch($seksi)
						{
							case "um":
								echo "<option value='um'>Sub Bagian Umum</option>";
								break;
							case "aum":
								echo "<option value='um'>Sub Bagian Umum</option>";
								break;
							case "pd":
								echo "<option value='pd'>Pencairan Dana</option>";
								break;
							case "bp":
								echo "<option value='bp'>Bank & Giro Pos</option>";
								break;
							case "vr":
								echo "<option value='vr'>Verifikasi & Akuntansi</option>";
								break;
						}
					echo "
					</select>
					
					<label>Jenis Surat
					<span class='small'>Isikan jenis nomor surat keluar</span>
					</label>
					<select name='nomorsuratkeluar'>
						<option value='' selected='selected'>-- Pilih --</option>
						<option value='S'>S</option>
						<option value='SP'>SP</option>
						<option value='SPD'>SPD</option>
						<option value='SKPA'>SKPA</option>
						<option value='SPK'>SPK</option>
						<option value='SP2LK'>SP2LK</option>
						<option value='SP2S'>SP2S</option>
						<option value='SP3S'>SP3S</option>
						<option value='SI'>SI</option>
						<option value='SE'>SE</option>
						<option value='ST'>ST</option>
						<option value='SKU'>SKU</option>
						<option value='BA'>BA</option>
						<option value='BAST'>BAST</option>
						<option value='KET'>KET</option>
						<option value='KEP'>KEP</option>
						<option value='ND'>ND</option>
						<option value='NP'>NP</option>
						<option value='PEM'>PEM</option>
						<option value='PRIN'>PRIN</option>
						<option value='UND'>UND</option>
					</select>
					
				
					<label>Tanggal Surat
					<span class='small'>Isikan tgl.surat masuk</span>
					</label>
					<input type='text' id='tanggal' name='tglsurat'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
					
					<label>Tujuan Surat
					<span class='small'>Isikan tujuan surat keluar</span>
					</label>
					<input type='text' id='tujuansurat' name='tujuansurat'  class='required' minlength='3' maxlength='50' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
					<label>Perihal
					<span class='small'>Isikan perihal surat keluar</span>
					</label>
					<input type='text' id='perihal' name='perihal'  class='required' minlength='2' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='hidden' name='username' value='$username' />
					<input type='submit' value='Rekam' class='button' id='submit' name='Ambilnomorsuratkeluarumum' />
					<div class='spacer'></div>
				</form>
		</div>";
}

// Modul pengambilan nomor surat keluar ===================================================================================//
elseif($_POST['Ambilnomorsuratkeluarumum']=='Rekam'){
	$username			= $_POST['username'];
	$seksi				= $_POST['seksi'];
	
	// query kode surat keluar
	$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
	$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
	$wpb				= $rKodesuratkeluar->wpb;
	$kp					= $rKodesuratkeluar->kp;
	$yearnow			= substr($_POST['tglsurat'],-4);
	
	switch($seksi){
		case kk:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case um:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case pd:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case bp:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
		case vr:
		$kodesuratkeluar = "/WPB." . $wpb . "/KP." . $kp . "/" . $yearnow;
		break;
	}
	$nomorsuratkeluar	= $_POST['nomorsuratkeluar'];
	// converting for mysql databases yyyy-mm-dd
	$tglsurat			= $helper->dateConvert($_POST['tglsurat']);
	$tujuansurat		= $_POST['tujuansurat'];
	$perihal			= $_POST['perihal'];
	// query max nomor surat keluar
	$qMaxnoklr	= mysql_query("SELECT MAX(SUBSTRING_INDEX(SUBSTRING_INDEX(nomorsuratkeluar,'-',2),'-',-1)) maxNoklr FROM d_suratkeluar WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(nomorsuratkeluar,'-',1),'-',-1) = '$nomorsuratkeluar' AND YEAR(tglsurat) = '$yearnow'");
	$rMaxnoklr	= mysql_fetch_array($qMaxnoklr);
	
	// penambahan setiap nomor surat keluar
	$noklr		= $rMaxnoklr['maxNoklr'];
	// casting to integer
	$NoUrut 	= (int) substr($noklr,1,5);
	$NoUrut++;
	// if nomor manual
	if($_POST['nomorsurat']){
		$NoUrut	= $_POST['nomorsurat'];
	}
	$newNoklr	= $nomorsuratkeluar . "-" . sprintf("%05s", $NoUrut);
	
	// nomor surat keluar final
	$nomorsuratkeluar	= $newNoklr . $kodesuratkeluar;
	
	
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  enctype='multipart/form-data'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data surat keluar</h1>
					<p><b>Step II</b> - Data Surat Keluar</p>
					<label>Nomor Surat
					<span class='small'>Nomor Surat</span>
					</label>
					<input type='text' id='nomorsuratkeluar' minlength='3' name='nomorsuratkeluar'  value='$nomorsuratkeluar' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'file')\" />
					
					<label>Upload Surat
					<span class='small'>Pilih file surat keluar yang telah di-<i>scanning</i> (tanpa spasi)</span>
					</label>
					<input type='file' id='file' name='file'  onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='hidden' name='tglsurat' value='$tglsurat' />
					<input type='hidden' name='tujuansurat' value='$tujuansurat' />
					<input type='hidden' name='perihal' value='$perihal' />					
					<input type='hidden' name='username' value='$username' />
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertdatasuratkeluarumum' />
					<div class='spacer'></div>
				</form>
		</div>";
		
}


// Modul insert data surat keluar umum ===============================================================================//

elseif($_POST['Insertdatasuratkeluarumum']=='Rekam'){
		$idsurat	= $_POST['idsurat'];
		$username	= $_POST['username'];
		$NomorSuratKeluar	= $_POST['nomorsuratkeluar'];
		$Nomorsuratkeluar 	= explode('/',$NomorSuratKeluar);
		$nomorsuratkeluar 	= $Nomorsuratkeluar[0];
		$kodesuratkeluar	= $Nomorsuratkeluar[1] . "/" . $Nomorsuratkeluar[2] . "/" . $Nomorsuratkeluar[3];
		$tglsurat	= $_POST['tglsurat'];
		$tujuansurat= $_POST['tujuansurat'];
		$perihal	= $_POST['perihal'];
		
		$lokasi_file	=$_FILES['file']['tmp_name'];
		$nama_file		=$_FILES['file']['name'];
		
		$q				= mysql_query("SELECT nomorsuratmasuk FROM d_suratmasuk WHERE idsurat='$idsurat'");
		$r				= mysql_fetch_object($q);
		$nomorsuratmasuk= $r->nomorsuratmasuk;
		$timepelaksana	= date("Y-m-d H:i:s");
		
		//insert to d_suratkeluar
		mysql_query("INSERT INTO d_suratkeluar(nomorsuratkeluar,kodesuratkeluar,tujuansurat,tglsurat,perihal,nomorsuratmasuk,file,userpelaksana,timepelaksana) 
					VALUES('$nomorsuratkeluar','$kodesuratkeluar','$tujuansurat','$tglsurat','$perihal','$nomorsuratmasuk','$nama_file','$username','$timepelaksana')");
		// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
		$direktori		='suratkeluar/'.basename($nama_file);
		
		move_uploaded_file($lokasi_file,$direktori);
		
		// pop up for confirmation
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Perekaman Data Surat Keluar'>
			<center><b>Data untuk surat keluar dengan nomor surat: <font color='#ffff00'><i>" . $NomorSuratKeluar . "</i></font> berhasil direkam</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
			</form>";
	}

// Modul Form pencarian surat keluar =======================================================================================//
elseif($_GET['module']=='searchsuratkeluar'){
	echo "<script type=\"text/javascript\">
			$(document).ready(function() {
					$('#tglawalsurat').datepicker({
						changeMonth: true,
						changeYear: true
					});
			});
			$(document).ready(function() {
					$('#tglakhirsurat').datepicker({
						changeMonth: true,
						changeYear: true
					});
			});
		</script>
			<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form multikategori pencarian data surat keluar</h1>
			<p>Form ini digunakan dalam pencarian data surat keluar</p>
					
			<label>Nomor Surat</label>
			<input type='checkbox' class='checkbox' name='nomorsuratkeluarCek' />
			<input type='text' id='nomorsuratkeluar' minlength='3' name='nomorsuratkeluar' maxlength='20' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tglsurat')\" />
			
			<br />
			<br />
			<p><center><b>Range Tanggal Surat</b></center></p>
			<label>Tgl.Awal Surat</label>
			<input type='checkbox' class='checkbox' name='tglawalsuratCek' />
			<input type='text' id='tglawalsurat' name='tglawalsurat' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tglakhirsurat')\" />
			
			<label>Tgl.Akhir Surat</label>
			<input type='checkbox' class='checkbox' name='tglakhirsuratCek' />
			<input type='text' id='tglakhirsurat' name='tglakhirsurat' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
			
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<p></p>
					
			<label>Tujuan Surat</label>
			<input type='checkbox' class='checkbox' name='tujuansuratCek' />
			<input type='text' id='tujuansurat' name='tujuansurat'  maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
					
			<label>Perihal</label>
			<input type='checkbox' class='checkbox' name='perihalCek' />
			<input type='text' id='perihal' name='perihal' maxlength='120' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
			
			<input type='submit' value='Cari' class='button' id='submit' name='cariDokSuratKeluar' />
			<div class='spacer'></div>
			</form>
			</div>";
}

// Modul  Search Surat Keluar----------------------------------------------------------------------------------------------------------------------------------------------//
elseif($_POST['cariDokSuratKeluar'] == "Cari"){
	$nomorsuratkeluarCek	= $_POST['nomorsuratkeluarCek'];
	$tglawalsuratCek		= $_POST['tglawalsuratCek'];
	$tglakhirsuratCek		= $_POST['tglakhirsuratCek'];
	$tujuansuratCek			= $_POST['tujuansuratCek'];
	$perihalCek				= $_POST['perihalCek'];
	$nomorsuratkeluar		= $_POST['nomorsuratkeluar'];
	$Tglawalsurat			= $_POST['tglawalsurat'];
	$tglawalsurat			= $helper->dateConvert($Tglawalsurat);
	$Tglakhirsurat			= $_POST['tglakhirsurat'];
	$tglakhirsurat			= $helper->dateConvert($Tglakhirsurat);
	$tujuansurat			= $_POST['tujuansurat'];
	$perihal				= $_POST['perihal'];
	
	$bagianWhere="";
	
	if(isset($nomorsuratkeluarCek)){
		$nomorsuratmasuk;
		if(empty($bagianWhere)){
			$bagianWhere .= "nomorsuratkeluar='$nomorsuratkeluar'";
		}
	}
	if(isset($tglawalsuratCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "tglsurat>='$tglawalsurat'";
		}
		else{
			$bagianWhere .= "AND tglsurat>='$tglawalsurat'";
		}
	}
	if(isset($tglakhirsuratCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "tglsurat<='$tglakhirsurat'";
		}
		else{
			$bagianWhere .= "AND tglsurat<='$tglakhirsurat'";
		}
	}
	if(isset($tujuansuratCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "tujuansurat REGEXP '$tujuansurat'";
		}
		else{
			$bagianWhere .= "AND tujuansurat REGEXP '$tujuansurat'";
		}
	}
	if(isset($perihalCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "perihal REGEXP '$perihal'";
		}
		else{
			$bagianWhere .= "AND perihal REGEXP '$perihal'";
		}
	}
	
	$queryCek	= "SELECT nomorsuratkeluar,tglsurat,tujuansurat,perihal FROM d_suratkeluar WHERE ".$bagianWhere;
	$qCek		= mysql_query($queryCek)or die(mysql_error());
	$rCek		= mysql_fetch_row($qCek);
	
	if($rCek > 0){
		
		echo "<div id='stylized' class='myform'>
				<form id='form' name='formShowNoRakArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<h1>Form hasil pencarian data surat keluar</h1> 
					<p>Hasil pencarian data surat keluar</p>
					</form>
					</div>
					<br />	
					<table class='normaltable' border='0'>
					<tr>
					<th width='6%'>No.</th>
					<th width='10%'>
						No. Surat<br />
						Tgl. Surat
					</th>
					<th width='25%'>Tujuan Surat</th>
					<th width='25%'>Perihal</th>
					<th width='10%'>Surat Masuk</th>
					<th width='10%'>File Surat Keluar</th>
					<th colspan='2'>Tindakan</th>
					</tr>";
			
			$query		= "SELECT idsurat,nomorsuratmasuk,date_format(tglsurat,'%d-%m-%Y') AS tglsurat,tujuansurat,perihal,CONCAT(nomorsuratkeluar,kodesuratkeluar) AS nomorsuratkeluar,file FROM d_suratkeluar WHERE ".$bagianWhere;
			$qCari		= mysql_query($query)or die(mysql_error());
			$no	= 1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rCari		= mysql_fetch_array($qCari)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
						$idsurat			= $rCari['idsurat'];
						$nomorsuratmasuk	= $rCari['nomorsuratmasuk'];
						$tglsurat			= $rCari['tglsurat'];
						$tujuansurat		= $rCari['tujuansurat'];
						$perihal			= $rCari['perihal'];
						$nomorsuratkeluar	= $rCari['nomorsuratkeluar'];
						$file				= $rCari['file'];
					
						echo"<tr bgcolor='$color'>
								<td>$no</td>
								<td>$nomorsuratkeluar<br />$tglsurat</td>
								<td nowrap='nowrap'>$tujuansurat</td>
								<td nowrap='nowrap'>$perihal</td>
								<td>$nomorsuratmasuk</td>
								<td><b><i><a href='suratkeluar/$file' target='_blank'>$file</a></b></i></td>
								<td><form method='post' action='".$_SERVER['PHP_SELF']."'><input type='hidden' name='idsurat' value='".$idsurat."' /><input type='submit' name='ubahsuratkeluar' value='Ubah' class='normaltablesubmit' /></form></td>
								<td><form method='post' action='".$_SERVER['PHP_SELF']."'><input type='hidden' name='idsurat' value='".$idsurat."' /><input type='submit' name='hapussuratkeluar' value='Hapus' class='normaltablesubmit' /></form></td>
							</tr>";
						$no++;
						}
						echo"</table>";
					
	}
	else{
				echo "<script type='text/javascript'>
						alert('Data tersebut tidak ditemukan');
				</script>";			
	}
}	

// Modul Ubah Surat Keluar ---------------------------------------------------------------
elseif($_POST['ubahsuratkeluar'] == 'Ubah')
{
	echo "<script type=\"text/javascript\">
			$(document).ready(function() {
					$('#tglsurat').datepicker();
			});
		</script>";
	$idsurat = $_POST['idsurat'];
	
	$qUpdate = mysql_query("SELECT idsurat,nomorsuratkeluar,date_format(tglsurat,'%d/%m/%Y') AS tglsurat,tujuansurat,perihal,nomorsuratkeluar,kodesuratkeluar,file FROM d_suratkeluar WHERE idsurat='$idsurat'");
	$rUpdate = mysql_fetch_object($qUpdate);
	
	$idsurat			= $rUpdate->idsurat;
	$nomorsuratkeluar 	= $rUpdate->nomorsuratkeluar;
	$tglsurat			= $rUpdate->tglsurat;
	$tujuansurat		= $rUpdate->tujuansurat;
	$perihal			= $rUpdate->perihal;
	$nomorsuratkeluar	= $rUpdate->nomorsuratkeluar;
	$kodesuratkeluar	= $rUpdate->kodesuratkeluar;
	$file				= $rUpdate->file;

	
		echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' enctype='multipart/form-data' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form update data surat keluar</h1>
			<p>Form ini digunakan untuk melakukan perubahan data surat keluar</p>
				
			<label>Nomor Surat Keluar</label>
			<input type='text' id='nomorsuratkeluar' minlength='3' name='nomorsuratkeluar' value='$nomorsuratkeluar' maxlength='20' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tglsurat')\" />
			
			<label>Tgl.Surat Keluar</label>
			<input type='text' id='tglsurat' name='tglsurat' value='$tglsurat' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'asalsurat')\" />
				
			<label>Tujuan Surat</label>
			<input type='text' id='tujuansurat' name='tujuansurat' value='$tujuansurat' maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'perihal')\" />
			
			<label>Perihal</label>
			<input type='text' id='perihal' name='perihal' value='$perihal' maxlength='200' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" />
			
			<label>File
				<span class='small'>Apabila file yang diupload tidak berubah, biarkan kosong.</span>
				<span class='small'>File awal: <b>$file</b></span>
			</label>
			<input type='file' id='file' name='file' maxlength='45' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
			<input type='hidden' value='$idsurat' name='idsurat' />
			<input type='hidden' value='$file' name='filelama' />
			<input type='submit' value='Simpan' class='button' id='submit' name='simpanUpdateSuratKeluar' />
			<div class='spacer'></div>
			</form>
			</div>";
}

// Modul Simpan Edit Surat Keluar ---------------------------------------------------------------
elseif($_POST['simpanUpdateSuratKeluar'] == 'Simpan')
{
	echo "<script type='text/javascript'>
		$(document).ready(function() {
			$('#promptkonfirmasi').dialog({
				modal: true
			});
		});
	</script>";
	
	$idsurat			= $_POST['idsurat'];
	$nomorsuratkeluar	= $_POST['nomorsuratkeluar'];
	$tglsurat			= $helper->dateConvert($_POST['tglsurat']);
	$tujuansurat		= $_POST['tujuansurat'];
	$perihal			= $_POST['perihal'];
	$filelama			= $_POST['filelama'];
	
	$lokasi_file	=$_FILES['file']['tmp_name'];
	$nama_file		=$_FILES['file']['name'];
	
	if($nama_file == 0)
	{
		$qUpdate = mysql_query("UPDATE d_suratkeluar SET nomorsuratkeluar='$nomorsuratkeluar',tglsurat='$tglsurat',tujuansurat='$tujuansurat',perihal='$perihal' WHERE idsurat=$idsurat");
		
		echo "<div id='promptkonfirmasi' title='Konfirmasi Update Data Surat Keluar'>
		<center><b>Data surat keluar dengan nomor surat: <font color='#ffff00'><i>" . $nomorsuratkeluar . "</i></font> dan perihal <font color='#ffff00'><i>" . $perihal . "</i></font> berhasil diubah</b></center>
		<br />
		<br />
		<table border='0' align='center'>
		<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
		</form>";
	}
	else
	{
		$qUpdate = mysql_query("UPDATE d_suratkeluar SET nomorsuratkeluar='$nomorsuratkeluar',tglsurat='$tglsurat',tujuansurat='$tujuansurat',perihal='$perihal',file='$nama_file' WHERE idsurat=$idsurat");
		
		unlink('suratkeluar/'.basename($filelama));
		$direktori		= 'suratkeluar/'.basename($nama_file);
		move_uploaded_file($lokasi_file,$direktori);
		
		echo "<div id='promptkonfirmasi' title='Konfirmasi Update Data Surat Keluar'>
		<center><b>Data surat keluar dengan nomor surat: <font color='#ffff00'><i>" . $nomorsuratkeluar . "</i></font> dan perihal <font color='#ffff00'><i>" . $perihal . "</i></font> berhasil diubah</b></center>
		<br />
		<br />
		<table border='0' align='center'>
		<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
		</form>";
	}
}

// Modul Hapus Surat Keluar ---------------------------------------------------------------
elseif($_POST['hapussuratkeluar'] == 'Hapus')
{
	echo "<script type='text/javascript'>
	$(document).ready(function() {
		$('#promptkonfirmasi').dialog({
			modal: true
		});
	});
	</script>";
	
	$idsurat = $_POST['idsurat'];
	
	mysql_query("DELETE FROM d_suratkeluar WHERE idsurat = '$idsurat'");
	
	echo "<div id='promptkonfirmasi' title='Konfirmasi Hapus Data Surat Keluar'>
	<center><b>Data surat keluar telah dihapus</b></center>
	<br />
	<br />
	<table border='0' align='center'>
	<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
		<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
	</form>";
}
// Keluar Aplikasi ===============================================================================//
elseif($_GET['module'] == 'keluar'){
	session_start();
	session_destroy();
	header('location: index.php');

}


?>
<style>
.img{
	border:2px solid #72a143;
	padding:2px;
	background:#ffeda5;
}
.img2{
	border:2px solid #F0892C;
	padding:2px;
	background:#ffeda5;
}
</style>
