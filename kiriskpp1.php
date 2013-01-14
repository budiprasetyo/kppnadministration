<?php
//$PhpEncoder = new CPhpEncoder();    
$timezone 	= "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
     // Halaman utama (Home)
if ($_GET['module']=='home'){
   
}

// Form insert data tanda terima SKPP Seksi Sub Bagian Umum
elseif($_GET['module'] == 'tandaterimaskpp'){
	$year		= date('Y');
	$qMaxagd	= mysql_query("SELECT MAX(noagenda) maxAgd FROM d_skpp WHERE noagenda LIKE 'SKPP%' AND RIGHT(tgagdtrm,4) = '$year'");
	$rMaxagd	= mysql_fetch_array($qMaxagd);
	
	//penambahan setiap nomor agenda
	$noagd		= $rMaxagd['maxAgd'];
	$jenAgd	= 'SKPP';
	$noUrut	= (int) substr($noagd,6,5);
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
	
			$(document).ready(function(){
				$('#form').validate();
				$('#tgagdtrm').datepicker();
			});
			$(document).ready(function(){
				$('#form').validate();
				$('#tgagdsls').datepicker();
			});
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data SKPP</h1>
					<p><b>Step 1</b> - Data SKPP ini akan digunakan dalam proses penerbitan Surat Pengantar SKPP</p>
					<label>Nomor Agenda
					<span class='small'>Nomor agenda</span>
					</label>
					<input type='text' id='noagenda' class='required' minlength='3' name='noagenda' maxlength='10' value='$newAgd' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'staskpp')\" />
	
					<label>Status SKPP
					<span class='small'>Isikan status SKPP</span>
					</label>
					<select name='staskpp' id='staskpp' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'kdjenskpp')\" >
						<option selected='selected'>-- Pilih Status SKPP --</option>
						<option value='01'>01 - PNS</option>
						<option value='02'>02 - TNI</option>
						<option value='03'>03 - POLRI</option>
					</select>
					
					<label>Jenis SKPP
					<span class='small'>Isikan jenis SKPP</span>
					</label>
					<select name='kdjenskpp' id='kdjenskpp' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'kdgpp')\" >
					<option selected='selected'>-- Pilih Jenis SKPP --</option>
					<option value='01'>01 - Pindah</option>
					<option value='02'>02 - Pensiun</option>
					</select>
					
					<label>Kode GPP
					<span class='small'>Pilih kode GPP</span>
					</label>
					<select name='kdgpp' id='kdgpp' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'noskpp')\" >
					<option selected='selected'>-- Pilih kode GPP --</option>
					<option value='00'>00 - Non GPP</option>
					<option value='01'>01 - GPP</option>
					</select>
					
					<label>Nomor SKPP
					<span class='small'>Isikan nomor SKPP</span>
					</label>
					<input type='text' id='noskpp' name='noskpp'  class='required' minlength='1' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tanggal')\" />
					
					<label>Tanggal SKPP
					<span class='small'>Isikan tanggal SKPP</span>
					</label>
					<input type='text' id='tanggal' name='tgskpp'  class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
					
					<label>Kode Satker
					<span class='small'>Isikan kode satker</span>
					</label>
					<input type='text' id='kdsatker' name='kdsatker'  class='required' minlength='6' maxlength='6' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'anskpp')\" />
					
					<label>Nama Pegawai
					<span class='small'>Isikan nama pegawai/janda/duda</span>
					</label>
					<input type='text' id='anskpp' name='anskpp'  class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nip')\" />
					
					<label>NIP/NRP
					<span class='small'>Isikan NIP/NRP pegawai</span>
					</label>
					<input type='text' id='nip' name='nip'  class='required' minlength='2' maxlength='18' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'pangkat')\" />
					
					<label>Pangkat/Golongan
					<span class='small'>Isikan pangkat pegawai</span>
					</label>";
					$qPangkat	= mysql_query("SELECT kdgol,nmgol1,nmgol2 FROM t_golongan");
					echo "<select name='pangkat' id='pangkat' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'alamat')\">
							<option selected='selected'>--Pilih Golongan/Pangkat--</option>";
					while($rPangkat	= mysql_fetch_array($qPangkat)){
						$kdgol		= $rPangkat['kdgol'];
						$nmgol1	= $rPangkat['nmgol1'];
						$nmgol2	= $rPangkat['nmgol2'];
						echo "<option value='$kdgol'>$nmgol1&nbsp;&nbsp;&nbsp;$nmgol2</option>";
					}
					echo "</select>
							
					<label>Alamat
					<span class='small'>Isikan alamat pegawai/janda/duda</span>
					</label>
					<input type='text' id='alamat' name='alamat'  class='required' minlength='2' maxlength='45' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tgagdtrm')\" />
						
					<label>Tanggal terima SKPP
					<span class='small'>Isikan tanggal penerimaan SKPP</span>
					</label>
					<input type='text' id='tgagdtrm' name='tgagdtrm'  class= 'required' minlength='1' maxlength='10'   onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tgagdsls')\" />
						
					<label>Tanggal selesai SKPP
					<span class='small'>Isikan tanggal penyelesaian SKPP</span>
					</label>
					<input type='text' id='tgagdsls' name='tgagdsls'  class= 'required' minlength='1' maxlength='10'   onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertdatatujuanskpp' />
					<div class='spacer'></div>
				</form>
		</div>";
}

//  Form insert tujuan SKPP beserta kota tujuan
elseif($_POST['Insertdatatujuanskpp'] == 'Rekam'){
	
	$kdsatker	= $_POST['kdsatker'];
	$qSatker	= mysql_query("SELECT kdsatker FROM t_satker WHERE kdsatker='$kdsatker'")or die(mysql_error);
	$rSatker	= mysql_num_rows($qSatker);
	// Konfirmasi muncul pop up apabila kode satker tidak ada dalam kode referensi
	if($rSatker < 1){
		echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#promptkonfirmasi').dialog({
					modal: true
					});
				});
		</script>
				<div id='promptkonfirmasi' title='Konfirmasi Kode Satker Data SKPP'>
				<center><b>Kode satker $kdsatker tidak terdaftar dalam referensi!</b></center>
				<br />
				<br />
				<table border='0' align='center'>
				<form name='form1' method='get' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='hidden' name='module' value='tandaterimaskpp' /><input type='submit' name='konfirmasirekamskpp' value='Kembali'  /></td>
				</form>";
	}
	elseif(isset($_POST['staskpp']) && $_POST['staskpp'] == '01' && isset($_POST['kdgpp']) && $_POST['kdgpp'] == '00'){
		echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#promptkonfirmasi').dialog({
						modal: true
					});
				});
			</script>
				<div id='promptkonfirmasi' title='Konfirmasi Status SKPP dengan Kode GPP'>
				<center><b>Status pegawai adalah PNS tetapi tidak menggunakan aplikasi GPP. Untuk PNS wajib menggunakan aplikasi GPP!</b></center>
				<br />
				<br />
				<table border='0' align='center'>
				<form name='form1' method='get' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='hidden' name='module' value='tandaterimaskpp' /><input type='submit' name='konfirmasirekamskpp' value='Kembali'  /></td>
						</form>";
	}
	else{
	// Jika kdjenskpp = SKPP Pindah
	if($_POST['kdjenskpp'] == "01"){
			$noagenda	= $_POST['noagenda'];
			$kdjenskpp	= $_POST['kdjenskpp'];
			$kdgpp		= $_POST['kdgpp'];
			$noskpp	= $_POST['noskpp'];
			$TgSkpp	= $_POST['tgskpp'];
			$staskpp	= $_POST['staskpp'];
			$anskpp	= $_POST['anskpp'];
			$kdsatker	= $_POST['kdsatker'];
			$nip		= $_POST['nip'];
			$pangkat	= $_POST['pangkat'];
			$alamat		= $_POST['alamat'];
			$tgagdtrm	= $_POST['tgagdtrm'];
			$tgagdsls	= $_POST['tgagdsls'];
			
			echo "<div id='stylized' class='myform'>
					<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
					<h1>Form perekaman data SKPP</h1>
					<p><b>Step 2</b> - Data SKPP ini akan digunakan dalam proses penerbitan Surat Pengantar SKPP</p>
							
					<label>Kota Satker Asal
					<span class='small'>Isikan kota satker asal</span>
					</label>
					<input type='text' id='kotaasal' name='kotaasal'  class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kotatujuan')\" />
							
					<label>Kota Tujuan SKPP
					<span class='small'>Isikan kota tujuan SKPP</span>
					</label>
					<input type='text' id='kotatujuan' name='kotatujuan'  class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'satkerbaru')\" />
							
					<label>Nama satker baru/tujuan
					<span class='small'>Isikan nama satker baru/tujuan</span>
					</label>
					<input type='text' id='satkerbaru' name='satkerbaru'  class='required' minlength='2' maxlength='60' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tujuanskpp')\" />		
							
					<label>KPPN Tujuan SKPP
					<span class='small'>Isikan KPPN tujuan SKPP</span>
					</label>
					<input type='text' id='tujuanskpp' name='tujuanskpp'  class='required' minlength='2' maxlength='60' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />		
							
					<input type='hidden' name='noagenda' value='$noagenda' />
					<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
					<input type='hidden' name='kdgpp' value='$kdgpp' />
					<input type='hidden' name='noskpp' value='$noskpp' />
					<input type='hidden' name='tgskpp' value='$TgSkpp' />
					<input type='hidden' name='staskpp' value='$staskpp' />
					<input type='hidden' name='anskpp' value='$anskpp' />
					<input type='hidden' name='kdsatker' value='$kdsatker' />
					<input type='hidden' name='nip' value='$nip' />
					<input type='hidden' name='pangkat' value='$pangkat' />
					<input type='hidden' name='alamat' value='$alamat' />
					<input type='hidden' name='tgagdtrm' value='$tgagdtrm' />
					<input type='hidden' name='tgagdsls' value='$tgagdsls' />
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertdataskpp' />
					<div class='spacer'></div>
					</form>
					</div>";
	}
	// Jika kdjenskpp = SKPP Pensiun
	else{
			$noagenda	= $_POST['noagenda'];
			$kdjenskpp	= $_POST['kdjenskpp'];
			$kdgpp		= $_POST['kdgpp'];
			$noskpp	= $_POST['noskpp'];
			$TgSkpp	= $_POST['tgskpp'];
			$staskpp	= $_POST['staskpp'];
			$anskpp	= $_POST['anskpp'];
			$kdsatker	= $_POST['kdsatker'];
			$nip		= $_POST['nip'];
			$pangkat	= $_POST['pangkat'];
			$alamat		= $_POST['alamat'];
			$tgagdtrm	= $_POST['tgagdtrm'];
			$tgagdsls	= $_POST['tgagdsls'];
			$qnmsatker= mysql_query("SELECT nmsatker FROM t_satker WHERE kdsatker='$kdsatker'")or die(mysql_error);
			$rnmsatker = mysql_fetch_array($qnmsatker);
			$nmsatker	= $rnmsatker[0];
				
				
				
			echo "<div id='stylized' class='myform'>
					<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
					<h1>Form perekaman data SKPP</h1>
							<p><b>Step 2</b> - Data SKPP ini akan digunakan dalam proses penerbitan Surat Pengantar SKPP</p>
							
							<label>Kota Satker Asal
							<span class='small'>Isikan kota satker asal</span>
							</label>
							<input type='text' id='kotaasal' name='kotaasal'  class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kotatujuan')\" />
							
							<label>Kota Tujuan SKPP
							<span class='small'>Isikan kota tujuan SKPP</span>
							</label>
							<input type='text' id='kotatujuan' name='kotatujuan'  class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
								
							<input type='hidden' name='noagenda' value='$noagenda' />
							<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
							<input type='hidden' name='kdgpp' value='$kdgpp' />
							<input type='hidden' name='noskpp' value='$noskpp' />
							<input type='hidden' name='tgskpp' value='$TgSkpp' />
							<input type='hidden' name='staskpp' value='$staskpp' />
							<input type='hidden' name='anskpp' value='$anskpp' />
							<input type='hidden' name='kdsatker' value='$kdsatker' />
							<input type='hidden' name='nip' value='$nip' />
							<input type='hidden' name='pangkat' value='$pangkat' />
							<input type='hidden' name='alamat' value='$alamat' />
							<input type='hidden' name='tgagdtrm' value='$tgagdtrm' />
							<input type='hidden' name='tgagdsls' value='$tgagdsls' />
							<input type='submit' value='Rekam' class='button' id='submit' name='Insertdataskpp' />
							<div class='spacer'></div>
							</form>
							</div>";
		}
	}
}

