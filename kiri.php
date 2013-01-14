<?php
$PhpEncoder = new CPhpEncoder();
?>
<?php

// Halaman utama (Home)
if ($_GET['module']=='home'){
	
}

// Modul Rekam Nomor Arsip ==================================================================================//
elseif($_GET['module']=='rekamnoarsip'){
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Data alokasi nomor arsip</h1>
			<p>Data nomor arsip ini akan digunakan dalam perekaman dokumen arsip</p>
			</div>
			
			<br />
			<br />
				<input type='submit' class='normaltablesubmit' name='btnEarsip' value='Tambah' />
			</form>
			<div id='normaltable'>
			<table class='normaltable' width='100%'>
			<tr>
					<th width='10%'>No.</th>
					<th width='20%'>Kode BA</th>
					<th width='20%'>Nomor Rak</th>
					<th width='20%'>Nomor Baris</th>
					<th width='20%'>Nomor Box</th>
					<th width='20%' colspan='2'>Tindakan</th>
			</tr>";
			
			$q_refArsip			= mysql_query("SELECT * FROM r_nomorarsipsp2d ORDER BY kddept,norak,nobaris,nobox");
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($r_refArsip	= mysql_fetch_row($q_refArsip)){
			if($no % 2 == 0) {$color = $evencol;}
			else{$color = $oddcol;}
			echo "<tr bgcolor='$color'>
					<td>$no</td>
					<td>$r_refArsip[1]</td>
					<td>$r_refArsip[2]</td>
					<td>$r_refArsip[3]</td>
					<td>$r_refArsip[4]</td>
					<td>
						<form id='frm_rarsip' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
						<input type='hidden' name='id' value='$r_refArsip[0]' />
						<input type='submit' name='btnEarsip' value='Edit' class='normaltablesubmit' />
						</form>
					</td>
					<td>
						<form id='frm_rarsip' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
						<input type='hidden' name='id' value='$r_refArsip[0]' />
						<input type='submit' name='btnHarsip' value='Hapus' class='normaltablesubmit' />
						</form>
					</td>
				</tr>";
				$no++;
			}
			echo "</table>
			</div>";
}
// Modul Form Perekaman Referensi Arsip -----------------------------------------------------------------------------------------------------------------------------//
elseif($_POST['btnEarsip']){	
		$id		= $_POST['id'];
		$query	= "SELECT id_nomorarsip, kddept, norak, nobaris,nobox FROM r_nomorarsipsp2d WHERE id_nomorarsip = '$id'";
		$qArsip	= mysql_query($query);
		$rArsip	= mysql_fetch_object($qArsip);
		$Nobox	= substr($rArsip->nobox, 3, 3);
		
		echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
			</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
			});
  			</script>
			<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman alokasi nomor arsip</h1>
			<p>Alokasi nomor arsip ini akan digunakan dalam perekaman dokumen arsip</p>
					<label>Kode Dept
					<span class='small'>Isikan kode dept</span>
					</label>
					<input type='text' value='".$rArsip->kddept."' id='kddept' class='required' minlength='3' name='kddept' maxlength='3' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'norak')\" />
	
					<label>Nomor Rak
					<span class='small'>Isikan nomor alokasi rak</span>
					</label>
					<input type='text' value='".$rArsip->norak."' id='norak' name='norak' class='required' minlength='1' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobaris')\" />
					
					<label>Nomor Baris
					<span class='small'>Isikan nomor alokasi baris</span>
					</label>
					<input type='text' value='".$rArsip->nobaris."' id='nobaris' name='nobaris'  class='required' minlength='1' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobox')\" />
					
					<label>Nomor Box
					<span class='small'>Isikan alokasi nomor box</span>
					</label>
					<input type='text' id='nobox' value='".$Nobox."' name='nobox'  class='required' minlength='1' maxlength='6' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='hidden' name='id' value='".$rArsip->id_nomorarsip."' />
					<input type='submit' value='Simpan' class='button' id='submit' name='btnUarsip' />
					<div class='spacer'></div>
			</form>
		</div>";
}

// Modul Insert Nomor Arsip ---------------------------------------------------------------------------------------------------------------------------------------------------------------------/
elseif($_POST['btnUarsip'] == 'Simpan'){
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	$id		= $_POST['id'];
	$kddept	= $_POST['kddept'];
	$noRak	= $_POST['norak'];
	$norak	= sprintf("%04s",$noRak);
	$noBaris	= $_POST['nobaris'];
	$nobaris	= sprintf("%04s",$noBaris);
	$noBox	= $_POST['nobox'];
	$Nobox	= sprintf("%03s",$noBox);
	$nobox	= $kddept.$Nobox;
	
	if($id == '')
	{
		$query = "SELECT id_nomorarsip, kddept, norak, nobaris, nobox FROM r_nomorarsipsp2d WHERE kddept='$kddept' AND norak='$norak' AND nobaris='$nobaris' AND nobox='$nobox'";
		
		$qCek	= mysql_query($query);
		$rCek	= mysql_num_rows($qCek);
		
		if(!$rCek){
			$query 		= "REPLACE r_nomorarsipsp2d SET kddept='$kddept', norak='$norak', nobaris='$nobaris', nobox='$nobox'";
			$qArsip= mysql_query($query);
		}else{
			echo "
			<div id='promptkonfirmasi' title='informasi'>
				<br />
				<center>
				<b><font color='#FFFFFF' size='4'>Data tersebut sudah ada</font></b>
				<br />
				<br />
			</div>";
		}
		
	}else{
		$query		= "UPDATE r_nomorarsipsp2d SET kddept='$kddept', norak='$norak', nobaris='$nobaris', nobox='$nobox' WHERE id_nomorarsip='$id'";
		$qArsip 	= mysql_query($query);
	}
	echo "
	<script type='text/javascript'>
		setTimeout(
		function()
			{window.location.replace('media.php?module=rekamnoarsip');},
			1000
		);
	</script>";
	
}

// Modul Hapus Referensi Arsip -----------------------------------------------------------------------------//
elseif($_POST['btnHarsip'] == 'Hapus')
{
	$id			= $_POST['id'];
	$q			= "DELETE FROM r_nomorarsipsp2d WHERE id_nomorarsip='$id'";
	mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('media.php?module=rekamnoarsip');
	</script>";
}

// Modul Load ke Tabel Arsip ========================================================================================//
elseif($_GET['module']=='loadketabelarsip'){
	echo "<script type=\"text/javascript\">
				$(document).ready(function() {
					$('#tanggal').datepicker({
							changeMonth: true,
							changeYear: true
						});
					});
				$(document).ready(function() {
					$('#tanggal1').datepicker({
							changeMonth: true,
							changeYear: true
						});
					});
			</script>
				<div id='stylized' class='myform'>
				<form id='form' name='formLoadTabelArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<h1>Form load data ke tabel arsip SP2D</h1> 
				<p>Pilih tanggal load SP2D</p>
  		 			<label>Tanggal Awal SP2D 
  		 			<span class='small'>Isikan tanggal awal SP2D</span>
					</label>  		 			
  		 			<input id=\"tanggal\" name=\"tgsp2d1\" type=\"text\" />
  		 			
  		 			<label>Tanggal Akhir SP2D 
  		 			<span class='small'>Isikan tanggal SP2D</span>
					</label>  		 			
  		 			<input id=\"tanggal1\" name=\"tgsp2d2\" type=\"text\" />
  	 				<input name='loadKeTabelArsip' type='submit' value='Load' class='button'>
					<div class='spacer'></div>
  	 			</form>
  	 			</div>";
}

// Modul Load ke Arsip ------------------------------------------------------------------------------------------------//
elseif($_POST['loadKeTabelArsip']=='Load'){
	$tanggal1	= $helper->dateConvert($_POST['tgsp2d1']);
	$tanggal2	= $helper->dateConvert($_POST['tgsp2d2']);
	
	if(substr($tanggal1,0,4) != substr($tanggal2,0,4))
	{
		echo "
		<script type='text/javascript'>
			alert('Tahun load data berbeda tahun, load hanya bisa dilakukan dalam rentang waktu satu tahun');
			window.location.replace('media.php?module=loadketabelarsip');
		</script>";
	}
	elseif($tanggal1 > $tanggal2)
	{
		echo "
		<script type='text/javascript'>
			alert('Tanggal awal load lebih besar daripada tanggal akhir load');
			window.location.replace('media.php?module=loadketabelarsip');
		</script>";
	}
	elseif(substr($tanggal1,0,4) == '2013' && substr($tanggal2,0,4) == '2013')
	{
		$koneksi = "config/koneksisp2d13.php";
	}
	elseif(substr($tanggal1,0,4) == '2012' && substr($tanggal2,0,4) == '2012')
	{
		$koneksi = "config/koneksisp2d.php";
	}
	elseif(substr($tanggal1,0,4) == '2011' && substr($tanggal2,0,4) == '2011')
	{
		$koneksi = "config/koneksisp2d11.php";
	}

	include_once($koneksi);
	$qLoad		= mysql_query("SELECT DISTINCT nosp2d,tgsp2d,kdjendok,kddept,kdunit,kdsatker,nokarwas,kddekon,nospm,tgspm,noadvis FROM m_spmind WHERE tgsp2d BETWEEN '$tanggal1' AND '$tanggal2'");
	while($rLoad		= mysql_fetch_object($qLoad)){
			$nosp2d		= $rLoad->nosp2d;
			$tgsp2d		= $rLoad->tgsp2d;
			$kdjendok	= $rLoad->kdjendok;
			$kddept		= $rLoad->kddept;
			$kdunit		= $rLoad->kdunit;
			$kdsatker	= $rLoad->kdsatker;
			$nokarwas	= $rLoad->nokarwas;
			$kddekon	= $rLoad->kddekon;
			$nospm		= $rLoad->nospm;
			$tgspm		= $rLoad->tgspm;
			$noadvis	= $rLoad->noadvis;
			$datasp2d[]	= '("' . $nosp2d . '", "' . $tgsp2d . '", "' . $kdjendok . '", "' . $kddept . '", "' . $kdunit . '", "' . $kdsatker . '", "' . $nokarwas . '", "' . $kddekon . '", "' . $nospm . '", "' . $tgspm . '","' . $noadvis . '")';
	}
	
		$qInsert 	= "INSERT INTO monitor.d_arsipsp2d(nosp2d,tgsp2d,kdjendok,kddept,kdunit,kdsatker,nokarwas,kddekon,nospm,tgspm,noadvis) VALUES". implode(',',$datasp2d);
		$filename	= "insertintotable";
		$folder		= dirname(__FILE__)."/temp/".$filename;
		$handle		= @fopen($folder,"w");
		fwrite($handle,$qInsert);
		fclose($handle);
		include_once("config/koneksi.php");
		/* For windows user, start here
		 * For production you must change load_sp2d.bat because file's default is on d:\
		 * $output = system("cmd /c ".dirname(__FILE__).'/load_sp2d.bat');
		 * end here */
		 
		/* For unix family, start here */
		mysql_query($qInsert);
		$output = shell_exec('mysql -uroot -P3306 -hlocalhost -pM3t@m0rph monitor < /var/www/monitor/temp/'.$filename);
		/* end here */
		echo "
			<script type='text/javascript'>
				alert('Load data selesai');
			</script>";
}

// Modul Insert Arsip ========================================================================================//
elseif($_GET['module']=='insertarsip'){
	echo "<script type=\"text/javascript\">
				$(document).ready(function() {
					$('#tanggal').datepicker();
					});
			</script>
				<div id='stylized' class='myform'>
				<form id='form' name='formInsertArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<h1>Form entri data arsip SP2D</h1> 
				<p>Tahap 1 - Entri tanggal SP2D</p>
  		 			<label>Tanggal SP2D 
  		 			<span class='small'>Isikan tanggal SP2D</span>
					</label>  		 			
  		 			<input id=\"tanggal\" name=\"tgsp2d\" type=\"text\" />
  	 				<input name='InsertTgArsip' type='submit' value='Tampilkan' class='button'>
					<div class='spacer'></div>
  	 			</form>
  	 			</div>";
}

// Modul Action Arsip ---------------------------------------------------------------------------------------//
elseif($_POST['InsertTgArsip']=='Tampilkan') {
	$Tglsp2d	= $_POST['tgsp2d'];
	$TglSp2d	= explode('/',$Tglsp2d);
	$tglsp2d	= $TglSp2d[0];
	$blnsp2d	= $TglSp2d[1];
	$thnsp2d	= $TglSp2d[2];
	
	$tgsp2d	= $thnsp2d."-".$blnsp2d."-".$tglsp2d;
	echo "<div id='stylized' class='myform'>
	<form id='form' name='formShowBAArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
	<h1>Form entri data arsip SP2D</h1> 
		<p>Tahap 2 - Entri kode bagian anggaran SP2D</p>		
		<label>Bagian Anggaran
		<span class='small'>Isikan kode bagian anggaran SP2D</span>
		</label>";
		$qcBA	= mysql_query("SELECT kddept FROM d_arsipsp2d  WHERE tgsp2d='$tgsp2d' AND file=''")or die(mysql_error());
		$rcBA	= mysql_fetch_row($qcBA);
			if($rcBA == 0){
			echo "<script type='text/javascript'>
				alert('Data SP2D pada tanggal $Tglsp2d tidak ada');
				history.back(-1);
				</script>";
			}
			else{
				echo "<select name='kddept' size='1'>";
				$qBA		= mysql_query("SELECT DISTINCT a.kddept,b.nmdept FROM d_arsipsp2d a LEFT JOIN t_dept b ON a.kddept=b.kddept WHERE a.tgsp2d='$tgsp2d' AND file='' ORDER BY a.kddept")or die(mysql_error());
					echo "<option selected='selected'>--Bagian Anggaran--</option>";
					while($rBA	= mysql_fetch_array($qBA)){
									$ba		= $rBA['kddept'];
									$nmba	= $rBA['nmdept'];
							echo "<option value='$ba'>$ba - $nmba</option>";
							}
						echo "</select>
						<input name='tgsp2d' type='hidden' value='$tgsp2d' />
						<input name='ScanUploadArsip' type='submit' value='Tampilkan' class='button' />
						<div class='spacer'></div>
						</form>
						</div>";
				}
}

