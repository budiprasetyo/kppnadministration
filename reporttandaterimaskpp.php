<html>
	<head>
		<meta/>
		<title>Report Tanda Terima SKPP</title>
	</head>
	<body>
	<?php
	include "config/koneksi.php";
	$noagenda	= $_POST['noagenda'];
	$kdjenskpp	= $_POST['kdjenskpp'];
	$kdgpp		= $_POST['kdgpp'];
	$noskpp		= $_POST['noskpp'];
	$tgskpp		= $_POST['tgskpp'];
	$staskpp	= $_POST['staskpp'];
	$anskpp		= $_POST['anskpp'];
	$nip		= $_POST['nip'];
	$pangkat	= $_POST['pangkat'];
	$alamat		= $_POST['alamat'];
	$kdsatker	= $_POST['kdsatker'];
	$tujuanskpp	= $_POST['tujuanskpp'];
	$kotatujuan	= $_POST['kotatujuan'];
	$username	= strtoupper($_POST['username']);
	$kppn		= strtoupper($_POST['kppn']);
	$Tgagdtrm	= $_POST['tgagdtrm'];
	$TgAgdtrm	= explode("-",$Tgagdtrm);
	$Thtrm		= $TgAgdtrm[0];
	$Bltrm		= $TgAgdtrm[1];
	$Tgtrm		= $TgAgdtrm[2];
	$tgagdtrm	= $Tgtrm.'-'.$Bltrm.'-'.$Thtrm;
	
	$tgagdsls	= $_POST['tgagdsls'];
	$Tgsls		= explode("-",$tgagdsls);
	$ThSls		= $Tgsls[0];
	$BlSls		= $Tgsls[1];
	$TgSls		= $Tgsls[2];
	$tgsls		= $TgSls.'-'.$BlSls.'-'.$ThSls;
	
	$qnmsatker	= mysql_query("SELECT nmsatker FROM t_satker WHERE kdsatker='$kdsatker'")or die(mysql_error());
	$rnmsatker	= mysql_fetch_row($qnmsatker); 
	$nmsatker	= $rnmsatker[0];
	?>
	<table align="center" border="0" width="80%">
		<tr>
			<td>KEMENTERIAN KEUANGAN R.I.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>TANDA TERIMA SKPP</td>
		</tr>
		<tr>
			<td>DIREKTORAT JENDERAL PERBENDAHARAAN</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>KPPN <?php echo $kppn; ?></td>
		</tr>
	</table>
	<hr width="85%" />
	<br />
	<table align="center" border="0" width="80%">
			<tr>
				<th colspan='2' align="left">Data Surat Keterangan Penghentian Pembayaran</th>
				<th colspan='2' align="left">Agenda</th>
				<th colspan='2' align="left">Penyelesaian</th>
			</tr>
			<tr>
				<td>Nama</td>
				<td>: <?php echo $anskpp; ?></td>
				<td>No. Agenda</td>
				<td>: <?php echo $noagenda; ?> </td>
				<td>Tgl. Penyelesaian</td>
				<td>: <?php echo $tgsls; ?></td>
			</tr>
			<tr>
				<td>NIP</td>
				<td>: <?php echo $nip; ?></td>
				<td>Tgl. Agenda</td>
				<td>: <?php echo $tgagdtrm; ?> </td>
			</tr>
			<tr>
					<td>Pangkat</td>
					<td>: <?php echo $pangkat; ?></td>
			</tr>
			<tr>
					<td>No. SKPP</td>
					<td>: <?php echo $noskpp; ?></td>
			</tr>
			<tr>
					<td>Tgl. SKPP</td>
					<td>: <?php echo $tgskpp; ?></td>
			</tr>
			<tr>
					<td>Status SKPP</td>
					<td>: <?php switch($staskpp){
										case "01":
										echo "PNS";
										break;
										case "02":
										echo "TNI";
										break;
										case "03":
										echo "POLRI";
										break;
					} ?></td>
			</tr>
					<tr>
					<td>Jenis SKPP</td>
					<td>: <?php switch($kdjenskpp){
										case "01":
										echo "Pindah";
										break;
										case "02":
										echo "Pensiun";
										break;
										case "03":
										echo "Janda/Duda";
										break;
					} ?></td>
			</tr>
			</tr>
					<tr>
					<td>Kode GPP</td>
					<td>: <?php switch($kdgpp){
										case "00":
										echo "Non GPP";
										break;
										case "01":
										echo "GPP";
										break;
					} ?></td>
			</tr>
			</tr>
			<tr>
					<td>Nama Satker</td>
					<td>: <?php echo "$rnmsatker[0]"; ?></td>
			</tr>
			<tr>
					<td>Alamat</td>
					<td>: <?php echo "$alamat"; ?></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
					<td colspan='6' bgcolor="Silver"></td>
			</tr>
			<tr>
					<td><br />Nama Petugas F.O.</td>
					<td><br />: <?php echo "$username"; ?></td>
			</tr>
	</table>
	<br />
	<br />
	<hr width="85%" />
		<table border="0" width="80%" align="center">
			<tr><td><b>Catatan:</b></td></tr>
		</table>
		<br />
		<br />
	<hr width="85%" />
	</body>
</html>