// Action insert data SKPP dari tanda terima SKPP Seksi Sub Bagian Umum
elseif($_POST['Insertdataskpp'] == 'Rekam'){
	
	
	$noagenda	= $_POST['noagenda'];
	$kdjenskpp	= $_POST['kdjenskpp'];
	$kdgpp		= $_POST['kdgpp'];
	$noskpp	= $_POST['noskpp'];
	$TgSkpp	= $_POST['tgskpp'];
	$Tgskpp	= explode('/',$TgSkpp);
	$thnskpp	= $Tgskpp[2];
	$blnskpp	= $Tgskpp[1];
	$tglskpp	= $Tgskpp[0];
	$tgskpp		= $thnskpp.'-'.$blnskpp.'-'.$tglskpp;
	$staskpp	= $_POST['staskpp'];
	$anskpp	= $_POST['anskpp'];
	$nip		= $_POST['nip'];
	$pangkat	= $_POST['pangkat'];
	$alamat		= $_POST['alamat'];
	$kdsatker	= $_POST['kdsatker'];
	$satkerbaru = $_POST['satkerbaru'];
	$kotaasal	= $_POST['kotaasal'];
	$tujuanskpp= $_POST['tujuanskpp'];
	$kotatujuan	= $_POST['kotatujuan'];
	$TgAgdtrm	= $_POST['tgagdtrm'];
	$TgagdTrm	= explode('/',$TgAgdtrm);
	$thntrm	= $TgagdTrm[2];
	$blntrm		= $TgagdTrm[1];
	$tgltrm		= $TgagdTrm[0];
	$tgagdtrm	= $thntrm.'-'.$blntrm.'-'.$tgltrm;
	$TgAgdsls	= $_POST['tgagdsls'];
	$TgagdSls	= explode('/',$TgAgdsls);
	$thnsls		= $TgagdSls[2];
	$blnsls		= $TgagdSls[1];
	$tglsls		= $TgagdSls[0];
	$tgagdsls	= $thnsls.'-'.$blnsls.'-'.$tglsls;
	$username	= $_SESSION[namauser];
	
	$qkppn		= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa='1'");
	$rkppn		= mysql_fetch_array($qkppn);
	$kppn		= $rkppn['nmkppn'];
	// Jika Non GPP & Pindah (TNI Pindah SKPP akan ditujukan ke KPPN Tujuan) Status terima loket umum statproses=1
	if($kdgpp == "00" && $kdjenskpp == "01"){
		mysql_query("INSERT INTO d_skpp(noagenda,kdjenskpp,kdgpp,noskpp,tgskpp,staskpp,anskpp,nip,pangkat,alamat,kdsatker,tujuanskpp,kotatujuan,satkerbaru,kotaasal,tgagdtrm,tgagdsls,userterimaum,statproses) VALUES('$noagenda','$kdjenskpp','$kdgpp','$noskpp','$tgskpp','$staskpp','$anskpp','$nip','$pangkat','$alamat','$kdsatker','$tujuanskpp','$kotatujuan','$satkerbaru','$kotaasal','$tgagdtrm','$tgagdsls','$username','1')");
	}
	// Jika Non GPP & Pensiun (TNI Pindah SKPP akan ditujukan ke Asabri) Status terima loket umum statproses=1
	elseif($kdgpp == "00" && $kdjenskpp == "02"){
			mysql_query("INSERT INTO d_skpp(noagenda,kdjenskpp,kdgpp,noskpp,tgskpp,staskpp,anskpp,nip,pangkat,alamat,kdsatker,kotatujuan,kotaasal,tgagdtrm,tgagdsls,userterimaum,statproses) VALUES('$noagenda','$kdjenskpp','$kdgpp','$noskpp','$tgskpp','$staskpp','$anskpp','$nip','$pangkat','$alamat','$kdsatker','$kotatujuan','$kotaasal','$tgagdtrm','$tgagdsls','$username','1')");
	}
	// Jika GPP & Pindah (PNS Pindah SKPP akan ditujukan ke  KPA Satker Asal) Status terima loket umum statproses=1
	elseif($kdgpp == "01" && $kdjenskpp == "01"){
		mysql_query("INSERT INTO d_skpp(noagenda,kdjenskpp,kdgpp,noskpp,tgskpp,staskpp,anskpp,nip,pangkat,alamat,kdsatker,tujuanskpp,kotatujuan,satkerbaru,kotaasal,tgagdtrm,tgagdsls,userterimaum,statproses) VALUES('$noagenda','$kdjenskpp','$kdgpp','$noskpp','$tgskpp','$staskpp','$anskpp','$nip','$pangkat','$alamat','$kdsatker','$tujuanskpp','$kotatujuan','$satkerbaru','$kotaasal','$tgagdtrm','$tgagdsls','$username','1')");
	}		
	// Jika GPP & Pensiun (PNS Pensiun SKPP akan ditujukan ke  KPA Satker Asal) Status terima loket umum statproses=1
	elseif($kdgpp == "01" && $kdjenskpp == "02"){
		mysql_query("INSERT INTO d_skpp(noagenda,kdjenskpp,kdgpp,noskpp,tgskpp,staskpp,anskpp,nip,pangkat,alamat,kdsatker,kotatujuan,kotaasal,tgagdtrm,tgagdsls,userterimaum,statproses) VALUES('$noagenda','$kdjenskpp','$kdgpp','$noskpp','$tgskpp','$staskpp','$anskpp','$nip','$pangkat','$alamat','$kdsatker','$kotatujuan','$kotaasal','$tgagdtrm','$tgagdsls','$username','1')");
	}	
	
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Entri Data SKPP'>
			<center><b>Data SKPP a.n. $anskpp dengan no. SKPP $noskpp berhasil direkam</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekamskpp' value='Kembali'  /></td>
			</form>
			<form name='form1' method='post' action='reporttandaterimaskpp.php'>
				<input type='hidden' name='noagenda' value='$noagenda' />
				<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
				<input type='hidden' name='kdgpp' value='$kdgpp' />
				<input type='hidden' name='noskpp' value='$noskpp' />
				<input type='hidden' name='tgskpp' value='$TgSkpp' />
				<input type='hidden' name='staskpp' value='$staskpp' />
				<input type='hidden' name='anskpp' value='$anskpp' />
				<input type='hidden' name='nip' value='$nip' />
				<input type='hidden' name='pangkat' value='$pangkat' />
				<input type='hidden' name='alamat' value='$alamat' />
				<input type='hidden' name='kdsatker' value='$kdsatker' />
				<input type='hidden' name='tujuanskpp' value='$tujuanskpp' />
				<input type='hidden' name='kotatujuan' value='$kotatujuan' />
				<input type='hidden' name='username' value='$username' />
				<input type='hidden' name='kppn' value='$kppn' />
				<input type='hidden' name='tgagdtrm' value='$tgagdtrm' />
				<input type='hidden' name='tgagdsls' value='$tgagdsls' />
				<td><input type='submit' name='konfirmasirekamskpp' value='Cetak' onClick=\"this.form.target='_blank'; return true;\"  /></td></tr>
			</form>
			</table>
			</div>";
}