// Modul Scanning dan Upload Arsip SP2D -----------------------------------------------------------------------------------//
elseif($_POST['ScanUploadArsip']=='Tampilkan'){
	$tgsp2d		= $_POST['tgsp2d'];
	$kddept	= $_POST['kddept'];
	$qnmba	= mysql_query("SELECT nmdept FROM t_dept WHERE kddept='$kddept'")or die(mysql_error());
	$rnmba		= mysql_fetch_array($qnmba);
	$nmba		= $rnmba['nmdept'];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='formShowNoDokArsip' method='post' enctype='multipart/form-data'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form entri data arsip SP2D</h1> 
					<p>Tahap 3 - Scanning dan upload SP2D</p>
					<h3>Tanggal SP2D : $tgsp2d
					<br />
					Kementerian : $nmba</h3>
					
					</div>
					<br />	
					<div id='normaltable'>
					<table class='normaltable'>
					<tr>
						<th width='5%'>No.</th>
						<th width='8%'>No. SP2D</th>
						<th width='12%'>Kode Unik</th>
						<th width='8%'>Satker</th>
						<th width='8%'>No. SPM</th>
						<th width='20%'>Tgl. SPM</th>
						<th>Scanning</th>
					</tr>";
					
							$qsp2d	= mysql_query("SELECT DISTINCT * FROM d_arsipsp2d  WHERE tgsp2d='$tgsp2d' AND kddept='$kddept' AND file='' AND norak='' AND nobaris='' AND (nobox='' OR nobox2='') ORDER BY nosp2d,kdunit,kdsatker")or die(mysql_error());
							$oddcol		= "#CCFF99";
							$evencol		= "#CCDD88";
							$no	= 1;
							while($rsp2d	= mysql_fetch_array($qsp2d)){
								if($no % 2 == 0) {$color = $evencol;}
								else{$color = $oddcol;}
								$nosp2d	= $rsp2d['nosp2d'];
								$nospm	= $rsp2d['nospm'];
								$tgspm		= $rsp2d['tgspm'];
								$kdjendok	= $rsp2d['kdjendok'];
								$kddept	= $rsp2d['kddept'];
								$kdunit		= $rsp2d['kdunit'];
								$tgsp2d		= $rsp2d['tgsp2d'];
								$kdsatker	= $rsp2d['kdsatker'];
								$nokarwas	= $rsp2d['nokarwas'];
								$kddekon	= $rsp2d['kddekon'];
								$kdunik		= "$kdjendok.$kddept.$kdunit.$kddekon.$nokarwas";
								
						
						echo "<tr bgcolor='$color'>
								<td>$no</td>
								<td><b>$nosp2d</b></td>
								<td>$kdunik</td>
								<td>$kdsatker</td>
								<td>$nospm</td>
								<td>$tgspm</td>
								<td>
										<input type='file' name='fupload$no' />
										<input type='hidden' name='nosp2d$no' value='$nosp2d' />
								</td>
							</tr>";
						$no++;
					}
					$jdata	= $no-1;
					echo "<tr bgcolor='#AADD77'>
							<td colspan='8'>
							</td>
						</tr>
						</table>
							<input type='hidden' name='tgsp2d' value='$tgsp2d' />
							<input type='hidden' name='kddept' value='$kddept' />
							<input type='hidden' name='jdata' value='$jdata' />
							<input type='submit' class='normaltablesubmit' name='uploadbutton' value='Upload' />
						</form>
						</div>
						<div class='spacer'></div>
					</form>";
}

// Modul Upload Nama Arsip Hasil Scan SP2D -----------------------------------------------------------------------------------//
elseif($_POST['uploadbutton'] == "Upload"){
	$n	= $_POST['jdata'];
	$tgsp2d	= $_POST['tgsp2d'];
	$kddept= $_POST['kddept'];
	for($i=1; $i<=$n; $i++){
	
				$nosp2d	= $_POST['nosp2d'.$i];
				$lokasi_file	=$_FILES['fupload'.$i]['tmp_name'];
				$nama_file	=$_FILES['fupload'.$i]['name'];
				// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
				$direktori	='file/'.basename($nama_file);
				
				
					move_uploaded_file($lokasi_file,$direktori);
					mysql_query("UPDATE d_arsipsp2d SET file='$nama_file' WHERE nosp2d='$nosp2d'");
					echo "<script type='text/javascript'>
							window.location.href='media.php?module=insertnorak&tgsp2d=$tgsp2d&kddept=$kddept';
					</script>";
	}
}
// Modul Pilih No. Rak, Baris, Box Arsip SP2D -----------------------------------------------------------------------------------//
elseif($_GET['module']=='insertnorak' && $_GET['tgsp2d'] && $_GET['kddept']){
	$tgsp2d		= $_GET['tgsp2d'];
	$kddept	= $_GET['kddept'];
	$qnmba	= mysql_query("SELECT nmdept FROM t_dept WHERE kddept='$kddept'")or die(mysql_error());
	$rnmba		= mysql_fetch_array($qnmba);
	$nmba		= $rnmba['nmdept'];
	echo "<div id='stylized' class='myform'>
			<form id='form' name='formShowNoRakArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form entri data arsip SP2D</h1> 
					<p>Tahap 4 - Pilih rak, baris, dan box untuk arsip SP2D</p>
					<h3>Tanggal SP2D : $tgsp2d
					<br />
					Kementerian : $nmba</h3>
					
					</div>
					<br />	
					<div id='normaltable'>
					<table class='normaltable'>
					<tr>
							<th>No.</th>
							<th>No. SP2D</th>
							<th>Kode Unik</th>
							<th>Satker</th>
							<th>No. SPM</th>
							<th>Tgl. SPM</th>
							<th>No. Rak</th>
							<th>No. Baris</th>
							<th>No. Box</th>
						</tr>";
			$qsp2d	= mysql_query("SELECT DISTINCT * FROM d_arsipsp2d  WHERE tgsp2d='$tgsp2d' AND kddept='$kddept' AND (norak='' OR nobaris='' OR nobox='')")or die(mysql_error());
			$no	= 1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rsp2d	= mysql_fetch_array($qsp2d)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				$nosp2d	= $rsp2d['nosp2d'];
				$nospm	= $rsp2d['nospm'];
				$tgspm		= $rsp2d['tgspm'];
				$kdjendok	= $rsp2d['kdjendok'];
				$kddept	= $rsp2d['kddept'];
				$kdunit		= $rsp2d['kdunit'];
				$tgsp2d		= $rsp2d['tgsp2d'];
				$kdsatker	= $rsp2d['kdsatker'];
				$nokarwas	= $rsp2d['nokarwas'];
				$kddekon	= $rsp2d['kddekon'];
				$kdunik		= "$kdjendok.$kddept.$kdunit.$kddekon.$nokarwas";
				
				
					echo "<tr bgcolor='$color'>
							<td>$no</td>
							<td>$nosp2d</td>
							<td>$kdunik</td>
							<td>$kdsatker</td>
							<td>$nospm</td>
							<td>$tgspm</td>
							<td>
								<select name='norak$no'>";
									$qnorak	= mysql_query("SELECT DISTINCT norak FROM r_nomorarsipsp2d WHERE kddept='$kddept' ORDER BY norak")or die(mysql_error());
									echo "<option value='' selected='selected'>--No. Rak--</option>";
									while($rnorak	= mysql_fetch_array($qnorak)){
										 $norak		= $rnorak['norak'];
										echo "<option value='$norak'>$norak</option>";
									}
							echo "</select>
							</td>
							<td>
								<select name='nobaris$no'>";
									$qnobaris	= mysql_query("SELECT DISTINCT nobaris FROM r_nomorarsipsp2d WHERE kddept='$kddept' ORDER BY nobaris")or die(mysql_error());
									echo "<option value='' selected='selected'>--No. Baris--</option>";
									while($rnobaris	= mysql_fetch_array($qnobaris)){
										$nobaris	= $rnobaris['nobaris'];
										echo "<option value='$nobaris'>$nobaris</option>";
									}
							echo "</select>
							</td>
							<td>
								<select name='nobox$no'>";
									$qnobox	= mysql_query("SELECT DISTINCT nobox FROM r_nomorarsipsp2d WHERE kddept='$kddept' ORDER BY nobox")or die(mysql_error());
									echo "<option value='' selected='selected'>--No. Box--</option>";
									while($rnobox	= mysql_fetch_array($qnobox)){
										$nobox		= $rnobox['nobox'];
										echo "<option value='$nobox'>$nobox</option>";
									}
							echo "</select>
							</td>
							<input type='hidden' name='nosp2d$no' value='$nosp2d' />";
				$no++;
			}
			$jdata	= $no-1;
			echo "<tr>
					<td colspan='9'>
					<input type='hidden' name='jdata' value='$jdata' />
					<input type='submit' class='normaltablesubmit' name='insertTobox' value='Simpan' />
					</td>
					</table>
			<div class='spacer'></div>
		</form>
		</div>";
	}
// Modul Entri Arsip SP2D -----------------------------------------------------------------------------------//
elseif($_POST['insertTobox'] == "Simpan"){
	$n	= $_POST['jdata'];
	for($i=1; $i<=$n; $i++){
		$nosp2d	= $_POST['nosp2d'.$i];
		echo $nosp2d."<br />";
		$norak		= $_POST['norak'.$i];
		echo $norak."<br />";
		$nobaris	= $_POST['nobaris'.$i];
		echo $nobaris."<br />";
		$nobox		= $_POST['nobox'.$i];
		echo $nobox."<br />";
		
		mysql_query("UPDATE d_arsipsp2d SET norak='$norak', nobaris='$nobaris', nobox='$nobox' WHERE nosp2d='$nosp2d'");
		
		echo "<script type='text/javascript'>
				window.location.href='media.php?module=insertarsip';
		</script>";
		
	}
}


// Modul Form Search Arsip =======================================================================================//
elseif($_GET['module']=='searcharsip'){
	echo "<script type=\"text/javascript\">
			$(document).ready(function() {
					$('#tanggal').datepicker();
			});
		</script>
			<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form multikategori pencarian data dokumen arsip</h1>
			<p>Form ini digunakan dalam pencarian data dokumen arsip</p>
					
			<label>Bagian Anggaran</label>
			<input type='checkbox' class='checkbox' name='kddeptCek' />
			<input type='text' id='kddept' minlength='3' name='kddept' maxlength='3' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tanggal')\" />
	
			<label>Tgl. SP2D</label>
			<input type='checkbox' class='checkbox' name='tgsp2dCek' />
			<input type='text' id='tanggal' name='tgsp2d' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nosp2d')\" />
					
			<label>Nomor SP2D</label>
			<input type='checkbox' class='checkbox' name='nosp2dCek' />
			<input type='text' id='nosp2d' name='nosp2d'  maxlength='7' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
					
			<label>Kode Satker</label>
			<input type='checkbox' class='checkbox' name='kdsatkerCek' />
			<input type='text' id='kdsatker' name='kdsatker' maxlength='6' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nospm')\" />
			
			<label>Nomor SPM</label>
			<input type='checkbox' class='checkbox' name='nospmCek' />
			<input type='text' id='nospm' name='nospm' maxlength='5' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'norak')\" />
					
			<label>Nomor Rak</label>
			<input type='checkbox' class='checkbox'  name='norakCek' />
			<input type='text' id='norak' name='norak' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobaris')\" />
										
			<label>Nomor Baris</label>
			<input type='checkbox' class='checkbox' name='nobarisCek' />
			<input type='text' id='nobaris' name='nobaris' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobox')\" />
								
			<label>Nomor Box</label>
			<input type='checkbox' class='checkbox' name='noboxCek' />
			<input type='text' id='nobox' name='nobox' maxlength='5' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
			<input type='submit' value='Cari' class='button' id='submit' name='cariDoksp2d' />
			<div class='spacer'></div>
			</form>
			</div>";
}

