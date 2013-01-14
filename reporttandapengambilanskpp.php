<!DOCTYPE html>
<head>
  <title>Report Tanda Terima SKPP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<?php
		 include "config/koneksi.php";
		 include "config/helper.php";
		 $helper			= new helper();
	     $username			= $_POST['username'];
	     $anskpp			= $_POST['anskpp'];
	     $id_skpp			= $_POST['idSkpp'];
	     $namapengambil		= $_POST['namapengambil'];
    	 $timezone 			= "Asia/Jakarta";
		 if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		 $datePengambilan	= date("Y-m-d H:i:s");
	
		 mysql_query("UPDATE d_skpp SET userloketum='$username',tgloketum='$datePengambilan',namapengambil='$namapengambil',tgpengambilanSKPP='$datePengambilan', statproses='7' WHERE id_skpp='$id_skpp'");
	
		 $qSkpp				= mysql_query("SELECT noskpp,tgskpp,nip,noagenda FROM d_skpp WHERE id_skpp='$id_skpp'");
		 $rSkpp				= mysql_fetch_object($qSkpp);
		 
		 $noskpp			= $rSkpp->noskpp;
		 $Tgskpp			= $rSkpp->tgskpp;
		 $tgskpp			= $helper->dateConvert($Tgskpp);
		 $nip				= $rSkpp->nip;
		 $noagenda			= $rSkpp->noagenda;
		 
		 $qKppn				= mysql_query("SELECT nmkppn FROM t_kppn WHERE kddefa=1");
		 $rKppn				= mysql_fetch_object($qKppn);
	?>
		<table align="center" border="0" width="80%" style="border-collapse:collapse;">
		<tr>
			<td>KEMENTERIAN KEUANGAN R.I.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>TANDA TERIMA SKPP</td>
		</tr>
		<tr>
			<td>DIREKTORAT JENDERAL PERBENDAHARAAN</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>KPPN <?php echo $rKppn->nmkppn; ?></td>
		</tr>
	</table>
	<hr width="85%" />
	<br />
	<table align="center" border="0" width="80%" style="border-collapse:collapse;">
			<tr>
				<th colspan='3' align="left">Tanda Terima Pengambilan Surat Keterangan Penghentian Pembayaran</th>
			</tr>
			<tr>
				<td>Nama SKPP</td>
				<td>:</td>
				<td> <?php echo $anskpp; ?></td>
			</tr>
			<tr>
				<td>No. Agenda</td>
				<td>:</td>
				<td> <?php echo $noagenda; ?> </td>
			</tr>
			<tr>
				<td>NIP/NIK</td>
				<td>:</td>
				<td> <?php echo $nip; ?></td>
			</tr>
			<tr>
				<td>No. SKPP</td>
				<td>:</td>
				<td> <?php echo $noskpp; ?></td>
			</tr>
			<tr>
				<td>Tgl. SKPP</td>
				<td>:</td>
				<td> <?php echo $tgskpp; ?></td>
			</tr>
			<tr><td colspan='3'>&nbsp;</td></tr>
			<tr>
					<td colspan='3' bgcolor="Silver"></td>
			</tr>
			<tr>
				<td colspan='3'>&nbsp;<br /></td>
			</tr>
			<tr>
				<td>Nama Petugas F.O.</td>
				<td>:</td>
				<td> <?php echo "$username"; ?></td>
			</tr>
			<tr>
				<td>Nama Pengambil SKPP</td>
				<td>:</td>
				<td> <?php echo "$namapengambil"; ?></td>
			</tr>
	</table>

</body>
</html>