// Tabel SKPP GPP untuk melakukan pemrosesan SKPP di Seksi Pencairan Dana GPP
// GPP Pelaksana Pencairan Dana
elseif($_GET['module']	== "prosesskpp"){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Proses SKPP</h1>
					<p>Proses SKPP meliputi proses edit data SKPP, cetak konsep SP SKPP, dan cetak net SP SKPP</p>
			</form>
		</div>
					<br />
					<br />
					<div id='normaltable'>
			
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y'),anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y'),date(tgagdsls),tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses,tujuanskpp,pangkat,userterimaum,userparafkasipd,tgparafkasipd,usertdtgnkasipd,tgtdtgnkasipd,userterimaum FROM d_skpp WHERE kdgpp='01' AND statproses!='0' AND namapengambil is null  ORDER BY statproses, noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol	= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_row($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSkpp[0]</td>
						<td>$rDataSkpp[1]</td>
						<td>$rDataSkpp[2]</td>
						<td>$rDataSkpp[3]</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $rDataSkpp[5]){
							echo "<td>$rDataSkpp[4]</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$rDataSkpp[4]</b></font></td>";
						}
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						switch($rDataSkpp[11]){
							// Jika status proses = 1 aktifkan tombol cetak konsep
							case 1:
								echo "<td>
										<form name='form1' method='post' action='report/report.php'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
										<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
										<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />";
											// Nomor surat keluar pengantar SKPP
											$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
											$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
											$wpb				= $rKodesuratkeluar->wpb;
											$kp					= $rKodesuratkeluar->kp;
											$yearnow			= substr($rDataSkpp[1],-4);
											$nomorsuratkeluar	= "SP-  ";
											$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
											$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
											echo "
										<input type='hidden' name='nosurat' value='$newNoklr' />
										<input type='submit' class='normaltablesubmit' name='reportkonsepskpp' value='Tayang' onClick=\"this.form.target='_blank'; return true;\"  />
										</form>
									</td>
									<td>
										<form name='form1' method='post' action='report/report.php'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />";
											// Nomor surat keluar pengantar SKPP
											$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
											$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
											$wpb				= $rKodesuratkeluar->wpb;
											$kp					= $rKodesuratkeluar->kp;
											$yearnow			= substr($rDataSkpp[1],-4);
											$nomorsuratkeluar	= "SP-  ";
											$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
											$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
											echo "
											<input type='hidden' name='nosurat' value='$newNoklr' />
											<input type='submit' class='normaltablesubmit' name='reportkonsepskpp' value='Konsep' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank'; return true;\"  />
										</form>
									</td>
									<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='editSkpp' value='Edit' />
										</form>
									</td>";
								break;
						// Jika status proses = 3 paraf Kasi PD => aktifkan tombol cetak net
							case 3:
								echo "<td>
										<form name='form1' method='post' action='report/report.php'>";
										// Proses Nomor Net SP
										$qN 	= "SELECT max(nomorsuratkeluar) AS maxSklr FROM d_suratkeluar WHERE nomorsuratkeluar LIKE 'SP-%' AND YEAR(tglsurat) = '$yearnow'";
										$qNet	= mysql_query($qN);
										$rNet	= mysql_fetch_object($qNet);
										$MaxSklr= explode('-',$rNet->maxSklr);
										$huruf	= $MaxSklr[0];
										$angka	= $MaxSklr[1];
										// Casting to integer
										$nourut	= (int) substr($angka,1,5);
										$nourut++;
										// Nomor surat keluar pengantar SKPP
										$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
										$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
										$wpb				= $rKodesuratkeluar->wpb;
										$kp					= $rKodesuratkeluar->kp;
										$yearnow			= substr($rDataSkpp[1],-4);
										$nomorsuratkeluar	= "SP-".sprintf("%05s",$nourut);
										$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
										$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
										echo "
										<input type='hidden' name='nosurat' value='$newNoklr' />
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='status' value='$rDataSkpp[11]' />
										<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
										<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
										<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
										<input type='submit' class='normaltablesubmit' name='reportkonsepskpp' value='Tayang' onClick=\"this.form.target='_blank'; return true;\"  />
										</form>
									</td>
									<td>
										<form method='post' action='report/report.php'>
											<input type='hidden' name='username' value='$username' />";
											$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
											$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
											$wpb				= $rKodesuratkeluar->wpb;
											$kp					= $rKodesuratkeluar->kp;
											$yearnow			= substr($rDataSkpp[1],-4);
											// Proses Nomor Net SP
											$qN 	= "SELECT max(nomorsuratkeluar) AS maxSklr FROM d_suratkeluar WHERE nomorsuratkeluar LIKE 'SP-%' AND YEAR(tglsurat) = '$yearnow'";
											$qNet	= mysql_query($qN);
											$rNet	= mysql_fetch_object($qNet);
											$MaxSklr= explode('-',$rNet->maxSklr);
											$huruf	= $MaxSklr[0];
											$angka	= $MaxSklr[1];
											// Casting to integer
											$nourut	= (int) substr($angka,1,5);
											$nourut++;
											// Preparing to insert into SKPP table and suratmasuk table
											// Nomor surat keluar pengantar SKPP
											$nomorsuratkeluar	= "SP-".sprintf("%05s",$nourut);
											$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
											// Preparing to update table d_skpp(nospskpp) where noagdskpp
											$nospskpp			= $nomorsuratkeluar."/".$kodesuratkeluar;
											$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
											$tujuansurat		= $rDataSkpp[12];
											// Preparing to update table d_skpp(tgspskpp) where noagdskpp and d_suratkeluar
											$tglsurat			= date('Y-m-d');
											$perihal			= "SKPP a.n. ".$rDataSkpp[2];
											$userpelaksana		= $rDataSkpp[14];
											$Timepelaksana		= new DateTime;
											$timepelaksana		= $Timepelaksana->format('Y-m-d H:i:s');
											$userkasi			= $rDataSkpp[15];
											$timekasi			= $rDataSkpp[16];
											$userpejabat		= $rDataSkpp[17];
											$timepejabat		= $rDataSkpp[18];
											$usertrmsekret		= $rDataSkpp[19];
											$Timetrmsekret		= new DateTime($rDataSkpp[1]);
											$timetrmsekret		= $Timetrmsekret->format('Y-m-d H:i:s');
											$nomorsuratmasuk	= $rDataSkpp[0];
											echo "
											<input type='hidden' name='nomorsuratkeluar' value='$nomorsuratkeluar' />
											<input type='hidden' name='kodesuratkeluar' value='$kodesuratkeluar' />
											<input type='hidden' name='tujuansurat' value='$tujuansurat' />
											<input type='hidden' name='tglsurat' value='$tglsurat' />
											<input type='hidden' name='perihal' value='$perihal' />
											<input type='hidden' name='userpelaksana' value='$userpelaksana' />
											<input type='hidden' name='timepelaksana' value='$timepelaksana' />
											<input type='hidden' name='userkasi' value='$userkasi' />
											<input type='hidden' name='timekasi' value='$timekasi' />
											<input type='hidden' name='userpejabat' value='$userpejabat' />
											<input type='hidden' name='timetrmpejabat' value='$timepejabat' />
											<input type='hidden' name='usertrmsekret' value='$usertrmsekret' />
											<input type='hidden' name='timetrmsekret' value='$timetrmsekret' />
											<input type='hidden' name='nomorsuratmasuk' value='$nomorsuratmasuk' />
											
											<input type='hidden' name='nospskpp' value='$nospskpp' />
											<input type='hidden' name='tgspskpp' value='$tglsurat' />
											<input type='hidden' name='noagenda' value='$nomorsuratmasuk' />
											
											<input type='hidden' name='nosurat' value='$newNoklr' />
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='status' value='$rDataSkpp[11]' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='reportnetskpp' value='Net' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank';return true;\" />
										</form>
									</td>
									<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='editSkpp' value='Edit' />
										</form>
									</td>";
								break;
						// Jika status proses = 2 cetak konsep PD
							case 2:
								echo "<td width='15%' colspan='2'>Cetak konsep</td>
									<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='editSkpp' value='Edit' />
										</form>
									</td>";
								break;
						// Jika status proses = 4 cetak net PD
							case 4:
								echo "<td colspan='3'>Cetak net</td>";
								break;
						// Jika status proses = 5 tdtangan net  Kasi PD
							case 5:
								echo "<td colspan='3'>Td.Tgn.Kasi.PD</td>";
								break;
						// Jika status proses = 6 split Sub Bagian Umum
							case 6:
								echo "<td colspan='3'>Split SKPP</td>";
								break;
						// Jika status proses = 7 Loket Pengambilan Sub Bagian Umum
							case 7:
								echo "<td colspan='3'>Loket pengambilan</td>";
								break;
						}
						echo "</tr>";
				$no++;
			}
			echo "</table>
					</div>
					</form>";
}