// Modul  Search Arsip SP2D----------------------------------------------------------------------------------------------------------------------------------------------//
elseif($_POST['cariDoksp2d'] == "Cari"){
	$kddeptCek		= $_POST['kddeptCek'];
	$tgsp2dCek		= $_POST['tgsp2dCek'];
	$nosp2dCek	= $_POST['nosp2dCek'];
	$kdsatkerCek	= $_POST['kdsatkerCek'];
	$nospmCek		= $_POST['nospmCek'];
	$norakCek		= $_POST['norakCek'];
	$nobarisCek	= $_POST['nobarisCek'];
	$noboxCek		= $_POST['noboxCek'];
	$Kddept		= $_POST['kddept'];
	$kddept		= sprintf("%03s",$Kddept);
	$TgSp2d		= $_POST['tgsp2d'];
	$Tgsp2d		= explode("/",$TgSp2d);
	$TgSP2D		= $Tgsp2d[0];
	$BlSP2D		= $Tgsp2d[1];
	$ThSP2D		= $Tgsp2d[2];
	$tgsp2d			= $ThSP2D."-".$BlSP2D."-".$TgSP2D;
	$nosp2d		= $_POST['nosp2d'];
	$kdsatker		= $_POST['kdsatker'];
	
	$Nospm		= $_POST['nospm'];
	$nospm		= sprintf("%05s",$Nospm);
	
	$Norak			= $_POST['norak'];
	$norak			= sprintf("%04s",$Norak);
	
	$Nobaris		= $_POST['nobaris'];
	$nobaris		= sprintf("%04s",$Nobaris);
	
	$Nobox			= $_POST['nobox'];
	$nobox			= sprintf("%05s",$Nobox);
	
	$bagianWhere="";
	
	if(isset($kddeptCek)){
		$kddept;
		if(empty($bagianWhere)){
			$bagianWhere .= "kddept='$kddept'";
		}
	}
	if(isset($tgsp2dCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "tgsp2d='$tgsp2d'";
		}
		else{
			$bagianWhere .= "AND tgsp2d='$tgsp2d'";
		}
	}
	if(isset($nosp2dCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "nosp2d='$nosp2d'";
		}
		else{
			$bagianWhere .= "AND nosp2d='$nosp2d'";
		}
	}
	if(isset($kdsatkerCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "kdsatker='$kdsatker'";
		}
		else{
			$bagianWhere .= "AND kdsatker='$kdsatker'";
		}
	}
	if(isset($nospmCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "nospm='$nospm'";
		}
		else{
			$bagianWhere .= "AND nospm='$nospm'";
		}
	}
	if(isset($norakCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "norak='$norak'";
		}
		else{
			$bagianWhere .= "AND norak='$norak'";
		}
	}
	if(isset($nobarisCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "nobaris='$nobaris'";
		}
		else{
			$bagianWhere .= "AND nobaris='$nobaris'";
		}
	}
	if(isset($noboxCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "nobox LIKE '%$nobox%' OR nobox2 LIKE '%$nobox%'";
		}
		else{
			$bagianWhere .= "AND (nobox LIKE '%$nobox%' OR nobox2 LIKE '%$nobox%')";
		}
	}
	
	$queryCek	= "SELECT * FROM d_arsipsp2d WHERE ".$bagianWhere;
	$qCek		= mysql_query($queryCek)or die(mysql_error());
	$rCek		= mysql_fetch_row($qCek);
	
	if($rCek > 0){
		
		echo "<div id='stylized' class='myform'>
				<form id='form' name='formShowNoRakArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<h1>Form hasil pencarian data arsip SP2D</h1> 
					<p>Hasil pencarian rak, baris, dan box untuk arsip SP2D</p>
					</form>
					</div>
					<br />	
					<table class='normaltable' border='0' cellpadding='2'>
					<tr>
					<th width='6%'>No.</th>
					<th width='10%'>No. SP2D</th>
					<th width='14%'>Tgl. SP2D</th>
					<th width='8%'>No. SPM</th>
					<th width='14%'>Tgl. SPM</th>
					<th width='12%'>Kode Unik</th>
					<th width='8%'>Satker</th>
					<th width='8%'>No. Rak</th>
					<th width='8%'>No. Baris</th>
					<th width='8%'>No. Box</th>
					<th width='10%'>File</th>
					<th colspan='2'>Tindakan</th>
					</tr>";
			
			$query		= "SELECT * FROM d_arsipsp2d WHERE ".$bagianWhere;
			$qCari		= mysql_query($query)or die(mysql_error());
			$no	= 1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rCari		= mysql_fetch_array($qCari)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
						$nosp2d	= $rCari['nosp2d'];
						$tgsp2d		= $rCari['tgsp2d'];
						$kdjendok	= $rCari['kdjendok'];
						$kddept	= $rCari['kddept'];
						$kdunit		= $rCari['kdunit'];
						$kdsatker	= $rCari['kdsatker'];
						$nokarwas	= $rCari['nokarwas'];
						$kddekon	= $rCari['kddekon'];
						$nospm	= $rCari['nospm'];
						$tgspm		= $rCari['tgspm'];
						$norak		= $rCari['norak'];
						$nobaris	= $rCari['nobaris'];
						$nobox		= $rCari['nobox'];
						$nobox2		= $rCari['nobox2'];
						$file		= $rCari['file'];
						$kdunik		= "$kdjendok.$kddept.$kdunit.$kddekon.$nokarwas";
					
						echo"<tr bgcolor='$color'>
								<td>$no</td>
								<td>$nosp2d</td>
								<td>$tgsp2d</td>
								<td>$nospm</td>
								<td>$tgspm</td>
								<td>$kdunik</td>
								<td>$kdsatker</td>
								<td><b><font color='#0000FF'>$norak</font></b></td>
								<td><b><font color='#D40103'>$nobaris</font></b></td>";
								if($nobox == "")
								{
									echo "<td><b><font color='#62079B'>$nobox2</font></b></td>";
								}
								else
								{
									echo "<td><b><font color='#62079B'>$nobox</font></b></td>";
								}
								echo "
								<td><b><i><a href='file/$file' target='_blank'>$file</a></b></i></td>
								<td>
									<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
										<input type='hidden' name='nosp2d' value='$nosp2d' />
										<input type='submit' class='normaltablesubmit' name='editDataBox' value='Edit' />
									</form>
								</td>
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

//Modul Form Edit Data Dokumen SP2D ========================================================================//
elseif($_POST['editDataBox'] == 'Edit'){
	$nosp2d	= $_POST['nosp2d'];
	$qEdit		= mysql_query("SELECT * FROM d_arsipsp2d WHERE nosp2d='$nosp2d'");
	$rEdit		= mysql_fetch_array($qEdit);
		
	$kddept		= $rEdit['kddept'];
	$tgsp2d		= $helper->dateConvert($rEdit['tgsp2d']);
	$kdsatker	= $rEdit['kdsatker'];
	$nospm		= $rEdit['nospm'];
	$norak		= $rEdit['norak'];
	$nobaris	= $rEdit['nobaris'];
	$nobox		= $rEdit['nobox'];
	$Nobox2		= explode("-",$rEdit['nobox2']);
	$nobox2		= $Nobox2[1];
	$file		= $rEdit['file'];
	
	echo"<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
			});
			</script>
					<div id='stylized' class='myform'>
					<form id='form' name='form' method='post' enctype='multipart/form-data' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
					<h1>Form edit data nomor rak, baris, box, dan file arsip SP2D</h1>
					<p>Form ini digunakan dalam melakukan perubahan data nomor rak, baris, box, dan file dokumen arsip</p>
							
					<label>Kode BA
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='kddept' minlength='3' name='kddept' maxlength='3' value='$kddept' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tgsp2d')\" />
	
					<label>Tanggal SP2D
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='tgsp2d' name='tgsp2d'  value='$tgsp2d' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nosp2d')\" />
					
					<label>Nomor SP2D
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='nosp2d' name='nosp2d'  value='$nosp2d' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nospm')\" />
					
					<label>Nomor SPM
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='nospm' name='nospm' value='$nospm' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
							

					<label>Kode Satker
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='kdsatker' name='kdsatker' value='$kdsatker' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'norak')\" />
					
					<label>Nomor Rak
					<span class='small'>Dapat diubah</span>
					</label>
					<select name='norak'>";
					$qnorak	= mysql_query("SELECT DISTINCT norak FROM r_nomorarsipsp2d WHERE kddept='$kddept' AND norak!='$norak' ORDER BY norak")or die(mysql_error());
					echo "<option value='$norak' selected='selected'>$norak</option>";
					while($rnorak	= mysql_fetch_array($qnorak)){
						$norak		= $rnorak['norak'];
						echo "<option value='$norak'>$norak</option>";
					}
					echo "</select>
					
					<label>Nomor Baris
					<span class='small'>Dapat diubah</span>
					</label>
					<select name='nobaris'>";
					$qnobaris	= mysql_query("SELECT DISTINCT nobaris FROM r_nomorarsipsp2d WHERE kddept='$kddept' AND nobaris!='$nobaris' ORDER BY nobaris")or die(mysql_error());
					echo "<option value='$nobaris' selected='selected'>$nobaris</option>";
					while($rnobaris	= mysql_fetch_array($qnobaris)){
						$nobaris	= $rnobaris['nobaris'];
						echo "<option value='$nobaris'>$nobaris</option>";
					}
					echo "</select>
							
					<label>Nomor Box
					<span class='small'>Dapat diubah</span>
					</label>
					<select name='nobox'>";
					$qnobox	= mysql_query("SELECT DISTINCT nobox FROM r_nomorarsipsp2d WHERE kddept='$kddept' AND nobox!='$nobox' ORDER BY nobox")or die(mysql_error());
					echo "<option value='$nobox' selected='selected'>$nobox</option>";
					while($rnobox	= mysql_fetch_array($qnobox)){
						$nobox		= $rnobox['nobox'];
						echo "<option value='$nobox'>$nobox</option>";
					}
					echo "</select>
					
					<label>Nomor Box Metode 2
					<span class='small'>Dapat diubah</span>
					</label>
					<input type='text' id='nobox2' name='nobox2' value='$nobox2' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" />
					
					<label>File Upload
					<span class='small'>Dapat diubah, apabila tidak berubah biarkan kosong</span>
					</label>
					<input type='file' id='file' name='file' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
									
					<input type='submit' value='Update' class='button' id='submit' name='Updatedataarsip' />
					<div class='spacer'></div>
					</form>
					</div>";
}

// Modul Update Data Nomor Rak, Baris, Box, dan File Arsip SP2D ----------------------------------------------------------------------------------------//
elseif($_POST['Updatedataarsip'] == 'Update'){
	$nosp2d			= $_POST['nosp2d'];
	$tgsp2d			= $helper->dateConvert($_POST['tgsp2d']);
	$tgsp2d			= str_replace("-","",$tgsp2d);
	$norak			= $_POST['norak'];
	$nobaris		= $_POST['nobaris'];
	$nobox			= $_POST['nobox'];
	$nobox2			= sprintf("%05s",$_POST['nobox2']);
	$nobox2			= $tgsp2d."-".$nobox2;
	$lokasi_file	= $_FILES['file']['tmp_name'];
	$nama_file		= $_FILES['file']['name'];
	// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
	$direktori	='file/'.basename($nama_file);
	if(empty($nama_file)){			
		mysql_query("UPDATE d_arsipsp2d SET norak='$norak', nobaris='$nobaris', nobox='$nobox', nobox2='$nobox2'  WHERE nosp2d='$nosp2d'");
		echo "<script type='text/javascript'>
				alert('Nomor SP2D $nosp2d telah dilakukan perubahan data arsipnya dengan nomor rak $norak, nomor baris $nobaris, nomor box $nobox, atau nomor box metode 2 $nobox2!');
				window.location.replace('media.php?module=home');
		</script>";
	}	
	else{
		move_uploaded_file($lokasi_file,$direktori);
		mysql_query("UPDATE d_arsipsp2d SET file='$nama_file', norak='$norak', nobaris='$nobaris', nobox2='$nobox2',nobox='$nobox'  WHERE nosp2d='$nosp2d'");
		echo "<script type='text/javascript'>
				alert('Nomor SP2D $nosp2d telah dilakukan perubahan data arsipnya dengan nomor rak $norak, nomor baris $nobaris, nomor box $nobox, atau nomor box metode 2 $nobox2!');
				window.location.replace('media.php?module=home');
			</script>";
	}
}

// Modul Insert Arsip Metode 2 ===============================================================================//
elseif($_GET['module'] == 'insertarsip2')
{
	echo "
	<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
			$(document).ready(function(){
				$('#form').validate();
			});
	</script>
	<div id='stylized' class='myform'>
				<form id='form' name='formInsertArsip' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<h1>Form entri data arsip SP2D Metode II</h1> 
				<p>Tahap 1 - Entri Nomor SP2D</p>";
					$q 		= "SELECT MAX(nobox2) AS maxNobox FROM d_arsipsp2d LIMIT 1";
					$qMaxNo	= mysql_query($q);
					$rMaxNo	= mysql_fetch_object($qMaxNo);
					$NewMaxNo = $rMaxNo->maxNobox;
					if($NewMaxNo == 0)
					{
						$newMaxNo = sprintf("%05s",++$NewMaxNo);
					}
					else
					{
						$explNewMaxNo	= explode("-",$NewMaxNo);
						$newMaxNo 		= $explNewMaxNo[1];
					}
				echo "
					Nomor Box Terakhir Yang Digunakan: 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<font color='#404040' size='4'><b>".$newMaxNo."</b></font>  		 			
  		 			<br />
  		 			<br />
  		 			<label>Nomor SP2D 
  		 			<span class='small'>Isikan nomor SP2D</span>
					</label> 
					<input type='hidden' name='nobox' value='$newMaxNo' />
  		 			<input id=\"nosp2d\" class=\"required\" name=\"nosp2d\" type=\"text\" minlength='7' maxlength='7' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit2')\" autofocus='autofocus' />
  		 			
  	 				<input id='submit2' name='InsertNoSP2D' type='submit' value='No.Box Lama' class='button1'>
  	 				<input id='submit3' name='InsertNoSP2D' type='submit' value='Ambil No.Box' class='button1'>
					<div class='spacer'></div>
  	 			</form>
  	 			</div>";
}

