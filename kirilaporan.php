<?php

// Modul Edit Monitoring Laporan ---------------------------------------------------------------------//
if($_GET['module'] == 'rekammonitoringlaporan')
{
	echo "<script type=\"text/javascript\">
				$(document).ready(function() {
					$('#tanggal').datepicker({
							changeMonth: true,
							changeYear: true
						});
					});
		</script>
		
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
		<h1>Form Perekaman atau Perubahan Monitoring Laporan</h1>
		<p>Form ini digunakan dalam melakukan perekaman atau pun perubahan monitoring laporan</p>
				
		<label>Nama Laporan
		<span class='small'>Nama laporan</span>
		</label>
			<select name='id_laporan' id='id_laporan' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'bulan')\" />";
				$q 			= "SELECT id_laporan,nama_laporan FROM r_laporan ORDER BY idseksi";
				$qLaporan	= mysql_query($q);
				while($rLaporan	= mysql_fetch_object($qLaporan))
				{
					$id_laporan			= $rLaporan->id_laporan;
					$laporan_dropdown   = $rLaporan->nama_laporan;
					if($laporan == $laporan_dropdown)
					{
						echo "<option value='$id_laporan' selected='selected'>".$laporan_dropdown."</option>";
					}
					else
					{
						echo "<option value='$id_laporan'>".$laporan_dropdown."</option>";
					}
				}		
			echo "
			</select>
		
		<label>Laporan Bulan
		<span class='small'>Periode bulan</span>
		</label>
			<select name='bulan' id='bulan' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tanggal')\" />";
				 
				 for ($i = 0; $i <= 11; ++$i) {
					$time = strtotime(sprintf('-%d months', $i));
					$value = date('m', $time);
					$label = date('F', $time);
					printf('<option value="%s">%s</option>', $value, $label);
				  }	
			echo "
			</select>
			
		<label>Tgl. Pembuatan Laporan
  		 			<span class='small'>Isikan tanggal pembuatan laporan</span>
					</label>  		 			
  		 			<input id=\"tanggal\" name=\"tgl_lap\" type=\"text\" onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
		<label>File Upload
			<span class='small'>Upload Laporan (Upload laporan sesuai kebutuhan)</span>
			</label>
			<input type='file' id='file' name='file'  onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
			
		<input type='submit' value='Simpan' class='button' id='submit' name='btnUpdateMonitoringLaporan' />
		<div class='spacer'></div>
		</form>
		</div>";
}

// Modul Update dan Insert Monitoring Laporan -----------------------------------------------------------------------//
elseif($_POST['btnUpdateMonitoringLaporan'] == 'Simpan')
{
	echo "<script type='text/javascript'>
			$(document).ready(function() {
				$('#promptkonfirmasi').dialog({
					modal: true
				});
			});
	</script>";	
	
	
	$id					= $_POST['id_laporan'];
	$bulan				= $_POST['bulan'];
	$user				= $_SESSION[namauser];
	$Tgl_Lap			= $_POST['tgl_lap'];
	$Tgl_lap			= explode("/",$Tgl_Lap);
	$tgl				= $Tgl_lap[0];
	$bln				= $Tgl_lap[1];
	$thn				= $Tgl_lap[2];
	$tgl_lap			= $thn."-".$bln."-".$tgl;
	$date_time_now		= date("Y-m-d H:i:s");
	
	// Mengecek apakah parameter tanggal laporan sudah terisi
	if($Tgl_Lap == ''){
		echo "<script type = 'text/javascript'>
			alert('Anda belum mengisi data tanggal pembuatan laporan');
			setTimeout(
			function(){
				window.location.replace('rekam-monitoring-laporan');
				},500
		);
		</script>";
	}else{
			$lokasi_file	= $_FILES['file']['tmp_name'];
			$nama_file		= $_FILES['file']['name'];
			// Setting untuk Unix/Linux, untuk windows silakan disesuaikan
			$direktori	= 'laporan/'.basename($nama_file);
			move_uploaded_file($lokasi_file,$direktori);
			
			$query = "UPDATE d_monitoring_laporan SET `$bulan` = '$date_time_now', `tgl_$bulan` = '$tgl_lap', `file_$bulan` = '$nama_file', `user_$bulan` = '$user' WHERE `id_laporan` = $id";
			
			mysql_query($query);
			
			echo "
			<script type='text/javascript'>
				setTimeout(
					function(){
						window.location.replace('rekam-monitoring-laporan');
						}
				);
			</script>";
			
	}
}
// Modul Hapus Referensi Laporan -------------------------------------------------------------------//
elseif($_POST['btnDeleteLaporan'] == 'Hapus')
{
	$id			= $_POST['id'];
	$q			= "DELETE FROM r_laporan WHERE id_laporan='$id'";
	mysql_query($q);
	echo "
	<script type='text/javascript'>
		window.location.replace('referensi-laporan');
	</script>";
}

// Modul Monitoring Laporan =========================================================================//
elseif($_GET['module'] == 'monitoringlaporan')
{
	echo "coba";
}
?>