// Tabel SKPP Non GPP untuk melakukan pemrosesan SKPP di Seksi Pencairan Dana Non GPP
// Non GPP Pelaksana Pencairan Dana
elseif($_GET['module']	== "prosesskppn"){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Proses SKPP</h1>
					<p>Proses SKPP meliputi proses edit data SKPP, cetak konsep SP SKPP, dan cetak net SP SKPP</p>
			</form>
		</div>
					<br />
					<br />
					<br />
					<br />
					<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y'),anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y'),date(tgagdsls),tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='00' AND statproses!='0' AND  namapengambil is null  ORDER BY statproses,noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_row($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='35'>$no</td>
						<td>$rDataSkpp[0]</td>
						<td>$rDataSkpp[1]</td>
						<td>$rDataSkpp[2]</td>
						<td>$rDataSkpp[3]</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $rDataSkpp[5]){
					echo "<td>$rDataSkpp[4]</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$rDataSkpp[4]</b></font></td>";
						}
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						switch($rDataSkpp[11]){
							// Jika status proses = 1 aktifkan tombol cetak konsep
							case 1:
								echo "<td>
										<form name='form1' method='post' action='report/report.php'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />";
											// Nomor surat keluar pengantar SKPP
											$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
											$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
											$wpb				= $rKodesuratkeluar->wpb;
											$kp					= $rKodesuratkeluar->kp;
											$yearnow			= substr($rDataSkpp[1],-4);
											$nomorsuratkeluar	= "SP-  ";
											$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
											$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
											echo "
											<input type='hidden' name='nosurat' value='$newNoklr' />
											<input type='submit' class='normaltablesubmit' name='reportkonsepskpp' value='Tayang' onClick=\"this.form.target='_blank'; return true;\"  />
										</form>
										</td>
										<td>
										<form name='form1' method='post' action='report/report.php'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />";
											// Nomor surat keluar pengantar SKPP
											$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
											$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
											$wpb				= $rKodesuratkeluar->wpb;
											$kp					= $rKodesuratkeluar->kp;
											$yearnow			= substr($rDataSkpp[1],-4);
											$nomorsuratkeluar	= "SP-  ";
											$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
											$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
											echo "
											<input type='hidden' name='nosurat' value='$newNoklr' />
											<input type='submit' class='normaltablesubmit' name='reportkonsepskpp' value='Konsep' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank'; return true;\" />
										</form>
										</td>
										<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='editSkpp' value='Edit' />
										</form>
										</td>";
										break;
						// Jika status proses = 3 paraf Kasi PD => aktifkan tombol cetak net
							case 3:
		echo "<td>
										<form name='form1' method='post' action='report/report.php'>";
										// Proses Nomor Net SP
										$qN 	= "SELECT max(nomorsuratkeluar) AS maxSklr FROM d_suratkeluar WHERE nomorsuratkeluar LIKE 'SP-%' AND YEAR(tglsurat) = '$yearnow'";
										$qNet	= mysql_query($qN);
										$rNet	= mysql_fetch_object($qNet);
										$MaxSklr= explode('-',$rNet->maxSklr);
										$huruf	= $MaxSklr[0];
										$angka	= $MaxSklr[1];
										// Casting to integer
										$nourut	= (int) substr($angka,1,5);
										$nourut++;
										// Nomor surat keluar pengantar SKPP
										$nomorsuratkeluar	= "SP-".sprintf("%05s",$nourut);
										$qKodesuratkeluar	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
										$rKodesuratkeluar	= mysql_fetch_object($qKodesuratkeluar);
										$wpb				= $rKodesuratkeluar->wpb;
										$kp					= $rKodesuratkeluar->kp;
										$yearnow			= substr($rDataSkpp[1],-4);
										$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
										$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
										echo $tujuansurat;
										echo "
										<input type='hidden' name='nosurat' value='$newNoklr' />
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='status' value='$rDataSkpp[11]' />
										<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
										<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
										<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
										<input type='submit' class='normaltablesubmit' name='reportkonsepskpp' value='Tayang' onClick=\"this.form.target='_blank'; return true;\"  />
										</form>
									</td>
									<td>
										<form method='post' action='report/report.php'>
											<input type='hidden' name='username' value='$username' />";
											$qKodesuratkeluar 	= mysql_query("SELECT wpb,kp FROM t_kanwil WHERE aktif='1'");
											$rKodesuratkeluar 	= mysql_fetch_object($qKodesuratkeluar);
											$wpb				= $rKodesuratkeluar->wpb;
											$kp					= $rKodesuratkeluar->kp;
											$yearnow			= substr($rDataSkpp[1],-4);
											// Proses Nomor Net SP
											$qN 	= "SELECT max(nomorsuratkeluar) AS maxSklr FROM d_suratkeluar WHERE nomorsuratkeluar LIKE 'SP-%' AND YEAR(tglsurat) = '$yearnow'";
											$qNet	= mysql_query($qN);
											$rNet	= mysql_fetch_object($qNet);
											$MaxSklr= explode('-',$rNet->maxSklr);
											$huruf	= $MaxSklr[0];
											$angka	= $MaxSklr[1];
											// Casting to integer
											$nourut	= (int) substr($angka,1,5);
											$nourut++;
											// Preparing to insert into SKPP table and suratmasuk table
											// Nomor surat keluar pengantar SKPP
											$nomorsuratkeluar	= "SP-".sprintf("%05s",$nourut);
											$kodesuratkeluar	= "WPB.".$wpb."/KP.".$kp."/".$yearnow;
											// Preparing to update table d_skpp(nospskpp) where noagdskpp
											$nospskpp			= $nomorsuratkeluar."/".$kodesuratkeluar;
											$newNoklr			= "Nomor: ".$nomorsuratkeluar."/".$kodesuratkeluar;
											$tujuansurat		= $rDataSkpp[12];
											// Preparing to update table d_skpp(tgspskpp) where noagdskpp and d_suratkeluar
											$tglsurat			= date('Y-m-d');
											$perihal			= "SKPP a.n. ".$rDataSkpp[2];
											$userpelaksana		= $rDataSkpp[14];
											$Timepelaksana		= new DateTime;
											$timepelaksana		= $Timepelaksana->format('Y-m-d H:i:s');
											$userkasi			= $rDataSkpp[15];
											$timekasi			= $rDataSkpp[16];
											$userpejabat		= $rDataSkpp[17];
											$timepejabat		= $rDataSkpp[18];
											$usertrmsekret		= $rDataSkpp[19];
											$Timetrmsekret		= new DateTime($rDataSkpp[1]);
											$timetrmsekret		= $Timetrmsekret->format('Y-m-d H:i:s');
											$nomorsuratmasuk	= $rDataSkpp[0];
											echo "
											<input type='hidden' name='nomorsuratkeluar' value='$nomorsuratkeluar' />
											<input type='hidden' name='kodesuratkeluar' value='$kodesuratkeluar' />
											<input type='hidden' name='tujuansurat' value='$tujuansurat' />
											<input type='hidden' name='tglsurat' value='$tglsurat' />
											<input type='hidden' name='perihal' value='$perihal' />
											<input type='hidden' name='userpelaksana' value='$userpelaksana' />
											<input type='hidden' name='timepelaksana' value='$timepelaksana' />
											<input type='hidden' name='userkasi' value='$userkasi' />
											<input type='hidden' name='timekasi' value='$timekasi' />
											<input type='hidden' name='userpejabat' value='$userpejabat' />
											<input type='hidden' name='timetrmpejabat' value='$timepejabat' />
											<input type='hidden' name='usertrmsekret' value='$usertrmsekret' />
											<input type='hidden' name='timetrmsekret' value='$timetrmsekret' />
											<input type='hidden' name='nomorsuratmasuk' value='$nomorsuratmasuk' />
											
											<input type='hidden' name='nospskpp' value='$nospskpp' />
											<input type='hidden' name='tgspskpp' value='$tglsurat' />
											<input type='hidden' name='noagenda' value='$nomorsuratmasuk' />
											
											<input type='hidden' name='nosurat' value='$newNoklr' />
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='status' value='$rDataSkpp[11]' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='reportnetskpp' value='Net' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank';return true;\" />
										</form>
									</td>
									<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='editSkpp' value='Edit' />
										</form>
									</td>";
									break;
						// Jika status proses = 2 cetak konsep PD
							case 2:
								echo "<td width='15%' colspan='2'>Cetak konsep</td>
										<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
											<input type='hidden' name='username' value='$username' />
											<input type='hidden' name='kdgpp' value='$rDataSkpp[10]' />
											<input type='hidden' name='kdjenskpp' value='$rDataSkpp[9]' />
											<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
											<input type='submit' class='normaltablesubmit' name='editSkpp' value='Edit' />
										</form>
										</td>";
							break;
						// Jika status proses = 4 cetak net PD
							case 4:
								echo "<td colspan='3'>Cetak net</td>";
								break;
						// Jika status proses = 5 tdtangan net  Kasi PD
							case 5:
								echo "<td colspan='3'>Td.Tgn.Kasi.PD</td>";
								break;
						// Jika status proses = 6 split Sub Bagian Umum
							case 6:
								echo "<td colspan='3'>Split SKPP</td>";
								break;
						// Jika status proses = 7 Loket Pengambilan Sub Bagian Umum
							case 7:
								echo "<td colspan='3'>Loket pengambilan</td>";
								break;
						}
								echo "</tr>";
								$no++;
			}
			echo "</table>
					</div>
					</form>";
		}
		