// Modul Penambahan No.Box Baru dan Validasi Nomor SP2D ----------------------------------------------------//
elseif($_POST['InsertNoSP2D'] == 'Ambil No.Box')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";
	// casting to integer
	$nobox	= (int) $_POST['nobox'];
	$nobox++;
	$nobox	= sprintf("%05s",$nobox);
	$nosp2d	= strtoupper($_POST['nosp2d']);
	// query for checking existence data
	$q	 	= "SELECT nosp2d FROM d_arsipsp2d WHERE nosp2d='$nosp2d' LIMIT 1";
	$qCek	= mysql_query($q);
	$rCek	= mysql_num_rows($qCek);
	if($rCek == 0)
	{
		echo "
		<div id='promptkonfirmasi' title='informasi'>
			<br />
			<center>
			<b><font color='#FFFFFF' size='4'>Data tersebut tidak ada</font></b>
			<br />
			<br />
			<form id='form' name='formIKembaliArsip2' method='get' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<input type='hidden' name='module' value='insertarsip2' />
			<input type='submit' name='btnClose' value='Kembali' />
			</form>
			</center>
		</div>";
	}
	else
	{
		$q 		= "SELECT kddept,kdunit,kdsatker,kddekon,nosp2d,tgsp2d,nospm,tgspm FROM d_arsipsp2d WHERE nosp2d='$nosp2d' LIMIT 1";
		$qSp2d		= mysql_query($q);
		$rSp2d		= mysql_fetch_object($qSp2d);
		$kddept		= $rSp2d->kddept;
		$kdsatker	= $rSp2d->kdsatker;
		$kddekon	= $rSp2d->kddekon;
		$nosp2d		= $rSp2d->nosp2d;
		$tgsp2d		= $helper->dateConvert($rSp2d->tgsp2d);
		$newtgsp2d	= str_replace("-","",$rSp2d->tgsp2d);
		$nospm		= $rSp2d->nospm;
		$tgspm		= $helper->dateConvert($rSp2d->tgspm);
		echo"<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
			});
			</script>
					<div id='stylized' class='myform'>
					<form id='form' name='frmEntriarsip' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
					<h1>Form entri data gudang, nomor rak, baris, box, dan file arsip SP2D</h1>
					<p>Tahap 2 - Form ini digunakan dalam melakukan entri data gudang, nomor rak, baris, box, dan file dokumen arsip
						<h3>Data SP2D</h3>
					</p>
							
					<label>Kode BA
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='kddept' minlength='3' name='kddept' maxlength='3' value='$kddept' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tgsp2d')\" />
	
					<label>Tanggal SP2D
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='tgsp2d' name='tgsp2d'  value='$tgsp2d' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nosp2d')\" />
					
					<label>Nomor SP2D
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='nosp2d' name='nosp2d'  value='$nosp2d' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tgspm')\" />
					
					<label>Tanggal SPM
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='tgspm' name='tgspm' value='$tgspm' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nospm')\" />
							
					<label>Nomor SPM
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='nospm' name='nospm'  value='$nospm' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
					
					<label>Kode Satker
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='kdsatker' name='kdsatker' value='$kdsatker' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'gudang')\" />
					
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<p>
					<h3>Data Arsip</h3>
				</p>
				<br />
					<label>Nama Gudang
					<span class='small'>Nama Gudang</span>
					</label>
					<select id='gudang' name='gudang' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'norak')\">
						<option value='' selected='selected'>--Nama Gudang--</option>";
						$qG		= "SELECT nm_gudang,ket_gudang FROM r_gudang ORDER BY id_gudang ASC";
						$qGudang= mysql_query($qG);
						while($rGudang = mysql_fetch_object($qGudang))
						{
							echo "<option value='".$rGudang->nm_gudang."'>Gudang ".$rGudang->nm_gudang." - ".$rGudang->ket_gudang."</option>";
						}
					echo "
					</select>
					
					<label>Nomor Rak
					<span class='small'>Nomor Rak</span>
					</label>
					<input type='text' id='norak' name='norak' minlength='1' maxlength='4' class='required' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobaris')\" autofocus='autofocus'  />
					
					<label>Nomor Baris
					<span class='small'>Nomor Baris</span>
					</label>
					<input type='text' id='nobaris' name='nobaris' minlength='1' maxlength='4' class='required' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobox')\" />
							
					<label>Nomor Box
					<span class='small'>Nomor Box (Otomatis)</span>
					</label>
					<input type='text' id='nobox' name='nobox' minlength='1' maxlength='14' readonly='readonly' value='".$newtgsp2d."-".$nobox."'onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" style='font-weight:bold;color:blue;' />
					
					<label>File Upload
					<span class='small'>File yang di-upload</span>
					</label>
					<input type='file' id='file' name='file' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
									
					<input type='submit' value='Simpan' class='button' id='submit' name='Insertdataarsip2' />
					<div class='spacer'></div>
					</form>
					</div>";
	}
}

// Modul Simpan Arsip2 ------------------------------------------------------------------------------------//
elseif($_POST['Insertdataarsip2'] == 'Simpan')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";
	$gudang		= $_POST['gudang'];
	if($gudang == "")
	{
		echo "
		<div id='promptkonfirmasi' title='Informasi'>
			<br />
			<center>
			<b><font color='#FFFFFF' size='4'>Anda belum memilih gudang</font></b>
			<br />
			<br />
			<form id='form' name='formIKembaliArsip2' method='get' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<input type='hidden' name='module' value='insertarsip2' />
			<input type='submit' name='btnClose' value='Kembali' />
			</form>
			</center>
		</div>";
	}
	else
	{
		$nosp2d 		= $_POST['nosp2d'];
		$norak			= sprintf("%04s",$_POST['norak']);
		$nobaris		= sprintf("%04s",$_POST['nobaris']);
		$nobox			= $_POST['nobox'];
		
		
		$lokasi_file	= $_FILES['file']['tmp_name'];
		$nama_file		= $_FILES['file']['name'];
		// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
		$direktori		= 'file/'.basename($nama_file);

		// move files from temporary to directory
		move_uploaded_file($lokasi_file,$direktori);
		// update d_arsipsp2d
		$qSp2d		= "UPDATE d_arsipsp2d SET gudang='$gudang',norak='$norak',nobaris='$nobaris',nobox2='$nobox',file='$nama_file' WHERE nosp2d='$nosp2d'";
		mysql_query($qSp2d);
		// result checking
		$qCek		= mysql_query("SELECT gudang FROM d_arsipsp2d WHERE nosp2d='$nosp2d' LIMIT 1");
		$rCek		= mysql_num_rows($qCek);
		if($rCek == 0)
		{
			echo "
			<div id='promptkonfirmasi' title='Informasi'>
				<br />
				<center>
				<b><font color='#FFFFFF' size='4'>Data gagal disimpan</font></b>
				<br />
				<br />
				<form id='form' name='formIKembaliArsip2' method='get' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='hidden' name='module' value='insertarsip2' />
				<input type='submit' name='btnClose' value='Kembali' />
				</form>
				</center>
			</div>";
		}
		else
		{
				echo "
				<div id='promptkonfirmasi' title='Informasi'>
					<br />
					<center>
					<b><font color='#FFFFFF' size='4'>Data berhasil disimpan</font></b>
					<br />
					<br />
					<form id='form' name='formIKembaliArsip2' method='get' action='".htmlentities($_SERVER['PHP_SELF'])."'>
					<input type='hidden' name='module' value='insertarsip2' />
					<input type='submit' name='btnClose' value='Kembali' />
					</form>
					</center>
				</div>";
		}
	}
}

// Modul No.Box Lama dan Validasi Nomor SP2D --------------------------------------------------------------//
elseif($_POST['InsertNoSP2D'] == 'No.Box Lama')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	$nobox	= $_POST['nobox'];
	$nosp2d	= strtoupper($_POST['nosp2d']);
	// query for checking existence data
	$q	 	= "SELECT nosp2d FROM d_arsipsp2d WHERE nosp2d='$nosp2d' LIMIT 1";
	$qCek	= mysql_query($q);
	$rCek	= mysql_num_rows($qCek);
	if($rCek == 0)
	{
		echo "
		<div id='promptkonfirmasi' title='informasi'>
			<br />
			<center>
			<b><font color='#FFFFFF' size='4'>Data tersebut tidak ada</font></b>
			<br />
			<br />
			<form id='form' name='formIKembaliArsip2' method='get' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<input type='hidden' name='module' value='insertarsip2' />
			<input type='submit' name='btnClose' value='Kembali' />
			</form>
			</center>
		</div>";
	}
	else
	{
		$q 		= "SELECT kddept,kdunit,kdsatker,kddekon,nosp2d,tgsp2d,nospm,tgspm FROM d_arsipsp2d WHERE nosp2d='$nosp2d' LIMIT 1";
		$qSp2d		= mysql_query($q);
		$rSp2d		= mysql_fetch_object($qSp2d);
		$kddept		= $rSp2d->kddept;
		$kdsatker	= $rSp2d->kdsatker;
		$kddekon	= $rSp2d->kddekon;
		$nosp2d		= $rSp2d->nosp2d;
		$tgsp2d		= $helper->dateConvert($rSp2d->tgsp2d);
		$newtgsp2d	= str_replace("-","",$rSp2d->tgsp2d);
		$nospm		= $rSp2d->nospm;
		$tgspm		= $helper->dateConvert($rSp2d->tgspm);
		echo"<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
			});
			</script>
					<div id='stylized' class='myform'>
					<form id='form' name='frmEntriarsip' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
					<h1>Form entri data gudang, nomor rak, baris, box, dan file arsip SP2D</h1>
					<p>Tahap 2 - Form ini digunakan dalam melakukan entri data gudang, nomor rak, baris, box, dan file dokumen arsip
						<h3>Data SP2D</h3>
					</p>
							
					<label>Kode BA
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='kddept' minlength='3' name='kddept' maxlength='3' value='$kddept' readonly='readonly' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'tgsp2d')\" />
	
					<label>Tanggal SP2D
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='tgsp2d' name='tgsp2d'  value='$tgsp2d' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nosp2d')\" />
					
					<label>Nomor SP2D
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='nosp2d' name='nosp2d'  value='$nosp2d' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tgspm')\" />
					
					<label>Tanggal SPM
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='tgspm' name='tgspm' value='$tgspm' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nospm')\" />
							
					<label>Nomor SPM
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='nospm' name='nospm'  value='$nospm' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdsatker')\" />
					
					<label>Kode Satker
					<span class='small'>Tidak dapat diubah</span>
					</label>
					<input type='text' id='kdsatker' name='kdsatker' value='$kdsatker' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'gudang')\" />
					
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<p>
					<h3>Data Arsip</h3>
				</p>
				<br />
					<label>Nama Gudang
					<span class='small'>Nama Gudang</span>
					</label>
					<select id='gudang' name='gudang' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'norak')\">
						<option value='' selected='selected'>--Nama Gudang--</option>";
						$qG		= "SELECT nm_gudang,ket_gudang FROM r_gudang ORDER BY id_gudang ASC";
						$qGudang= mysql_query($qG);
						while($rGudang = mysql_fetch_object($qGudang))
						{
							echo "<option value='".$rGudang->nm_gudang."'>Gudang ".$rGudang->nm_gudang." - ".$rGudang->ket_gudang."</option>";
						}
					echo "
					</select>
					
					<label>Nomor Rak
					<span class='small'>Nomor Rak</span>
					</label>
					<input type='text' id='norak' name='norak' minlength='1' maxlength='4' class='required' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobaris')\" autofocus='autofocus'  />
					
					<label>Nomor Baris
					<span class='small'>Nomor Baris</span>
					</label>
					<input type='text' id='nobaris' name='nobaris' minlength='1' maxlength='4' class='required' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nobox')\" />
							
					<label>Nomor Box
					<span class='small'>Nomor Box (Otomatis)</span>
					</label>
					<input type='text' id='nobox' name='nobox' minlength='1' maxlength='14' readonly='readonly' value='".$newtgsp2d."-".$nobox."'onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'file')\" style='font-weight:bold;color:blue;' />
					
					<label>File Upload
					<span class='small'>File yang di-upload</span>
					</label>
					<input type='file' id='file' name='file' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
									
					<input type='submit' value='Simpan' class='button' id='submit' name='Insertdataarsip2' />
					<div class='spacer'></div>
					</form>
					</div>";
	}
}

// Modul Referensi Gudang =================================================================================//
elseif($_GET['module'] == 'referensigudang')
{
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<h1>Tabel Referensi Gudang</h1>
			<p>Tabel referensi gudang</p>
			</div>
			</form>
			
			<br />
			<br />
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='submit' name='btnEgudang' value='Tambah Data' class='normaltablesubmit' style='width:100px !important;' />
			</form>
			<br />
			<div id='normaltable'>
				<table class='normaltable' width='100%'>
					<tr>
							<th width='5%'>No.</th>
							<th width='10%'>Nama Gudang</th>
							<th width='60%'>Keterangan Gudang</th>
							<th width='20%' colspan='2'>Tindakan</th>
					</tr>";
					$qGudang	= mysql_query("SELECT * FROM r_gudang ORDER BY id_gudang DESC");
					$i	= 1;
					$oddcol			= "#CCFF99";
					$evencol		= "#CCDD88";
					while($rGudang = mysql_fetch_object($qGudang))
					{
						if($i % 2 == 0) {$color = $evencol;}
						else{$color = $oddcol;}
						$id			= $rGudang->id_gudang;
						$nmgudang	= $rGudang->nm_gudang;
						$ketgudang	= $rGudang->ket_gudang;
						echo "
						<tr>
							<td>".$i."</td>
							<td>".$nmgudang."</td>
							<td>".$ketgudang."</td>
							<td>
								<form id='frm_rgudang' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnEgudang' value='Edit' class='normaltablesubmit' />
								</form>
							</td>
							<td>
								<form id='frm_rgudang' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnHgudang' value='Hapus' class='normaltablesubmit' />
								</form>
							</td>
						</tr>";
						$i++;
					}
				echo"
				</table>
			</div>";
}

// Modul Edit Referensi Gudang ------------------------------------------------------------------------------//
elseif($_POST['btnEgudang'])
{
	
	$id_gudang	= $_POST['id'];
	$q			= "SELECT * FROM r_gudang WHERE id_gudang = '$id_gudang' LIMIT 1";
	$qGudang 	= mysql_query($q);
	$rGudang 	= mysql_fetch_object($qGudang);
	$nmgudang	= $rGudang->nm_gudang;
	$ketgudang	= $rGudang->ket_gudang;
	$id			= $rGudang->id_gudang;
	echo $id;
	echo"
	<style type='text/css'>
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
	$(document).ready(function(){
		$('#form').validate();
	});
	</script>
		<div id='stylized' class='myform'>
		<form id='form' name='form' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
		<h1>Form data referensi gudang</h1>
		<p>Form ini digunakan dalam melakukan perekaman/perubahan data referensi Gudang</p>
		<h3>Data Referensi Gudang</h3>
		<p></p>
				
		<label>Nama Gudang
		<span class='small'>Nama Gudang</span>
		</label>
		<input type='text' id='nmgudang'name='nmgudang' minlength='1'  maxlength='1' value='$nmgudang' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'ketgudang')\" autofocus='autofocus' />

		<label>Keterangan Gudang
		<span class='small'>Keterangan Gudang</span>
		</label>
		<input type='text' id='ketgudang' name='ketgudang'  value='$ketgudang' minlength='2' maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
		
		
		<input type='hidden' name='id_gudang' value='$id' />
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUgudang' />
		<div class='spacer'></div>
		</form>
		</div>";
}

