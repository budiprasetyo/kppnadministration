<html>
	<head>
		<meta/>
		<title>Report Konsep SKPP</title>
	</head>
	<body>
		<?php
		     include "../config/koneksi.php";
		     $idSKPP	= isset($_POST['idSkpp']);
		     
		     
		     ?>
		<table align="center" border="0" width="80%">
			<tr>
					<td rowspan="6" align="center"><img border="0" src="../templates/images/logodepkeu.png" width="110" alt="logo depkeu" /></td>
				     	<td colspan="4" align="center"><font size="5"><b>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</b></font></td>
			</tr>
			<tr>
				     <td colspan="4" align="center"><font size="4"><b>DIREKTORAT JENDERAL PERBENDAHARAAN</b></font></td>
			</tr>
			<tr>
				     <td colspan="4" align="center"><font size="4"><b>KANTOR WILAYAH PROVINSI JAWA TENGAH</b></font></td>
			</tr>
			<tr>
				     <td colspan="4" align="center"><font size="4">KANTOR PELAYANAN PERBENDAHARAAN NEGARA SEMARANG II</font></td>
			</tr>
			<tr>
				     <td colspan="4" align="center"><font size="2">Jalan Ki Mangunsarkoro No. 34 Semarang 50241 Telepon: (024) 8413762 Faksimile: (024) 8419664</font></td>
			</tr>
			<tr>
				     <td colspan="4" align="center"><font size="2">Website: www.kppnsemarang2.com Email: kppn.semarang2@gmail.com SMS Gateway: 0811277134</font></td>
			</tr>
		</table>
		<hr width="85%" size="5"  />
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
				<td>: -</td>
			</tr>
			<tr>
				<td>No. SKPP</td>
				<td>: <?php echo $noskpp; ?></td>
				<td>Tgl. Agenda</td>
				<td>: <?php echo $tgagdtrm; ?> </td>
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