// Tabel SKPP GPP untuk melakukan pemrosesan SKPP  oleh KEPALA SEKSI PENCAIRAN DANA
// GPP Kepala Seksi Pencairan Dana
elseif($_GET['module']	== "proseskasiskppgpp"){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Proses SKPP oleh Kepala Kantor/Kepala Seksi Pencairan Dana</h1>
					<p>Proses SKPP oleh Kepala Kantor/Kasi. Pencairan Dana meliputi proses paraf konsep SP SKPP dan tanda tangan net SP SKPP</p>
			</form>
			</div>
					<br />
					<br />
					<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' width='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y') AS tgagdtrm,anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y') AS tgagdsls ,date(tgagdsls) AS batasselesai,tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='01' AND statproses!='0' AND  namapengambil is null  ORDER BY statproses,noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_array($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				$idSkpp		= $rDataSkpp['id_skpp'];
				$noagenda	= $rDataSkpp['noagenda'];
				$tgagdtrm	= $rDataSkpp['tgagdtrm'];
				$anskpp	= $rDataSkpp['anskpp'];
				$tgagdsls	= $rDataSkpp['tgagdsls'];
				$batassls	= $rDataSkpp['batasselesai'];
				$tgctkkonsppd 	= $rDataSkpp['tgctkkonseppd'];
				$tgctknetpd		= $rDataSkpp['tgctknetpd'];
				$kdjenskpp		= $rDataSkpp['kdjenskpp'];
				$kdgpp			= $rDataSkpp['kdgpp'];
				$statproses		= $rDataSkpp['statproses'];
				
				
				echo "<tr bgcolor='$color'>
						<td width='35'>$no</td>
						<td>$noagenda</td>
						<td>$tgagdtrm</td>
						<td>$anskpp</td>
						<td>$tgagdsls</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $batassls){
					echo "<td>$tgagdsls</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$tgagdsls</b></font></td>";
						}
						
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						switch($statproses){
							// Jika status proses = 2 cetak konsep PD => paraf konsep SP SKPP
							case 2:
								echo "<td>
										<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='parafskpp' value='Paraf' onClick=\"setTimeout('location.reload(true);',1000); return true;\" />
										</form>
										</td>";
										break;
						// Jika status proses = 4 cetak net PD => tanda tangan net SP SKPP
							case 4:
								echo "<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='tandatanganskpp' value='T.Tangan' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank'; return true;\" />
										</form>
										</td>";
										break;
							case  1:
								echo "<td colspan='2'>Terima di Loket Umum</td>";
										break;
							case  3:
								echo "<td colspan='2'>Paraf KK/Kasi. PD</td>";
										break;			
							case  5:
									echo "<td colspan='2'>TdTgn.KK/Kasi. PD</td>";
										break;	
							case  6:
								echo "<td colspan='2'>Split SKPP</td>";
								break;
						}
						echo "</tr>";
						$no++;
						
			}
			echo "</table>
					</div>
					</form>";
		}
		
// Tabel SKPP Non GPP untuk melakukan pemrosesan SKPP  oleh KEPALA KANTOR
// Non GPP diproses langsung ke Kepala Kantor
elseif($_GET['module']	== "proseskasiskppnongpp"){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Proses SKPP oleh Kepala Seksi Pencairan Dana</h1>
					<p>Proses SKPP oleh Kasi. Pencairan Dana meliputi proses paraf konsep SP SKPP dan tanda tangan net SP SKPP</p>
					</form>
					</div>
					<br />
					<br />
					<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y') AS tgagdtrm,anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y') AS tgagdsls ,date(tgagdsls) AS batasselesai,tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='00' AND statproses!='0' AND  namapengambil  is null  ORDER BY statproses,noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_array($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				$idSkpp		= $rDataSkpp['id_skpp'];
				$noagenda	= $rDataSkpp['noagenda'];
				$tgagdtrm	= $rDataSkpp['tgagdtrm'];
				$anskpp	= $rDataSkpp['anskpp'];
				$tgagdsls	= $rDataSkpp['tgagdsls'];
				$batassls	= $rDataSkpp['batasselesai'];
				$tgctkkonsppd 	= $rDataSkpp['tgctkkonseppd'];
				$tgctknetpd		= $rDataSkpp['tgctknetpd'];
				$kdjenskpp		= $rDataSkpp['kdjenskpp'];
				$kdgpp			= $rDataSkpp['kdgpp'];
				$statproses		= $rDataSkpp['statproses'];
				
				
				echo "<tr bgcolor='$color'>
						<td height='35'>$no</td>
						<td>$noagenda</td>
						<td>$tgagdtrm</td>
						<td>$anskpp</td>
						<td>$tgagdsls</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $batassls){
					echo "<td>$tgagdsls</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$tgagdsls</b></font></td>";
						}
						
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						switch($statproses){
							// Jika status proses = 2 cetak konsep PD => paraf konsep SP SKPP
							case 2:
								echo "<td>
										<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='parafskpp' value='Paraf' onClick=\"setTimeout('location.reload(true);',1000); return true;\" />
										</form>
										</td>";
										break;
						// Jika status proses = 4 cetak net PD => tanda tangan net SP SKPP
							case 4:
								echo "<td>
										<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='tandatanganskpp' value='T.Tangan' onClick=\"setTimeout('location.reload(true);',1000); this.form.target='_blank'; return true;\" />
										</form>
										</td>";
										break;
						// Jika status proses = 1 terima loket umum
							case  1:
								echo "<td colspan='2'>Terima di Loket Umum</td>";
								break;
							case  3:
								echo "<td colspan='2'>Paraf KK/Kasi. PD</td>";
								break;			
							case  5:
								echo "<td colspan='2'>Td.Tgn.KK/Kasi. PD</td>";
								break;				
							case  6:
								echo "<td colspan='2'>Split SKPP</td>";
								break;
						}
						echo "</tr>";
						$no++;
						
			}
			echo "</table>
					</div>
					</form>";
		}
		
// Tabel SKPP GPP untuk menunjukkan proses splitting SKPP  oleh Sub Bagian Umum
// GPP Pelaksana Sub Bagian Umum
elseif($_GET['module']	== "prosessplitskppgpp"){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Splitting SKPP oleh Pelaksana Sub Bagian Umum</h1>
					<p>Splitting SKPP oleh pelaksana sub bagian umum</p>
					</form>
					</div>
					<br />
					<br />
					<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y') AS tgagdtrm,anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y') AS tgagdsls ,date(tgagdsls) AS batasselesai,tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='01' AND statproses!='0' AND  namapengambil is null  ORDER BY noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_array($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				$idSkpp		= $rDataSkpp['id_skpp'];
				$noagenda	= $rDataSkpp['noagenda'];
				$tgagdtrm	= $rDataSkpp['tgagdtrm'];
				$anskpp	= $rDataSkpp['anskpp'];
				$tgagdsls	= $rDataSkpp['tgagdsls'];
				$batassls	= $rDataSkpp['batasselesai'];
				$tgctkkonsppd 	= $rDataSkpp['tgctkkonseppd'];
				$tgctknetpd		= $rDataSkpp['tgctknetpd'];
				$kdjenskpp		= $rDataSkpp['kdjenskpp'];
				$kdgpp			= $rDataSkpp['kdgpp'];
				$statproses		= $rDataSkpp['statproses'];
				
				
				echo "<tr bgcolor='$color'>
						<td height='35'>$no</td>
						<td>$noagenda</td>
						<td>$tgagdtrm</td>
						<td>$anskpp</td>
						<td>$tgagdsls</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $batassls){
					echo "<td>$tgagdsls</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$tgagdsls</b></font></td>";
						}
						
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						switch($statproses){
							// Jika status proses = 5 tandatangan net Kasi PD => split SP SKPP
							case 5:
								echo "<td>
										<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='splitskpp' value='Split' onClick=\"setTimeout('location.reload(true);',1000); return true;\" />
										</form>
										</td>";
										break;
						// Jika status proses = 6 split umum => loket pengambilan SP SKPP
							case 6:
								echo "<td>
										<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='anskpp' value='$anskpp' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='pengambilanskpp' value='Ambil' onClick=\"setTimeout('location.reload(true);',1000); return true;\" />
										</form>
										</td>";
								break;
							case  1:
								echo "<td>Terima di Loket Umum</td>";
								break;
							case 2:
								echo "<td>Cetak Konsep</td>";
								break;
							// Status paraf KK atau Kasi
							case 3:
								echo "<td>Paraf KK/Kasi.PD</td>";
								break;
							// Status cetak net SP SKPP
							case 4:
								echo "<td>Cetak Net</td>";
								break;
							// Status tanda tangan KK atau Kasi
							case 5:
								echo "<td>Td.Tgn KK/Kasi.PD</td>";
								break;
						}
						echo "</tr>";
						$no++;
						
			}
			echo "</table>
					</div>
					</form>";
		}
		