// Modul Update Referensi Gudang -----------------------------------------------------------------------------//
elseif($_POST['btnUgudang'] == 'Simpan')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	
	$id			= $_POST['id_gudang'];
	$nmgudang	= strtoupper($_POST['nmgudang']);
	$ketgudang	= $_POST['ketgudang'];
	if($id == "")
	{
		$q		= "SELECT nm_gudang FROM r_gudang WHERE nm_gudang LIKE '%$nmgudang%'";
		$qCek	= mysql_query($q);
		$rCek	= mysql_num_rows($qCek);
		if(!$rCek)
		{
			$q 		= "REPLACE r_gudang SET nm_gudang='$nmgudang',ket_gudang='$ketgudang'";
			$qGudang= mysql_query($q);
		}
		else
		{
			echo "
			<div id='promptkonfirmasi' title='informasi'>
				<br />
				<center>
				<b><font color='#FFFFFF' size='4'>Data dengan nama gudang $nmgudang tersebut sudah ada</font></b>
				<br />
				<br />
			</div>";
		}
	}
	else
	{
		$q		= "UPDATE r_gudang SET nm_gudang='$nmgudang',ket_gudang='$ketgudang' WHERE id_gudang='$id'";
		$qGudang= mysql_query($q);
	}
	
	echo "
	<script type='text/javascript'>
		setTimeout(
		function()
			{window.location.replace('media.php?module=referensigudang');},
			1500
		);
	</script>";
}

// Modul Hapus Referensi Gudang -----------------------------------------------------------------------------//
elseif($_POST['btnHgudang'] == 'Hapus')
{
	$id			= $_POST['id'];
	$q			= "DELETE FROM r_gudang WHERE id_gudang='$id'";
	mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('media.php?module=referensigudang');
	</script>";
}

// Modul Referensi Rak =================================================================================//
elseif($_GET['module'] == 'referensirak')
{
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<h1>Tabel Referensi Rak</h1>
			<p>Tabel referensi rak</p>
			</div>
			</form>
			
			<br />
			<br />
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='submit' name='btnErak' value='Tambah Data' class='normaltablesubmit' style='width:100px !important;' />
			</form>
			<br />
			<div id='normaltable'>
				<table class='normaltable' width='100%'>
					<tr>
							<th width='5%'>No.</th>
							<th width='10%'>Kode Rak</th>
							<th width='60%'>Keterangan Rak</th>
							<th width='20%' colspan='2'>Tindakan</th>
					</tr>";
					$qRak	= mysql_query("SELECT * FROM r_rak ORDER BY id_rak DESC");
					$i	= 1;
					$oddcol			= "#CCFF99";
					$evencol		= "#CCDD88";
					while($rRak = mysql_fetch_object($qRak))
					{
						if($i % 2 == 0) {$color = $evencol;}
						else{$color = $oddcol;}
						$id			= $rRak->id_rak;
						$kdrak		= $rRak->kd_rak;
						$ketrak		= $rRak->ket_rak;
						echo "
						<tr>
							<td>".$i."</td>
							<td>".$kdrak."</td>
							<td>".$ketrak."</td>
							<td>
								<form id='frm_rrak' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnErak' value='Edit' class='normaltablesubmit' />
								</form>
							</td>
							<td>
								<form id='frm_rrak' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnHrak' value='Hapus' class='normaltablesubmit' />
								</form>
							</td>
						</tr>";
						$i++;
					}
				echo"
				</table>
			</div>";
}

// Modul Edit Referensi Rak ------------------------------------------------------------------------------//
elseif($_POST['btnErak'])
{
	
	$id_rak		= $_POST['id'];
	$q			= "SELECT * FROM r_rak WHERE id_rak = '$id_rak' LIMIT 1";
	$qRak 		= mysql_query($q);
	$rRak	 	= mysql_fetch_object($qRak);
	$kdrak		= $rRak->kd_rak;
	$ketrak		= $rRak->ket_rak;
	$id			= $rRak->id_rak;

	echo"
	<style type='text/css'>
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
	$(document).ready(function(){
		$('#form').validate();
	});
	</script>
		<div id='stylized' class='myform'>
		<form id='form' name='form' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
		<h1>Form data referensi rak</h1>
		<p>Form ini digunakan dalam melakukan perekaman/perubahan data referensi Rak</p>
		<h3>Data Referensi Rak</h3>
		<p></p>
				
		<label>Kode Rak
		<span class='small'>Kode Rak</span>
		</label>
		<input type='text' id='kdrak'name='kdrak' minlength='1'  maxlength='4' value='$kdrak' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'ketrak')\" autofocus='autofocus' />

		<label>Keterangan Rak
		<span class='small'>Keterangan Rak</span>
		</label>
		<input type='text' id='ketrak' name='ketrak'  value='$ketrak' minlength='2' maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
		
		
		<input type='hidden' name='id_rak' value='$id' />
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUrak' />
		<div class='spacer'></div>
		</form>
		</div>";
}

// Modul Update Referensi Rak -----------------------------------------------------------------------------//
elseif($_POST['btnUrak'] == 'Simpan')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	
	$id			= $_POST['id_rak'];
	$kdrak		= strtoupper($_POST['kdrak']);
	$ketrak		= $_POST['ketrak'];
	if($id == "")
	{
		$q		= "SELECT kd_rak FROM r_rak WHERE kd_rak LIKE '%$kdrak%'";
		$qCek	= mysql_query($q);
		$rCek	= mysql_num_rows($qCek);
		if(!$rCek)
		{
			$q 		= "REPLACE r_rak SET kd_rak='$kdrak',ket_rak='$ketrak'";
			$qRak	= mysql_query($q);
		}
		else
		{
			echo "
			<div id='promptkonfirmasi' title='informasi'>
				<br />
				<center>
				<b><font color='#FFFFFF' size='4'>Data dengan kode rak $kdrak tersebut sudah ada</font></b>
				<br />
				<br />
			</div>";
		}
	}
	else
	{
		$q		= "UPDATE r_rak SET kd_rak='$kdrak',ket_rak='$ketrak' WHERE id_rak='$id'";
		$qRak	= mysql_query($q);
	}
	
	echo "
	<script type='text/javascript'>
		setTimeout(
		function()
			{window.location.replace('media.php?module=referensirak');},
			1500
		);
	</script>";
}

// Modul Hapus Referensi Rak -----------------------------------------------------------------------------//
elseif($_POST['btnHrak'] == 'Hapus')
{
	$id			= $_POST['id'];
	$q			= "DELETE FROM r_rak WHERE id_rak='$id'";
	mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('media.php?module=referensirak');
	</script>";
}

// Modul Referensi Baris =================================================================================//
elseif($_GET['module'] == 'referensibaris')
{
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<h1>Tabel Referensi Baris</h1>
			<p>Tabel referensi baris</p>
			</div>
			</form>
			
			<br />
			<br />
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='submit' name='btnEbaris' value='Tambah Data' class='normaltablesubmit' style='width:100px !important;' />
			</form>
			<br />
			<div id='normaltable'>
				<table class='normaltable' width='100%'>
					<tr>
							<th width='5%'>No.</th>
							<th width='10%'>Kode Baris</th>
							<th width='60%'>Keterangan Baris</th>
							<th width='20%' colspan='2'>Tindakan</th>
					</tr>";
					$qBaris	= mysql_query("SELECT * FROM r_baris ORDER BY id_baris DESC");
					$i	= 1;
					$oddcol			= "#CCFF99";
					$evencol		= "#CCDD88";
					while($rBaris = mysql_fetch_object($qBaris))
					{
						if($i % 2 == 0) {$color = $evencol;}
						else{$color = $oddcol;}
						$id			= $rBaris->id_baris;
						$kdbaris	= $rBaris->kd_baris;
						$ketbaris	= $rBaris->ket_baris;
						echo "
						<tr>
							<td>".$i."</td>
							<td>".$kdbaris."</td>
							<td>".$ketbaris."</td>
							<td>
								<form id='frm_rbaris' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnEbaris' value='Edit' class='normaltablesubmit' />
								</form>
							</td>
							<td>
								<form id='frm_rbaris' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnHbaris' value='Hapus' class='normaltablesubmit' />
								</form>
							</td>
						</tr>";
						$i++;
					}
				echo"
				</table>
			</div>";
}

// Modul Edit Referensi Baris ------------------------------------------------------------------------------//
elseif($_POST['btnEbaris'])
{
	
	$id_baris	= $_POST['id'];
	$q			= "SELECT * FROM r_baris WHERE id_baris = '$id_baris' LIMIT 1";
	$qBaris		= mysql_query($q);
	$rBaris	 	= mysql_fetch_object($qBaris);
	$kdbaris	= $rBaris->kd_baris;
	$ketbaris	= $rBaris->ket_baris;
	$id			= $rBaris->id_baris;

	echo"
	<style type='text/css'>
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
	$(document).ready(function(){
		$('#form').validate();
	});
	</script>
		<div id='stylized' class='myform'>
		<form id='form' name='form' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
		<h1>Form data referensi baris</h1>
		<p>Form ini digunakan dalam melakukan perekaman/perubahan data referensi baris</p>
		<h3>Data Referensi Baris</h3>
		<p></p>
				
		<label>Kode Baris
		<span class='small'>Kode Baris</span>
		</label>
		<input type='text' id='kdbaris'name='kdbaris' minlength='1'  maxlength='5' value='$kdbaris' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'ketbaris')\" autofocus='autofocus' />

		<label>Keterangan Baris
		<span class='small'>Keterangan Baris</span>
		</label>
		<input type='text' id='ketbaris' name='ketbaris'  value='$ketbaris' minlength='2' maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
		
		
		<input type='hidden' name='id_baris' value='$id' />
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUbaris' />
		<div class='spacer'></div>
		</form>
		</div>";
}

// Modul Update Referensi Baris -----------------------------------------------------------------------------//
elseif($_POST['btnUbaris'] == 'Simpan')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	
	$id			= $_POST['id_baris'];
	$kdbaris	= strtoupper($_POST['kdbaris']);
	$ketbaris	= $_POST['ketbaris'];
	if($id == "")
	{
		$q		= "SELECT kd_baris FROM r_baris WHERE kd_baris LIKE '%$kdbaris%'";
		$qCek	= mysql_query($q);
		$rCek	= mysql_num_rows($qCek);
		if(!$rCek)
		{
			$q 		= "REPLACE r_baris SET kd_baris='$kdbaris',ket_baris='$ketbaris'";
			$qBaris = mysql_query($q);
		}
		else
		{
			echo "
			<div id='promptkonfirmasi' title='informasi'>
				<br />
				<center>
				<b><font color='#FFFFFF' size='4'>Data dengan kode baris $kdbaris tersebut sudah ada</font></b>
				<br />
				<br />
			</div>";
		}
	}
	else
	{
		$q		= "UPDATE r_baris SET kd_baris='$kdbaris',ket_baris='$ketbaris' WHERE id_baris='$id'";
		$qBaris = mysql_query($q);
	}
	
	echo "
	<script type='text/javascript'>
		setTimeout(
		function()
			{window.location.replace('media.php?module=referensibaris');},
			1500
		);
	</script>";
}

// Modul Hapus Referensi Baris -----------------------------------------------------------------------------//
elseif($_POST['btnHbaris'] == 'Hapus')
{
	$id			= $_POST['id'];
	$q			= "DELETE FROM r_baris WHERE id_baris='$id'";
	mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('media.php?module=referensibaris');
	</script>";
}





// Modul Referensi Box =================================================================================//
elseif($_GET['module'] == 'referensibox')
{
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<h1>Tabel Referensi Box</h1>
			<p>Tabel referensi box</p>
			</div>
			</form>
			
			<br />
			<br />
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='submit' name='btnEbox' value='Tambah Data' class='normaltablesubmit' style='width:100px !important;' />
			</form>
			<br />
			<div id='normaltable'>
				<table class='normaltable' width='100%'>
					<tr>
							<th width='5%'>No.</th>
							<th width='10%'>Kode Box</th>
							<th width='60%'>Keterangan Box</th>
							<th width='20%' colspan='2'>Tindakan</th>
					</tr>";
					$qBox	= mysql_query("SELECT * FROM r_box ORDER BY id_box DESC");
					$i	= 1;
					$oddcol			= "#CCFF99";
					$evencol		= "#CCDD88";
					while($rBox = mysql_fetch_object($qBox))
					{
						if($i % 2 == 0) {$color = $evencol;}
						else{$color = $oddcol;}
						$id			= $rBox->id_box;
						$kdbox		= $rBox->kd_box;
						$ketbox		= $rBox->ket_box;
						echo "
						<tr>
							<td>".$i."</td>
							<td>".$kdbox."</td>
							<td>".$ketbox."</td>
							<td>
								<form id='frm_rbox' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnEbox' value='Edit' class='normaltablesubmit' />
								</form>
							</td>
							<td>
								<form id='frm_rbox' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnHbox' value='Hapus' class='normaltablesubmit' />
								</form>
							</td>
						</tr>";
						$i++;
					}
				echo"
				</table>
			</div>";
}