// Tabel SKPP Non GPP untuk menunjukkan proses splitting SKPP  oleh Sub Bagian Umum
// Non GPP Pelaksana Sub Bagian Umum
elseif($_GET['module']	== "prosessplitskppnongpp"){
	$username	= $_SESSION[namauser];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Splitting SKPP oleh Pelaksana Sub Bagian Umum</h1>
					<p>Splitting SKPP oleh Pelaksana Sub Bagian Umum</p>
					</form>
					</div>
					<br />
					<br />
					<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='10%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='15%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y') AS tgagdtrm,anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y') AS tgagdsls ,date(tgagdsls) AS batasselesai,tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='00' AND statproses!='0' AND  namapengambil is null  ORDER BY noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_array($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				$idSkpp		= $rDataSkpp['id_skpp'];
				$noagenda	= $rDataSkpp['noagenda'];
				$tgagdtrm	= $rDataSkpp['tgagdtrm'];
				$anskpp	= $rDataSkpp['anskpp'];
				$tgagdsls	= $rDataSkpp['tgagdsls'];
				$batassls	= $rDataSkpp['batasselesai'];
				$tgctkkonsppd 	= $rDataSkpp['tgctkkonseppd'];
				$tgctknetpd		= $rDataSkpp['tgctknetpd'];
				$kdjenskpp		= $rDataSkpp['kdjenskpp'];
				$kdgpp			= $rDataSkpp['kdgpp'];
				$statproses		= $rDataSkpp['statproses'];
				
				
				echo "<tr bgcolor='$color'>
						<td height='35'>$no</td>
						<td>$noagenda</td>
						<td>$tgagdtrm</td>
						<td>$anskpp</td>
						<td>$tgagdsls</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $batassls){
					echo "<td>$tgagdsls</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$tgagdsls</b></font></td>";
						}
						
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						switch($statproses){
							// Jika status proses = 5 tandatangan net Kasi PD => split SP SKPP
							case 5:
								echo "<td>
										<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='splitskpp' value='Split' onClick=\"setTimeout('location.reload(true);',1000); return true;\" />
										</form>
										</td>";
										break;
						// Jika status proses = 6 split umum => loket pengambilan SP SKPP
							case 6:
								echo "<td>
										<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='username' value='$username' />
										<input type='hidden' name='anskpp' value='$anskpp' />
										<input type='hidden' name='kdgpp' value='$kdgpp' />
										<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
										<input type='hidden' name='idSkpp' value='$idSkpp' />
										<input type='submit' class='normaltablesubmit' name='pengambilanskpp' value='Ambil' onClick=\"setTimeout('location.reload(true);',1000); return true;\" />
										</form>
										</td>";
										break;
							case  1:
								echo "<td>Terima di Loket Umum</td>";
								break;
							case 2:
								echo "<td>Cetak Konsep</td>";
								break;
							// Status paraf KK atau Kasi
							case 3:
								echo "<td>Paraf KK/Kasi PD</td>";
								break;
							// Status cetak net SP SKPP
							case 4:
								echo "<td>Cetak Net</td>";
								break;
							// Status tanda tangan KK atau Kasi
							case 5:
								echo "<td>Td.Tgn.KK/Kasi.PD</td>";
								break;
						}
						echo "</tr>";
						$no++;
						
			}
			echo "</table>
					</div>
					</form>";
		}
		
/*------------------------------------------------
 * Update status proses berkaitan dengan tombol
 *----------------------------------------------*/
 
// Paraf SP SKPP oleh Kepala Seksi Pencairan Dana 
elseif($_POST['parafskpp'] == "Paraf"){
	$username	= $_POST['username'];
	$idSkpp		= $_POST['idSkpp'];
	$dateParaf	= date("Y-m-d H:i:s");
	mysql_query("UPDATE d_skpp SET userparafkasipd='$username', tgparafkasipd='$dateParaf', statproses='3' WHERE id_skpp='$idSkpp'");
}

//  Tanda tangan SP SKPP oleh Kepala Seksi Pencairan Dana 
elseif($_POST['tandatanganskpp'] ){
	$username	= $_POST['username'];
	$idSkpp		= $_POST['idSkpp'];
	$timezone 	= "Asia/Jakarta";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$dateTdtangan	= date("Y-m-d H:i:s");
	mysql_query("UPDATE d_skpp SET usertdtgnkasipd='$username', tgtdtgnkasipd='$dateTdtangan', statproses='5' WHERE id_skpp='$idSkpp'");
}

//  Split SKPP oleh Pelaksana Sub Bagian Umum
elseif($_POST['splitskpp'] == "Split" ){
	$username	= $_POST['username'];
	$idSkpp		= $_POST['idSkpp'];
	$timezone 	= "Asia/Jakarta";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$dateSplitum	= date("Y-m-d H:i:s");
	mysql_query("UPDATE d_skpp SET usersplitum='$username', tgsplitum='$dateSplitum', statproses='6' WHERE id_skpp='$idSkpp'");
}
//  Pengambilan SKPP melalui loket Sub Bagian Umum
elseif($_POST['pengambilanskpp'] == "Ambil"){
		$username 	= $_POST['username'];
		$anskpp		= $_POST['anskpp'];
		$kdgpp		= $_POST['kdgpp'];
		$kdjenskpp	= $_POST['kdjenskpp'];
		$idSkpp		= $_POST['idSkpp'];
		echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#promptkonfirmasi').dialog({
						modal: true
					});
				});
				</script>
		<div id='promptkonfirmasi' title='Entri Data Pengambil SKPP'>
				<form name='form1' method='post' action='reporttandapengambilanskpp.php'>
				<center>Nama Pengambil SKPP <b><input type='text' name='namapengambil' maxlength='30' /></b></center>
				<br />
				<br />
				<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
				<input type='hidden' name='anskpp' value='$anskpp' />
				<input type='hidden' name='kdgpp' value='$kdgpp' />
				<input type='hidden' name='username' value='$username' />
				<input type='hidden' name='idSkpp' value='$idSkpp' />
				<td><input type='submit' name='konfirmasirekamskpp' value='Cetak' onClick=\"this.form.target='_blank'; return true;\"  /></td></tr>
			</form>
		</table>
		</div>";
}

/*-----------------------------------------
 * Editing SKPP
 * --------------------------------------*/
 
// Edit SKPP
elseif($_POST['editSkpp'] == "Edit"){
	echo "<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
			</script>";
	
	$username	= $_POST['username'];
	$idSkpp		= $_POST['idSkpp'];
	$kdjenskpp	= $_POST['kdjenskpp'];
	$kdgpp		= $_POST['kdgpp'];
	$qEditskpp	= mysql_query("SELECT id_skpp,noagenda,date_format(tgagdtrm,'%d/%m/%Y') as agdtrm,date_format(tgagdsls,'%d/%m/%Y') as agdsls,staskpp,kdjenskpp,kdgpp,noskpp,date_format(tgskpp,'%d/%m/%Y') as tgskpp,anskpp,nip,pangkat,kdsatker,kotatujuan,kotaasal,alamat,satkerbaru,tujuanskpp FROM d_skpp WHERE id_skpp='$idSkpp'")or die(mysql_error);
	$rEdit		= mysql_fetch_array($qEditskpp);
	$noagenda	= $rEdit['noagenda'];
	$tgagdtrm	= $rEdit['agdtrm'];
	$tgagdsls	= $rEdit['agdsls'];
	$staskpp	= $rEdit['staskpp'];
	$noskpp	= $rEdit['noskpp'];
	$tgskpp		= $rEdit['tgskpp'];
	$anskpp	= $rEdit['anskpp'];
	$nip		= $rEdit['nip'];
	$pangkat	= $rEdit['pangkat'];
	$kdsatker	= $rEdit['kdsatker'];
	$kotatujuan	= $rEdit['kotatujuan'];
	$kotaasal	= $rEdit['kotaasal'];
	$alamat		= $rEdit['alamat'];
	$satkerbaru	= $rEdit['satkerbaru'];
	$tujuanskpp= $rEdit['tujuanskpp'];
	
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman data SKPP</h1>
			<p><b>Step 1</b> - Data SKPP ini akan digunakan dalam proses penerbitan Surat Pengantar SKPP</p>
			<label>Nomor Agenda
			<span class='small'>Nomor agenda</span>
			</label>
					
						<input type='text' id='noagenda' class='required' minlength='3' name='noagenda' value='$noagenda' maxlength='10' value='$newAgd' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'staskpp')\" />
	
						<label>Status SKPP
						<span class='small'>Isikan status SKPP</span>
						</label>
						<input type='text' name='staskpp' id='staskpp' value='$staskpp -"; switch($staskpp){
									case '01':
										echo " PNS";
										break;
									case '02':
										echo " TNI";
										break;
									case '03':
										echo "POLRI";
										break;
								}		
						echo "'readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'kdjenskpp')\" >
																
						
						<label>Jenis SKPP
						<span class='small'>Isikan jenis SKPP</span>
						</label>
						<input type='text' name='kdjenskpp' id='staskpp' value='$kdjenskpp -"; switch($kdjenskpp){
									case '01':
										echo " Pindah";
										break;
									case '02':
										echo " Pensiun";
										break;
								}		
								echo "'readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'kdgpp')\" >
						
					
						<label>Kode GPP
						<span class='small'>Pilih kode GPP</span>
						</label>
						<input type='text' name='kdgpp' id='kdgpp' value='$kdgpp -"; switch($kdgpp){
										case '00':
										echo " Non GPP";
										break;
										case '01':
										echo " GPP";
										break;
										}		
										echo "'readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'noskpp')\" >
						
					
						<label>Nomor SKPP
						<span class='small'>Isikan nomor SKPP</span>
						</label>
						<input type='text' id='noskpp' name='noskpp' value='$noskpp' class='required' minlength='1' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tanggal')\" />
					
						<label>Tanggal SKPP
						<span class='small'>Isikan tanggal SKPP</span>
						</label>
						<input type='text' id='tanggal' name='tgskpp' value='$tgskpp' class= 'required' minlength='1' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
					
						<label>Kode Satker
						<span class='small'>Isikan kode satker</span>
						</label>
						<input type='text' id='kdsatker' name='kdsatker' value='$kdsatker' class='required' minlength='6' maxlength='6' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'anskpp')\" />
					
						<label>Nama Pegawai
						<span class='small'>Isikan nama pegawai/janda/duda</span>
						</label>
						<input type='text' id='anskpp' name='anskpp' value='$anskpp' class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nip')\" />
					
						<label>NIP/NRP
						<span class='small'>Isikan NIP/NRP pegawai</span>
						</label>
						<input type='text' id='nip' name='nip'  value='$nip' class='required' minlength='2' maxlength='18' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'pangkat')\" />
					
						<label>Pangkat/Golongan
						<span class='small'>Isikan pangkat pegawai</span>
						</label>";
						$qPangkat	= mysql_query("SELECT kdgol,nmgol1,nmgol2 FROM t_golongan")or die(mysql_error);
						echo "<select name='pangkat' id='pangkat' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'alamat')\">";
						while($rPangkat	= mysql_fetch_array($qPangkat)){
						$kdgol		= $rPangkat['kdgol'];
						$nmgol1	= $rPangkat['nmgol1'];
						$nmgol2	= $rPangkat['nmgol2'];
							if($pangkat == $kdgol){
								echo "<option value='$kdgol' selected='selected'>$nmgol1&nbsp;&nbsp;&nbsp;$nmgol2</option>";
							}
							else{
								echo "<option value='$kdgol'>$nmgol1&nbsp;&nbsp;&nbsp;$nmgol2</option>";
							}
						}
						
						echo "</select>
							
						<label>Alamat
						<span class='small'>Isikan alamat pegawai/janda/duda</span>
						</label>
						<input type='text' id='alamat' name='alamat'  value='$alamat' class='required' minlength='2' maxlength='45' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tgagdtrm')\" />
						
						<label>Tanggal terima SKPP
						<span class='small'>Isikan tanggal penerimaan SKPP</span>
						</label>
						<input type='text' id='tgagdtrm' name='tgagdtrm'  value='$tgagdtrm' readonly='readonly' class= 'required' minlength='1' maxlength='10'   onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tgagdsls')\" />
						
						<label>Tanggal selesai SKPP
						<span class='small'>Isikan tanggal penyelesaian SKPP</span>
						</label>
						<input type='text' id='tgagdsls' name='tgagdsls'  value='$tgagdsls' readonly='readonly' class= 'required' minlength='1' maxlength='10'   onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kotaasal')\" />
					
						<label>Kota Satker Asal
						<span class='small'>Isikan kota satker asal</span>
						</label>
						<input type='text' id='kotaasal' name='kotaasal'  value='$kotaasal' class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kotatujuan')\" />
								
						<label>Kota Tujuan SKPP
						<span class='small'>Isikan kota tujuan SKPP</span>
						</label>
						<input type='text' id='kotatujuan' name='kotatujuan' value='$kotatujuan' class='required' minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'satkerbaru')\" />";
				
						// Jika kdjenskpp = SKPP Pindah
						if($kdjenskpp == "01"){
							
							echo "<label>Nama satker baru/tujuan
									<span class='small'>Isikan nama satker baru/tujuan</span>
									</label>
									<input type='text' id='satkerbaru' name='satkerbaru'  value='$satkerbaru' class='required' minlength='2' maxlength='60' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tujuanskpp')\" />		
							
									<label>KPPN Tujuan SKPP
									<span class='small'>Isikan KPPN tujuan SKPP</span>
									</label>
									<input type='text' id='tujuanskpp' name='tujuanskpp' value='$tujuanskpp' class='required' minlength='2' maxlength='60' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />";
											
						}
						
						echo "<input type='hidden' name='idSkpp' value='$idSkpp' />
								<input type='hidden' name='noagenda' value='$noagenda' />
								<input type='hidden' name='kdjenskpp' value='$kdjenskpp' />
								<input type='hidden' name='kdgpp' value='$kdgpp' />
								<input type='hidden' name='staskpp' value='$staskpp' />
								<input type='hidden' name='tgagdtrm' value='$tgagdtrm' />
								<input type='hidden' name='tgagdsls' value='$tgagdsls' />
								<input type='submit' value='Simpan' class='button' id='submit' name='Editdataskpp' />
						<div class='spacer'></div>
						
						</form>
						</div>";
}

// Simpan data edit SKPP
elseif($_POST['Editdataskpp'] == "Simpan"){
	$idSkpp		= $_POST['idSkpp'];
	$noagenda	= $_POST['noagenda'];
	// data SKPP yang diijinkan dilakukan perubahan
	$noskpp	= $_POST['noskpp'];
	$Tgskpp	= explode("/",$_POST['tgskpp']);
	$thn		= $Tgskpp[2];
	$bln		= $Tgskpp[1];
	$tgl			= $Tgskpp[0];
	$tgskpp		= $thn.'-'.$bln.'-'.$tgl;
	$kdsatker	= $_POST['kdsatker'];
	$anskpp	= $_POST['anskpp'];
	$nip		= $_POST['nip'];
	$pangkat	= $_POST['pangkat'];
	$alamat		= $_POST['alamat'];
	$kotaasal	= $_POST['kotaasal'];
	$kotatujuan= $_POST['kotatujuan'];
	$satkerbaru= $_POST['satkerbaru'];
	$tujuanskpp=$_POST['tujuanskpp'];
	$qCeksatker	= mysql_query("SELECT kdsatker FROM t_satker WHERE kdsatker='$kdsatker'")or die(mysql_error);
	$rCek		= mysql_fetch_row($qCeksatker);
	if($rCek[0] == 0){
		echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#promptkonfirmasi').dialog({
						modal: true
					});
				});
			</script>
				<div id='promptkonfirmasi' title='Konfirmasi Edit Data SKPP'>
				<center><b>Kode satker $kdsatker tidak ada dalam referensi</b></center>
				<br />
				<br />
				<table border='0' align='center'>
				<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasieditskpp' value='Kembali'  /></td>
				</form>";
	}
	else{
	mysql_query("UPDATE d_skpp SET noskpp='$noskpp', tgskpp='$tgskpp', kdsatker='$kdsatker', anskpp='$anskpp', nip='$nip', pangkat='$pangkat', alamat='$alamat', kotaasal='$kotaasal', kotatujuan='$kotatujuan', satkerbaru='$satkerbaru', tujuanskpp='$tujuanskpp' WHERE id_skpp='$idSkpp' AND noagenda='$noagenda'");
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
				modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Edit Data SKPP'>
			<center><b>Data SKPP a.n. $anskpp dengan no. SKPP $noskpp berhasil diubah</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<tr><td><input type='submit' name='konfirmasieditskpp' value='Kembali'  /></td>
			</form>";
	}
}

/* --------------------------
 * Pengembalian SKPP GPP
 * ------------------------*/
	