// Modul Edit Referensi Box ------------------------------------------------------------------------------//
elseif($_POST['btnEbox'])
{
	
	$id_box		= $_POST['id'];
	$q			= "SELECT * FROM r_box WHERE id_box = '$id_box' LIMIT 1";
	$qBox		= mysql_query($q);
	$rBox	 	= mysql_fetch_object($qBox);
	$kdbox		= $rBox->kd_box;
	$ketbox		= $rBox->ket_box;
	$id			= $rBox->id_box;

	echo"
	<style type='text/css'>
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
	$(document).ready(function(){
		$('#form').validate();
	});
	</script>
		<div id='stylized' class='myform'>
		<form id='form' name='form' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
		<h1>Form data referensi box</h1>
		<p>Form ini digunakan dalam melakukan perekaman/perubahan data referensi box</p>
		<h3>Data Referensi Box</h3>
		<p></p>
				
		<label>Kode Box
		<span class='small'>Kode Box</span>
		</label>
		<input type='text' id='kdbox'name='kdbox' minlength='1'  maxlength='5' value='$kdbox' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'ketbox')\" autofocus='autofocus' />

		<label>Keterangan Box
		<span class='small'>Keterangan Box</span>
		</label>
		<input type='text' id='ketbox' name='ketbox'  value='$ketbox' minlength='2' maxlength='75' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
		
		
		<input type='hidden' name='id_box' value='$id' />
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUbox' />
		<div class='spacer'></div>
		</form>
		</div>";
}

// Modul Update Referensi Box -----------------------------------------------------------------------------//
elseif($_POST['btnUbox'] == 'Simpan')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	
	$id			= $_POST['id_box'];
	$kdbox		= strtoupper($_POST['kdbox']);
	$ketbox		= $_POST['ketbox'];
	if($id == "")
	{
		$q		= "SELECT kd_box FROM r_box WHERE kd_box LIKE '%$kdbox%'";
		$qCek	= mysql_query($q);
		$rCek	= mysql_num_rows($qCek);
		if(!$rCek)
		{
			$q 		= "REPLACE r_box SET kd_box='$kdbox',ket_box='$ketbox'";
			$qBox	= mysql_query($q);
		}
		else
		{
			echo "
			<div id='promptkonfirmasi' title='informasi'>
				<br />
				<center>
				<b><font color='#FFFFFF' size='4'>Data dengan kode box $kdbox tersebut sudah ada</font></b>
				<br />
				<br />
			</div>";
		}
	}
	else
	{
		$q		= "UPDATE r_box SET kd_box='$kdbox',ket_box='$ketbox' WHERE id_box='$id'";
		$qBox	= mysql_query($q);
	}
	
	echo "
	<script type='text/javascript'>
		setTimeout(
		function()
			{window.location.replace('media.php?module=referensibox');},
			1500
		);
	</script>";
}

// Modul Hapus Referensi Baris -----------------------------------------------------------------------------//
elseif($_POST['btnHbox'] == 'Hapus')
{
	$id			= $_POST['id'];
	$q			= "DELETE FROM r_box WHERE id_box='$id'";
	mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('media.php?module=referensibox');
	</script>";
}





// Modul Print Label Arsip ===================================================================================//
elseif($_GET['module']=='printlabelarsip'){
	
}

// Modul Monitoring 1 Jam SP2D ===============================================================================//
elseif($_GET['module']=='monitoring1jamsp2d'){
	include_once("config/koneksisp2d.php");
	echo "<div id='stylizedtable' class='mytable'>
			<h1>Form monitoring 1 jam penerbitan SP2D</h1> 
			<p>Tayangan</p>
			<div id='stylizedtablesp2d'>	
			<script type='text/javascript'>
			setTimeout('location.reload();',30000);
			</script>
			<table name='monitoring1jam' cellpadding='2' cellspacing='2'>
			<tr>	
			<th width='12%'>Satker</th>
			<th width='12%'>No.SPM</th>
			<th width='12%'>No.SP2D</th>
			<th width='20%'>Harus Selesai</th>
			<th width='26%'>Proses</th>
			<th width='14%'>Sisa Waktu</th>
			<tr>
			<tr>
			<td bgcolor='#dbeeb8' colspan='6'></td>	
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>";
	require_once(dirname(__FILE__) . '/config/koneksisp2d.php');
	$qMon	= mysql_query("SELECT DISTINCT kdsatker,nospm,nosp2d,tgslssp2d,kdstaspm,timediff(tgslssp2d,now()) as selisih FROM d_spmind WHERE date(tgsp2d)=date(now()) AND kdjenspm>'04' AND kdstaspm<'4' ORDER BY selisih,kdstaspm ASC");
	while($rMon	= mysql_fetch_array($qMon)){
		$kdsatker	= $rMon['kdsatker'];
		$nospm		= $rMon['nospm'];
		$nosp2d		= $rMon['nosp2d'];
		$kdstaspm	= $rMon['kdstaspm'];
		$slssp2d		= $rMon['tgslssp2d'];
		$selisih		= $rMon['selisih'];

		echo "
				<tr class='sp2d'>
				<td>$kdsatker</td>
				<td>$nospm</td>
				<td><font color='#CC33FF'><b>$nosp2d</b></font></td>
				<td>$slssp2d</td>
				<td>"; 
		switch($kdstaspm){
			case "1":
				echo "<font color='#FF0000'><b>Ctk Td Terima</b></font>";
				break;
			case "2":
				echo "<font color='#FFCC00'><b>Proses SP2D</b></font>";
				break;
			case "3":
				echo "<font color='#33FFCC'><b>Net SP2D</b></font>";
				break;
			default:
				echo "<font color='#00CCFF'><b>Cetak Advis</b></font>";
		} 
		echo "</td>
				<td>";
		switch($selisih){
			case $selisih<='00:00:00':
				echo "<font color='#FF0000'><b>$selisih</b></font>";
				break;
			case $selisih<='00:15:00':
				echo "<font color='#FF6600'><b>$selisih</b></font>";
				break;
			case $selisih>='00:16:00':
				echo "<font color='#33FFFF'><b>$selisih</b></font>";
		}
		echo "</td>
				</tr>";
	}
	echo"</table>
			</div>
			</div>";	
	}
	
// Modul Rekam News Ticker ===================================================================================//
elseif($_GET['module']=='rekamnewsticker'){
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Tabel News Ticker</h1>
			<p>Tabel News Ticker ini akan digunakan pada tampilan webservice</p>
			</div>
			</form>
			
			<br />
			<br />
			<div id='normaltable'>
			<table class='normaltable' width='100%'>
			<tr>
					<th width='10%'>No.</th>
					<th width='70%'>Tampilan</th>
					<th width='20%'>Tindakan</th>
			</tr>";
			// koneksi ke sp2d
			require_once(dirname(__FILE__) . '/config/koneksisp2d.php');
			$qNews		= mysql_query("SELECT * FROM t_newsticker ORDER BY idnews,news");
			$no	=1;
			$oddcol		= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rNews	= mysql_fetch_row($qNews)){
			if($no % 2 == 0) {$color = $evencol;}
			else{$color = $oddcol;}
			echo "<tr bgcolor='$color'>
					<td>$no</td>
					<td>$rNews[1]</td>
					<td>
						<form method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
						<input type='hidden' name='idnews' value='$rNews[0]' />
						<input type='submit' class='normaltablesubmit' name='hapusnewsticker' value='Hapus' />
						</form>
					</td>
				</tr>";
				$no++;
			}
			echo "</table>
			</div>
			<div id='spacer'></div>
			<br />
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' class='normaltablesubmit' name='tambahnewsticker' value='Tambah' />
			</form>";
}

// Modul form rekam newsticker ---------------------------------------------------------------------------------------//

elseif($_POST['tambahnewsticker']=='Tambah'){
		echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
			</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
			});
  			</script>
			<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form perekaman newsticker</h1>
			<p>Perekaman pada newsticker ini akan ditampilkan pada webservice</p>
					<label>Berita
					<span class='small'>Isikan berita yang akan ditampilkan pada web service</span>
					</label>
					<textarea id='news' class='required' name='news' cols='4' rows='5' maxlength='175' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'submit')\"></textarea>
	
					
					<input type='submit' value='Rekam' class='button' id='submit' name='Insertnews' />
					<div class='spacer'></div>
			</form>
		</div>";
	}

// Modul Insert News --------------------------------------------------------------------------------------------------//
elseif($_POST['Insertnews']=='Rekam'){
	$news	= $_POST['news'];
	// koneksi ke database sp2d 
	require_once(dirname(__FILE__) . '/config/koneksisp2d.php');
		// Insert data
		mysql_query("INSERT INTO t_newsticker(news)
							VALUES('$news')");
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Perekaman Newsticker'>
			<center><b>Newsticker dengan berita: <font color='#ffff00'><i>" . $news . "</i></font> berhasil direkam</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
			</form>";
	}
// Modul Hapus News --------------------------------------------------------------------------------------------------//
elseif($_POST['hapusnewsticker']=='Hapus'){
	$idnews	= $_POST['idnews'];
	// koneksi ke database sp2d 
	require_once(dirname(__FILE__) . '/config/koneksisp2d.php');
		// Insert data
		mysql_query("DELETE FROM t_newsticker
							WHERE idnews='$idnews'");
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
		</script>
			<div id='promptkonfirmasi' title='Konfirmasi Penghapusan Newsticker'>
			<center><b>Newsticker dengan id: <font color='#ffff00'><i>" . $idnews . "</i></font> berhasil dihapus</b></center>
			<br />
			<br />
			<table border='0' align='center'>
			<form name='form1' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
				<tr><td><input type='submit' name='konfirmasirekam' value='Kembali'  /></td>
			</form>";
	}

// Modul Upload Logo Kementerian ===================================================================================//
elseif($_GET['module']=='uploadlogo'){
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' enctype='multipart/form-data' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form Upload Logo Kementerian</h1>
			<p>Form ini akan digunakan untuk upload logo kementerian pada tampilan webservice</p>
			
			<label>File Upload
			<span class='small'>Upload logo direkomendasikan dengan ekstensi .png 210 s.d. 225 px format nama kode kementerian 3 digit</span>
			</label>
			<input type='file' id='file' name='file' readonly='readonly' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
			<input type='submit' value='Upload' class='button' id='submit' name='Uploadlogo' />
			<br />	
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<div id='spacer'></div>
			</form>
			</div>";
}

// Insert/upload logo
elseif($_POST['Uploadlogo'] == 'Upload'){

	$lokasi_file	=$_FILES['file']['tmp_name'];
	$nama_file		=$_FILES['file']['name'];
	// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
	$direktori	= dirname(dirname(__FILE__)) . '/display/logo/'.basename($nama_file);
	move_uploaded_file($lokasi_file,$direktori);
	echo "<script type='text/javascript'>
				alert('Logo kementerian berhasil di-upload $direktori');
				window.location.replace('media.php?module=uploadlogo');
			</script>";
}

// Referensi KPPN ================================================================================//
elseif($_GET['module'] == 'referensikppn')
{
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Tabel Referensi KPPN</h1>
			<p>Tabel referensi KPPN digunakan untuk menetapkan default KPPN</p>
			</div>
			</form>
			
			<br />
			<br />
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='submit' name='btnEkppn' value='Tambah Data' />
			</form>
			<br />
			<div id='normaltable'>
				<table class='normaltable' width='100%'>
					<tr>
							<th width='5%'>No.</th>
							<th width='10%'>Kode KPPN</th>
							<th width='5%'>Kode Kanwil</th>
							<th width='20%'>Nama KPPN</th>
							<th width='45%'>Alamat KPPN</th>
							<th width='5%' colspan='2'>Default</th>
							<th width='10%' colspan='2'>Tindakan</th>
					</tr>";
					$qKppn	= mysql_query("SELECT kdkppn,kdkanwil,nmkppn,almkppn,kddefa FROM t_kppn ORDER BY kddefa DESC,kdkppn");
					$i	= 1;
					$kdkppn	= array('kdkppn');
					$oddcol			= "#CCFF99";
					$evencol		= "#CCDD88";
					while($rKppn = mysql_fetch_object($qKppn))
					{
						if($i % 2 == 0) {$color = $evencol;}
						else{$color = $oddcol;}
						$kdkppn		= $rKppn->kdkppn;
						$kdkanwil	= $rKppn->kdkanwil;
						$nmkppn		= $rKppn->nmkppn;
						$almkppn	= strtoupper($rKppn->almkppn);
						$kddefa		= $rKppn->kddefa;
						$Kddefa		= "unchecked";
						echo "
						<tr>
							<td>".$i."</td>
							<td>".$kdkppn."</td>
							<td>$kdkanwil</td>
							<td>KPPN ".$nmkppn."</td>
							<td>$almkppn</td> 
							<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
							<td>
								<input type='hidden' name='kdkppn' value='$kdkppn' />
								<input type='radio' name='kddefa' value=1 $Kddefa />
							</td>
							<td>
								<input type='submit' name='btnDefakppn' value='Simpan' class='normaltablesubmit' />
							</td>
							</form>
							<td>
								<form id='frm_rsatker' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='kdkppn' value='".$kdkppn."' />
								<input type='submit' name='btnEkppn' value='Edit' class='normaltablesubmit' />
								</form>
							</td>
							<td>
								<form id='frm_rsatker' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='kdkppn' value='".$kdkppn."' />
								<input type='submit' name='btnHkppn' value='Hapus' class='normaltablesubmit' />
								</form>
							</td>
						</tr>";
						$i++;
					}
				echo"
				</table>
			</div>";
}
// Default Referensi KPPN -------------------------------------------------------------------------//
elseif($_POST['btnDefakppn'] == 'Simpan')
{
	$kddefa 	= $_POST['kddefa'];
	$kdkppn		= $_POST['kdkppn'];
	$qKppn		= mysql_query("SELECT kdkanwil FROM t_kppn WHERE kdkppn='$kdkppn'");
	$rKppn		= mysql_fetch_object($qKppn);
	$kdkanwil	= $rKppn->kdkanwil;
	$qKanwil	= mysql_query("SELECT kdkanwil FROM t_kanwil WHERE kdkanwil='$kdkanwil'");
	$rKanwil	= mysql_num_rows($qKanwil);
	// Checking existence kdkanwil
	if($rKanwil == 0)
	{
		echo "
		<script type='text/javascript'>
			alert('Penetapan default tidak dapat dilakukan melalui tombol Default Simpan karena referensi kanwil untuk KPPN ini belum ada, lakukan melalui tombol Edit Simpan');
			window.location.replace('media.php?module=referensikppn');
		</script>";
	}
	else
	{
		if($kddefa == 1)
		{
			mysql_query("UPDATE t_kppn SET kddefa=1 WHERE kdkppn='$kdkppn'");
			mysql_query("UPDATE t_kppn SET kddefa=0 WHERE kdkppn!='$kdkppn'");
			mysql_query("UPDATE t_kanwil SET aktif=1 WHERE kdkanwil='$kdkanwil'");
			mysql_query("UPDATE t_kanwil SET aktif=0 WHERE kdkanwil!='$kdkanwil'");
			echo "
				<script type='text/javascript'>
					alert('Kode default KPPN dengan kode KPPN $kdkppn berhasil disimpan');
					window.location.replace('media.php?module=referensikppn');
				</script>";
		}
		else
		{
			$kddefa = 0;
			echo "
				<script type='text/javascript'>
					window.location.replace('media.php?module=referensikppn');
				</script>";
		}
	}
}
// Form Edit Referensi KPPN -------------------------------------------------------------------------//
elseif($_POST['btnEkppn'])
{
	$kdkppn	= $_POST['kdkppn'];
	$q		= "SELECT a.kdkppn,a.kdkanwil,a.kddatidua,a.kdlokasi,a.nmkppn,a.almkppn,a.telkppn,a.kotakppn,a.kddefa,a.email,a.kodepos,a.faxkppn,a.website,a.smsgateway,b.nmkanwil,b.wpb,b.kp
	FROM t_kppn a LEFT JOIN t_kanwil b ON a.kdkanwil=b.kdkanwil WHERE a.kdkppn='$kdkppn' LIMIT 1";
	$qKppn	= mysql_query($q);
	$rKppn	= mysql_fetch_object($qKppn);
	$kdkanwil 	= $rKppn->kdkanwil;
	$kddatidua	= $rKppn->kddatidua;
	$kdlokasi	= $rKppn->kdlokasi;
	$nmkppn 	= $rKppn->nmkppn;
	$almkppn	= $rKppn->almkppn;
	$telkppn	= $rKppn->telkppn;
	$kotakppn	= $rKppn->kotakppn;
	$kddefa		= $rKppn->kddefa;
	$email		= $rKppn->email;
	$kodepos	= $rKppn->kodepos;
	$faxkppn	= $rKppn->faxkppn;
	$website	= $rKppn->website;
	$smsgateway = $rKppn->smsgateway;
	$nmkanwil	= $rKppn->nmkanwil;
	$wpb		= $rKppn->wpb;
	$kp			= $rKppn->kp;
	echo"
	<style type='text/css'>
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
	$(document).ready(function(){
		$('#form').validate();
	});
	</script>
		<div id='stylized' class='myform'>
		<form id='form' name='form' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
		<h1>Form data referensi KPPN - Kanwil - Surat</h1>
		<p>Form ini digunakan dalam melakukan perekaman/perubahan data referensi KPPN, Kanwil, Surat</p>
		<h3>Data Referensi KPPN</h3>
		<p></p>
				
		<label>Kode KPPN
		<span class='small'>Kode KPPN</span>
		</label>
		<input type='text' id='kdkppn' minlength='3' name='kdkppn' maxlength='3' value='$kdkppn' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'kdkanwil')\" />

		<label>Kode Kanwil
		<span class='small'>Kode Kanwil</span>
		</label>
		<input type='text' id='kdkanwil' name='kdkanwil'  value='$kdkanwil' minlength='2' maxlength='2' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdlokasi')\" />
			
		<label>Kode Lokasi
		<span class='small'>Kode Lokasi</span>
		</label>
		<input type='text' id='kdlokasi' name='kdlokasi' value='$kdlokasi'  minlength='2' maxlength='2' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kddatidua')\" />
				
		<label>Kode Dati Dua
		<span class='small'>Kode Dati Dua</span>
		</label>
		<input type='text' id='kddatidua' name='kddatidua'  value='$kddatidua'  minlength='2' maxlength='2' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nmkppn')\" />
	

		<label>Nama KPPN
		<span class='small'>Nama KPPN</span>
		</label>
		<input type='text' id='nmkppn' name='nmkppn' value='$nmkppn'  minlength='2' maxlength='35' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'almkppn')\" />
		
		<label>Alamat KPPN
		<span class='small'>Alamat KPPN</span>
		</label>
		<input type='text' id='almkppn' name='almkppn' value='$almkppn'  minlength='2' maxlength='35' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'telkppn')\" />
		
		<label>Telepon KPPN
		<span class='small'>Telepon KPPN</span>
		</label>
		<input type='text' id='telkppn' name='telkppn' value='$telkppn'  minlength='2' maxlength='70' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'faxkppn')\" />
				
		<label>Fax KPPN	
		<span class='small'>Fax KPPN</span>
		</label>
		<input type='text' id='faxkppn' name='faxkppn' value='$faxkppn'  minlength='2' maxlength='70' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kotakppn')\" />
							
		<label>Kota KPPN	
		<span class='small'>Kota KPPN</span>
		</label>
		<input type='text' id='kotakppn' name='kotakppn' value='$kotakppn'  minlength='2' maxlength='35' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kodepos')\" />
						
		<label>Kode Pos	
		<span class='small'>Kode Pos</span>
		</label>
		<input type='text' id='kodepos' name='kodepos' value='$kodepos'  minlength='2' maxlength='5' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'email')\" />
						
		<label>Email	
		<span class='small'>Email</span>
		</label>
		<input type='text' id='email' name='email' value='$email'  minlength='2' maxlength='35' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kodepos')\" />	
		
		<label>Website
		<span class='small'>Website</span>
		</label>
		<input type='text' id='website' name='website' value='$website'  minlength='2' maxlength='30' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'smsgateway')\" />
							
		<label>SMS Gateway
		<span class='small'>SMS Gateway</span>
		</label>
		<input type='text' id='smsgateway' name='smsgateway' value='$smsgateway'  minlength='2' maxlength='20' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kddefa1')\" />
		
		<label>Default KPPN
		<span class='small'>Default KPPN</span>
		</label>
		<div class='radio'>
			<input type='radio' id='kddefa1' name='kddefa' value='1' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nmkanwil')\" checked='checked' />&nbsp;Ya
		</div>
		<div class='radio'>
			<input type='radio' id='kddefa2' name='kddefa' value='0' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nmkanwil')\" />&nbsp;Tidak
		</div>
		
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<p></p>
			<h3>Data Referensi Kanwil</h3>
		<p></p>
							
		<label>Nama Kanwil
		<span class='small'>Nama Kanwil</span>
		</label>
		<input type='text' id='nmkanwil' name='nmkanwil' value='$nmkanwil'  minlength='2' maxlength='105' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'wpb')\" />
		
		<br /><br /><br />
		<p></p>
			<h3>Data Referensi Surat</h3>
		<p></p>
					
		<label>Referensi WPB
		<span class='small'>Nomor WPB</span>
		</label>
		<input type='text' id='wpb' name='wpb' value='$wpb'  minlength='2' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kp')\" />
							
		<label>Referensi KP
		<span class='small'>Nomor KP</span>
		</label>
		<input type='text' id='kp' name='kp' value='$kp'  minlength='2' maxlength='4' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
				
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUkppn' />
		<div class='spacer'></div>
		</form>
		</div>";
}

// Update Referensi KPPN ------------------------------------------------------------------------//
elseif($_POST['btnUkppn'])
{
	$kdkppn		= $_POST['kdkppn'];
	$kdkanwil 	= $_POST['kdkanwil'];
	$kddatidua	= $_POST['kddatidua'];
	$kdlokasi	= $_POST['kdlokasi'];
	$nmkppn 	= strtoupper($_POST['nmkppn']);
	$almkppn	= $_POST['almkppn'];
	$telkppn	= $_POST['telkppn'];
	$kotakppn	= $_POST['kotakppn'];
	$email		= $_POST['email'];
	$kodepos	= $_POST['kodepos'];
	$faxkppn	= $_POST['faxkppn'];
	$website	= $_POST['website'];
	$smsgateway = $_POST['smsgateway'];
	$Kddefa		= $_POST['kddefa'];
	$kddefa		= (int) $Kddefa;
	$nmkanwil	= strtoupper($_POST['nmkanwil']);
	$wpb		= $_POST['wpb'];
	$kp			= $_POST['kp'];
	// kddefa = 1
	if($kddefa == 1)
	{
		// Cek t_kppn existence
		$qCekkppn	= mysql_query("SELECT kdkppn FROM t_kppn WHERE kdkppn='$kdkppn' LIMIT 1");
		$rCekkppn	= mysql_num_rows($qCekkppn);
		
		if($rCekkppn == 0)
		{
			// Replace t_kppn where not found kdkppn
			$qKppn		= "REPLACE t_kppn SET kdkppn='$kdkppn',kdkanwil='$kdkanwil',kddatidua='$kddatidua',kdlokasi='$kdlokasi',nmkppn='$nmkppn',almkppn='$almkppn',telkppn='$telkppn',kotakppn='$kotakppn',email='$email',kodepos='$kodepos',faxkppn='$faxkppn',website='$website',smsgateway='$smsgateway',kddefa='$kddefa'";
			mysql_query($qKppn);
			// Update t_kppn where kdkppn != '$kdkppn'
			$qNotkppn	= "UPDATE t_kppn SET kddefa='0' WHERE kdkppn!='$kdkppn'";
			mysql_query($qNotkppn);
			
			// Cek t_kanwil existence
			$qCekkanwil	= mysql_query("SELECT kdkanwil FROM t_kanwil WHERE kdkanwil='$kdkanwil'");
			$rCekkanwil	= mysql_num_rows($qCekkanwil);
			if($rCekkanwil == 0)
			{
				// Replace t_kanwil 
				$qKanwil	= "REPLACE t_kanwil SET kdkanwil='$kdkanwil',nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='1',wpb='$wpb',kp='$kp'";
				mysql_query($qKanwil);
				// Update t_kanwil aktif
				$qNotKanwil = "UPDATE t_kanwil SET aktif='0' WHERE kdkanwil!='$kdkanwil'";
				mysql_query($qNotKanwil);
			}
			else
			{
				// Update t_kanwil where kdkanwil='$kdkanwil'
				$qKanwil	= "UPDATE t_kanwil SET nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='1',wpb='$wpb',kp='$kp' WHERE kdkanwil='$kdkanwil'";
				mysql_query($qKanwil);
				// Update t_kanwil aktif
				$qNotKanwil = "UPDATE t_kanwil SET aktif='0' WHERE kdkanwil!='$kdkanwil'";
				mysql_query($qNotKanwil);
			}
		}
		else
		{
			// Update t_kppn where kdkppn='$kdkppn'
			$qKppn		= "UPDATE t_kppn SET kdkanwil='$kdkanwil',kddatidua='$kddatidua',kdlokasi='$kdlokasi',nmkppn='$nmkppn',almkppn='$almkppn',telkppn='$telkppn',kotakppn='$kotakppn',email='$email',kodepos='$kodepos',faxkppn='$faxkppn',website='$website',smsgateway='$smsgateway',kddefa='$kddefa'
			WHERE kdkppn='$kdkppn'";
			mysql_query($qKppn);
			// Update t_kppn where kdkppn != '$kdkppn'
			$qNotkppn	= "UPDATE t_kppn SET kddefa='0' WHERE kdkppn!='$kdkppn'";
			mysql_query($qNotkppn);
			
			// Cek t_kanwil existence
			$qCekkanwil	= mysql_query("SELECT kdkanwil FROM t_kanwil WHERE kdkanwil='$kdkanwil'");
			$rCekkanwil	= mysql_num_rows($qCekkanwil);
			if($rCekkanwil == 0)
			{
				// Replace t_kanwil 
				$qKanwil	= "REPLACE t_kanwil SET kdkanwil='$kdkanwil',nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='1',wpb='$wpb',kp='$kp'";
				mysql_query($qKanwil);
				// Update t_kanwil aktif
				$qNotKanwil = "UPDATE t_kanwil SET aktif='0' WHERE kdkanwil!='$kdkanwil'";
				mysql_query($qNotKanwil);
			}
			else
			{
				// Update t_kanwil where kdkanwil='$kdkanwil'
				$qKanwil	= "UPDATE t_kanwil SET nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='1',wpb='$wpb',kp='$kp' WHERE kdkanwil='$kdkanwil'";
				mysql_query($qKanwil);
				// Update t_kanwil aktif
				$qNotKanwil = "UPDATE t_kanwil SET aktif='0' WHERE kdkanwil!='$kdkanwil'";
				mysql_query($qNotKanwil);
			}
		}
		echo"
			<script type='text/javascript'>
				alert('Update data referensi berhasil dilakukan');
				window.location.replace('media.php?module=referensikppn');
			</script>";
	}
	// kddefa = 0
	elseif($kddefa == 0)
	{
		// Cek t_kppn existence
		$qCekkppn	= mysql_query("SELECT kdkppn FROM t_kppn WHERE kdkppn='$kdkppn' LIMIT 1");
		$rCekkppn	= mysql_num_rows($qCekkppn);
		
		if($rCekkppn == 0)
		{
			// Replace t_kppn where not found kdkppn
			$qKppn		= "REPLACE t_kppn SET kdkppn='$kdkppn',kdkanwil='$kdkanwil',kddatidua='$kddatidua',kdlokasi='$kdlokasi',nmkppn='$nmkppn',almkppn='$almkppn',telkppn='$telkppn',kotakppn='$kotakppn',email='$email',kodepos='$kodepos',faxkppn='$faxkppn',website='$website',smsgateway='$smsgateway',kddefa='$kddefa'";
			mysql_query($qKppn);
			
			// Cek t_kanwil existence
			$qCekkanwil	= mysql_query("SELECT kdkanwil FROM t_kanwil WHERE kdkanwil='$kdkanwil'");
			$rCekkanwil	= mysql_num_rows($qCekkanwil);
			if($rCekkanwil == 0)
			{
				// Replace t_kanwil 
				$qKanwil	= "REPLACE t_kanwil SET kdkanwil='$kdkanwil',nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='0',wpb='$wpb',kp='$kp'";
				mysql_query($qKanwil);
			}
			else
			{
				// Update t_kanwil where kdkanwil='$kdkanwil'
				$qKanwil	= "UPDATE t_kanwil SET nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='0',wpb='$wpb',kp='$kp' WHERE kdkanwil='$kdkanwil'";
				mysql_query($qKanwil);
			}
		}
		else
		{
			$qKppn		= "UPDATE t_kppn SET kdkanwil='$kdkanwil',kddatidua='$kddatidua',kdlokasi='$kdlokasi',nmkppn='$nmkppn',almkppn='$almkppn',telkppn='$telkppn',kotakppn='$kotakppn',email='$email',kodepos='$kodepos',faxkppn='$faxkppn',website='$website',smsgateway='$smsgateway',kddefa='$kddefa'
			WHERE kdkppn='$kdkppn'";
			mysql_query($qKppn);
			
			// Cek t_kanwil existence
			$qCekkanwil	= mysql_query("SELECT kdkanwil FROM t_kanwil WHERE kdkanwil='$kdkanwil'");
			$rCekkanwil	= mysql_num_rows($qCekkanwil);
			if($rCekkanwil == 0)
			{
				// Replace t_kanwil 
				$qKanwil	= "REPLACE t_kanwil SET kdkanwil='$kdkanwil',nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='0',wpb='$wpb',kp='$kp'";
				mysql_query($qKanwil);
			}
			else
			{
				// Update t_kanwil where kdkanwil='$kdkanwil'
				$qKanwil	= "UPDATE t_kanwil SET nmkanwil='$nmkanwil',kdlokasi='$kdlokasi',aktif='0',wpb='$wpb',kp='$kp' WHERE kdkanwil='$kdkanwil'";
				mysql_query($qKanwil);
			}	
		}
		// Checking existence of kddefa=1
			$qCek		= mysql_query("SELECT kddefa FROM t_kppn WHERE kddefa=1 LIMIT 1");
			$rCek		= mysql_num_rows($qCek);
			if($rCek == 0)
			{
				echo "<script type='text/javascript'>
					alert('Dengan mengubah kode default KPPN, maka data referensi KPPN default belum ditetapkan, silakan pilih default KPPN');
					window.location.replace('media.php?module=referensikppn');
				</script>";
			}
			else
			{
				echo"
				<script type='text/javascript'>
					alert('Update data referensi berhasil dilakukan');
					window.location.replace('media.php?module=referensikppn');
				</script>";
			}
	}
}
// Hapus Referensi KPPN -------------------------------------------------------------------------//
elseif($_POST['btnHkppn'] == 'Hapus')
{
	$kdkppn	= $_POST['kdkppn'];
	// Delete t_kppn where kdkppn='$kdkppn'
	$qKppn	= "DELETE FROM t_kppn WHERE kdkppn='$kdkppn'";
	mysql_query($qKppn);
	
	echo "
	<script type='text/javascript'>
		alert('Data referensi KPPN $kdkppn berhasil dihapus');
		window.location.replace('media.php?module=referensikppn');
	</script>";
}