elseif($_GET['module'] == "pengembalianskppgpp"){
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form pengembalian SKPP GPP</h1>
			<p>Form ini digunakan dalam proses pengembalian SKPP GPP</p>
			</form>
		</div>
			<br />
			<br />
			<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='7%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='20%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='10%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y'),anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y'),date(tgagdsls),tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='01' AND statproses!='0' AND statproses<'5' AND namapengambil is null  ORDER BY statproses, noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_row($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSkpp[0]</td>
						<td>$rDataSkpp[1]</td>
						<td>$rDataSkpp[2]</td>
						<td>$rDataSkpp[3]</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $rDataSkpp[5]){
							echo "<td>$rDataSkpp[4]</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$rDataSkpp[4]</b></font></td>";
						}
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						
						echo "<td>
								<form name='pengembalianskpp' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
								<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
								<input type='submit' class='normaltablesubmit' name='pengembalianskpp' value='Kembalikan' onClick=\"setTimeout('location.reload(true);',1000);  return true;\" />
								</form>
							</td>
						</tr>";
						$no++;
			}
			echo "</table>			
			</form>
		</div>";
}

/* --------------------------------
 * Pengembalian SKPP Non GPP
 * ------------------------------*/

elseif($_GET['module'] == "pengembalianskppnongpp"){
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form pengembalian SKPP GPP</h1>
					<p>Form ini digunakan dalam proses pengembalian SKPP Non GPP</p>
					</form>
					</div>
					<br />
					<br />
					<div id='normaltable'>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='7%' height='35'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='20%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='10%' colspan='3'>Tindakan</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(date(tgagdtrm),'%d-%m-%Y'),anskpp,noskpp,date_format(date(tgagdsls),'%d-%m-%Y'),date(tgagdsls),tgctkkonseppd,tgctknetpd,id_skpp,kdjenskpp,kdgpp,statproses FROM d_skpp WHERE kdgpp='00' AND statproses!='0' AND statproses<'5' AND namapengambil is null  ORDER BY statproses, noagenda DESC,tgagdtrm,tgagdsls")or die(mysql_error);
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_row($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				echo "<tr bgcolor='$color'>
						<td height='45'>$no</td>
						<td>$rDataSkpp[0]</td>
						<td>$rDataSkpp[1]</td>
						<td>$rDataSkpp[2]</td>
						<td>$rDataSkpp[3]</td>";
				// Apabila tanggal penyelesaian dilewati, background color berubah warna merah
						if(date('Y-m-d') <= $rDataSkpp[5]){
					echo "<td>$rDataSkpp[4]</td>";
						}
						else{
							echo "<td bgcolor='#FF0000'><font color='#FFFF00'><b>$rDataSkpp[4]</b></font></td>";
						}
				// Kondisi tombol yang dimunculkan berkaitan dengan status pencetakan	
						
						echo "<td>
						<form name='pengembalianskpp' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
						<input type='hidden' name='idSkpp' value='$rDataSkpp[8]' />
								<input type='submit' class='normaltablesubmit' name='pengembalianskpp' value='Kembalikan' onClick=\"setTimeout('location.reload(true);',1000);  return true;\" />
								</form>
								</td>
								</tr>";
						$no++;
			}
			echo "</table>			
					</form>
					</div>";
}

/* --------------------------------------------------------
 * Form pengisian alasan pengembalian SKPP  GPP & Non GPP
 * ------------------------------------------------------*/

elseif($_POST['pengembalianskpp'] == "Kembalikan"){
		$idSkpp		= $_POST['idSkpp'];
		$qData		= mysql_query("SELECT noagenda,noskpp,date_format(tgskpp,'%d-%m-%Y') as tgskpp,anskpp FROM d_skpp WHERE id_skpp='$idSkpp'")or die(mysql_error);
		$rData		= mysql_fetch_object($qData);
			echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form pengembalian SKPP</h1>
			<p>Data SKPP ini akan digunakan dalam proses pengembalian SKPP</p>
					
			<br />
			<br />
			<label>Nomor Agenda
			<span class='small'>Nomor agenda</span>
			</label>
			<input type='text' id='noagenda' class='required' minlength='3' name='noagenda' maxlength='10' value='$rData->noagenda' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'staskpp')\" />
	
			<label>Nomor SKPP
			<span class='small'>Isikan nomor SKPP</span>
			</label>
			<input type='text' id='noskpp' name='noskpp'  class='required' minlength='1' maxlength='30' value='$rData->noskpp' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tanggal')\" />
					
			<label>Tanggal SKPP
			<span class='small'>Isikan tanggal SKPP</span>
			</label>
			<input type='text' id='tanggal' name='tgskpp'  class= 'required' minlength='1' maxlength='10' value='$rData->tgskpp' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
					
			<label>Nama Pegawai
			<span class='small'>Isikan nama pegawai/janda/duda</span>
			</label>
			<input type='text' id='anskpp' name='anskpp'  class='required' minlength='2' maxlength='30' value='$rData->anskpp' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
			<label>Alasan Pengembalian
			<span class='small'>Isikan alasan pengembalian</span>
			</label>
			<textarea name='alasanpengembalian' rows='8' cols='20'></textarea>
					
			<input type='submit' value='Simpan' class='button' id='submit' name='pengembalianskpp' />
			<div class='spacer'></div>
		</form>
		</div>";
		
}


		
/* ------------------------------------------------- 
 * Eksekusi pengembalian SKPP  GPP & Non GPP
 * -----------------------------------------------*/

elseif($_POST['pengembalianskpp'] == "Simpan"){
	$noagenda	= $_POST['noagenda'];
	$noskpp	= $_POST['noskpp'];
	$alasan		= $_POST['alasanpengembalian'];
	$username	= $_SESSION[namauser];
	$today		= date("Y-m-d H:i:s");
	mysql_query("UPDATE d_skpp SET userpengembalian='$username', tgpengembalian='$today', alasanpengembalian='$alasan', statproses='0' WHERE noagenda='$noagenda' AND noskpp='$noskpp'");
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
				modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Pengembalian Data SKPP'>
			<center><b>Data SKPP No. $noskpp telah dikembalikan dengan alasan $alasan</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='kembalikanskpp' value='Kembali'  /></td>
			</form>";
}



/* ------------------------------------
 * Monitoring SKPP
 * ----------------------------------*/

elseif($_GET['module']	== "monitoringskpp"){
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Monitoring SKPP</h1>
					<p>Monitoring SKPP </p>
					</div>
					<br />
					<br />
					<div id='normaltable'>
					</form>
					<table class='normaltable' width='100%'>
					<tr>
					<th width='6%'height='40'>No.</th>
					<th width='15%'>No. Agenda</th>
					<th width='15%'>Tgl. Diterima</th>
					<th width='15%'>Nama</th>
					<th width='15%'>No. SKPP</th>
					<th width='15%'>Batas Selesai</th>
					<th width='19%' colspan='3'>Proses</th>
					</tr>";
			
			$qDataSkpp		= mysql_query("SELECT noagenda,date_format(tgagdtrm,'%d-%m-%Y') as tgagdtrm,anskpp,noskpp,date_format(tgagdsls,'%d-%m-%Y') as tgagdsls,statproses FROM d_skpp WHERE statproses<'8' ORDER BY statproses, noagenda");
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSkpp	= mysql_fetch_row($qDataSkpp)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				
				echo "<script type='text/javascript'>
						setTimeout('location.reload(true);',60000);
				</script>
				<tr bgcolor='$color'>
						<td height='40'>$no</td>
						<td>$rDataSkpp[0]</td>	
						<td>$rDataSkpp[1]</td>
						<td>$rDataSkpp[2]</td>
						<td>$rDataSkpp[3]</td>";
						// Jika terlambat beri background merah
						if(date("d-m-Y") > $rDataSkpp[4]){
							echo "<td bgcolor='#FF0000'><font color='#FFFF54'><b>$rDataSkpp[4]</b></font></td>";
						}
						// Tidak terlambat
						else{
							echo "<td>$rDataSkpp[4]</td>";
						}
						// Indikator Status SKPP
						switch($rDataSkpp[5]){
							// Status dikembalikan
							case 0:
								echo "<td bgcolor='000000'><font color='FF0066'><b>Dikembalikan</b></font></td>";
								break;
							// Status terima loket umum
							case 1:
								echo "<td bgcolor='000000'><font color='FF0000'><b>Terima di Loket Umum</b></font></td>";
								break;
							// Status konsep SP SKPP
							case 2:
								echo "<td bgcolor='000000'><font color='FF9900'><b>Cetak Konsep</b></font></td>";
								break;
							// Status paraf KK atau Kasi
							case 3:
								echo "<td bgcolor='000000'><font color='FF3300'><b>Konsep diparaf KK/Kasi.PD</b></font></td>";
								break;
							// Status cetak net SP SKPP
							case 4:
								echo "<td bgcolor='000000'><font color='CCFFCC'><b>Cetak Net</b></font></td>";
								break;
							// Status tanda tangan KK atau Kasi
							case 5:
								echo "<td bgcolor='000000'><font color='99FFCC'><b>Net ditandatangani KK/Kasi PD</b></font></td>";
								break;
						  	// Split umum
							case 6:
								echo "<td bgcolor='000000'><font color='66FFFF'><b>Split SKPP</b></font></td>";
								break;
							// 
							case 7:
								echo "<td bgcolor='000000'><font color='00FF00'><b>Loket Pengambilan</b></font></td>";
								break;
						}					
						echo "</tr>";
				$no++;
			}
			echo "</table>
					</div>
					</form>";

}
?>