// Referensi Pejabat ================================================================================//
elseif($_GET['module'] == 'referensipejabat')
{
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
			<h1>Tabel Referensi Pejabat</h1>
			<p>Tabel referensi Pejabat - Non aktifkan terlebih dahulu pejabat yang sama</p>
			</div>
			</form>
			
			<br />
			<br />
			<form method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
				<input type='submit' name='btnEpejabat' value='Tambah Data' class='normaltablesubmit' style='width:100px !important;' />
			</form>
			<br />
			<div id='normaltable'>
				<table class='normaltable' width='100%'>
					<tr>
							<th width='5%'>No.</th>
							<th width='20%'>Nama</th>
							<th width='5%'>NIP</th>
							<th width='20%'>Pangkat/Gol.</th>
							<th width='40%'>Jabatan</th>
							<th width='5%'>Ket.Jabatan</th>
							<th width='10%' colspan='2'>Tindakan</th>
					</tr>";
					$qPejabat	= mysql_query("SELECT a.id_pejabat,a.nama,a.nip,a.kdgol,a.nmjabatan,a.ketjabatan,b.nmgol,b.pangkat FROM t_pejabt a LEFT JOIN t_gol b ON a.kdgol=b.kdgol ORDER BY a.ketjabatan");
					$i	= 1;
					$oddcol			= "#CCFF99";
					$evencol		= "#CCDD88";
					while($rPejabat = mysql_fetch_object($qPejabat))
					{
						if($i % 2 == 0) {$color = $evencol;}
						else{$color = $oddcol;}
						$id			= $rPejabat->id_pejabat;
						$nama		= $rPejabat->nama;
						$nip		= $rPejabat->nip;
						$kdgol		= $rPejabat->kdgol;
						$nmjabatan	= $rPejabat->nmjabatan;
						$ketjabatan	= $rPejabat->ketjabatan;
						$nmgol		= strtoupper($rPejabat->nmgol);
						$pangkat	= strtoupper($rPejabat->pangkat);
						echo "
						<tr>
							<td>".$i."</td>
							<td>".$nama."</td>
							<td>".$nip."</td>
							<td>".$pangkat." / ".$nmgol."</td>
							<td>".$nmjabatan."</td> 
							<td>".$ketjabatan."</td> 
							<td>
								<form id='frm_rpejabat' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnEpejabat' value='Edit' class='normaltablesubmit' />
								</form>
							</td>
							<td>
								<form id='frm_rpejabat' method='post' action='".htmlentities($_SERVER['PHP_SELF'])."'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='btnHpejabat' value='Hapus' class='normaltablesubmit' />
								</form>
							</td>
						</tr>";
						$i++;
					}
				echo"
				</table>
			</div>";
}

// Form Edit Pejabat -----------------------------------------------------------------------------//
elseif($_POST['btnEpejabat'])
{
	$id 		= $_POST['id'];
	$q			= "SELECT id_pejabat,nip,nama,kdgol,nmjabatan,ketjabatan FROM t_pejabt WHERE id_pejabat = '$id' LIMIT 1";
	$qPejabat 	= mysql_query($q);
	$rPejabat 	= mysql_fetch_object($qPejabat);
	$id			= $rPejabat->id_pejabat;
	$nip		= $rPejabat->nip;
	$nama		= $rPejabat->nama;
	$kdgol		= $rPejabat->kdgol;
	$nmjabatan	= $rPejabat->nmjabatan;
	$ketjabatan	= $rPejabat->ketjabatan;
	echo"
	<style type='text/css'>
		em { font-weight: bold; padding-right: 1em; vertical-align: top; }
	</style>
	<script>
	$(document).ready(function(){
		$('#form').validate();
	});
	</script>
		<div id='stylized' class='myform'>
		<form id='form' name='form' method='post' enctype='multipart/form-data' action='".htmlentities($_SERVER['PHP_SELF'])."'>
		<h1>Form data referensi Pejabat</h1>
		<p>Form ini digunakan dalam melakukan perekaman/perubahan data referensi Pejabat</p>
		<h3>Data Referensi Pejabat</h3>
		<p></p>
				
		<label>Nama
		<span class='small'>Nama Pejabat</span>
		</label>
		<input type='text' id='nama' minlength='3' name='nama' maxlength='50' value='$nama' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'nip')\" />

		<label>NIP
		<span class='small'>NIP</span>
		</label>
		<input type='text' id='nip' name='nip'  value='$nip' minlength='9' maxlength='18' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdgol')\" />
			
		<label>Pangkat/Golongan
		<span class='small'>Pangkat/Golongan</span>
		</label>
			<select name='kdgol' id='kdgol' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'ketjabatan')\" />";
			$q 		= "SELECT * FROM t_gol ORDER BY kdgol";
			$qGol	= mysql_query($q);
			while($rGol	= mysql_fetch_object($qGol))
			{
				$kdgolongan 	= $rGol->kdgol;
				$nmgol			= $rGol->nmgol;
				$pangkat		= $rGol->pangkat;
				if($kdgol == $kdgolongan)
				{
					echo "<option value='$kdgolongan' selected='selected'>".$pangkat." / ".$nmgol."</option>";
				}
				else
				{
					echo "<option value='$kdgolongan'>".$pangkat." / ".$nmgol."</option>";
				}
			}		
		echo "
			</select>
				
		<label>Jabatan
		<span class='small'>Jabatan</span>
		</label>
		<select name='ketjabatan' id='ketjabatan' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'definitif')\" />
			<option value='' selected='selected'>--Pilih Jabatan--</option>
			<option value='20'>Non Aktif</option>
			<option value='0'>Kepala Kantor</option>
			<option value='1'>Kasi Pencairan Dana</option>
			<option value='2'>Kasi Verifikasi & Akuntansi</option>
			<option value='6'>Kasi Bank Giro Pos</option>
			<option value='3'>Kasubag Umum</option>
		</select>
		
		<label>Definitif/Pjs.
		<span class='small'>Definitif/Pjs.</span>
		</label>
		<select name='definitif' id='definitif' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			<option value='' selected='selected'>--Pilih Jabatan--</option>
			<option value='definitif'>Definitif</option>
			<option value='pjs'>Pejabat Sementara</option>
		</select>
		
		
		<input type='hidden' name='id' value='$id' />
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUpejabat' />
		<div class='spacer'></div>
		</form>
		</div>";
}
// Update Referensi Pejabat ----------------------------------------------------------------------//
elseif($_POST['btnUpejabat'])
{
	$id			= $_POST['id'];
	$nama		= strtoupper($_POST['nama']);
	$nip		= $_POST['nip'];
	$kdgol		= $_POST['kdgol'];
	$ketjabatan = $_POST['ketjabatan'];
	$definitif	= $_POST['definitif'];
	/*---------------------------------
	 * Nama Jabatan
	 * 0 = Kepala Kantor
	 * 1 = Kasi Pencairan Dana
	 * 2 = Kasi Verifikasi & Akuntansi
	 * 3 = Kasubag Umum
	 * 6 = Kasi Bank Giro Pos
	 * 20 = Non Aktif
	 * -------------------------------*/
	// Definitif
	if($definitif == "definitif")
	{
		switch($ketjabatan)
			{
				case "0":
				$nmjabatan = strtoupper("Kepala Kantor");
				break;
				case "1":
				$nmjabatan = strtoupper("Kasi Pencairan Dana");
				break;
				case "2":
				$nmjabatan = strtoupper("Kasi Verifikasi dan Akuntansi");
				break;
				case "3":
				$nmjabatan = strtoupper("Kasubag.Umum");
				break;
				case "6":
				$nmjabatan = strtoupper("Kasi Bank Giro Pos");
				break;
				case "20":
				$nmjabatan = strtoupper("Non Aktif");
				break;
			}
	}
	else
	{
		// Pejabat Sementara
		switch($ketjabatan)
			{
				case "0":
				$nmjabatan = strtoupper("Pjs.Kepala Kantor");
				break;
				case "1":
				$nmjabatan = strtoupper("Pjs.Kasi Pencairan Dana");
				break;
				case "2":
				$nmjabatan = strtoupper("Pjs.Kasi Verifikasi dan Akuntansi");
				break;
				case "3":
				$nmjabatan = strtoupper("Pjs.Kasubag.Umum");
				break;
				case "6":
				$nmjabatan = strtoupper("Pjs.Kasi Bank Giro Pos");
				break;
				case "20":
				$nmjabatan = strtoupper("Non Aktif");
				break;
			}
	}
	if($id == "")
	{
		$qPejabat	= "REPLACE t_pejabt SET nama='$nama',nip='$nip',kdgol='$kdgol',nmjabatan='$nmjabatan',ketjabatan='$ketjabatan'";
		mysql_query($qPejabat);
		$qNotpejabat= "UPDATE t_pejabt SET ketjabatan='20' WHERE ketjabatan='$ketjabatan' AND nip!='$nip'";
		mysql_query($qNotpejabat);
	}
	else
	{
		$qPejabat	= "UPDATE t_pejabt SET nama='$nama',nip='$nip',kdgol='$kdgol',nmjabatan='$nmjabatan',ketjabatan='$ketjabatan' WHERE id_pejabat='$id'";
		mysql_query($qPejabat);
		$qNotpejabat= "UPDATE t_pejabt SET ketjabatan='20' WHERE ketjabatan='$ketjabatan' AND nip!='$nip'";
		mysql_query($qNotpejabat);
	}
	echo "
		<script type='text/javascript'>
			window.location.replace('media.php?module=referensipejabat');
		</script>";
}

// Modul Hapus Pejabat --------------------------------------------------------------------------//
elseif($_POST['btnHpejabat'])
{
	$id			= $_POST['id'];
	$q 			= "DELETE FROM t_pejabt WHERE id_pejabat='$id'";
	$qPejabat	= mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('media.php?module=referensipejabat');
	</script>";
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
