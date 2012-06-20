<?php
require "koneksi.php";
include "fungsi_rp.php";
$tgl		= $_POST['tgl'];
$bln		= $_POST['bln'];
$thn		= $_POST['thn'];
$tanggal	= "$thn-$bln-$tgl";
$Tgl		= $_POST['Tgl'];
$Bln		= $_POST['Bln'];
$Thn		= $_POST['Thn'];
$Tanggal	= "$Thn-$Bln-$Tgl";
$Akun		= $_POST['akun'];

//Akun 411
if($Akun=='411'){
	$qpjk	= mysql_query("SELECT DISTINCT a.kdsatker,a.nospm,a.kdakun,a.tgsp2d,a.nosp2d,a.kdsatkerb,SUBSTRING(b.kdnpwp,10,3) AS npwp,c.kd_satker AS kpp,c.kd_kpp AS kdkpp FROM m_spmmap a,m_spminfo b,t_kpp c WHERE a.nosp2d=b.nosp2d AND SUBSTRING(b.kdnpwp,10,3)=c.kd_kpp AND a.kdsatkerb='' AND LEFT(a.kdakun,3)='$Akun' AND a.tgsp2d BETWEEN '$tanggal' AND '$Tanggal' ORDER BY a.tgsp2d,a.kdsatker");
	$no	= 1;
	
	echo"<br /><h3><center><font face='verdana'>Insert Data Satker Pada Potongan Tanggal: $tgl-$bln-$thn s.d. $Tgl-$Bln-$Thn</font></center></h3>
		<br />
		<form action='inserting_satkerpot.php' method='post'>
		<table border='1' align='center' width='85%'>
		<tr height='50'>
			<th>No.</th>
			<th>Satker</th>
			<th>No.SPM</th>
			<th>Tgl.SP2D</th>
			<th>No.SP2D</th>
			<th>Akun</th>
			<th>Satkerb</th>
			<th>NPWP</th>
			<th>KPP</th>
		</tr>";
		
	while($rpjk	= mysql_fetch_array($qpjk)){
		$satker	= $rpjk['kdsatker'];
		$nospm	= $rpjk['nospm'];
		$akun		= $rpjk['kdakun'];
		$Tgsp2d	= $rpjk['tgsp2d'];
		$tgsp2d	= tgl($Tgsp2d);
		$nosp2d	= $rpjk['nosp2d'];
		$satkerb	= $rpjk['kdsatkerb'];
		$npwp		= $rpjk['npwp'];
		$kpp		= $rpjk['kpp'];
		$kdkpp	= $rpjk['kdkpp'];
		
		echo "<tr>
			<td align='center'>$no</td>
			<td align='center'><input type='text' name='kdsatker$no' value='$satker' size='4' maxlength='6' readonly='readonly' /></td>
			<td align='center'><input type='text' name='nospm$no' value='$nospm' size='4' maxlength='5' readonly='readonly' /></td>
			<td align='center'>$tgsp2d</td>
			<td align='center'><input type='text' name='nosp2d$no' value='$nosp2d' size='5' maxlength='7' readonly='readonly' /></td>
			<td align='center'>$akun</td>
			<td align='center'><input type='text' name='kdsatkerb$no' value='$satkerb' size='4' maxlength='6' readonly='readonly' /></td>
			<td align='center'>$npwp</td>
			<td align='center'><input type='text' name='kpp$no' value='$kpp' size='4' maxlength='6' readonly='readonly' /></td>
		</tr>";
		$no++;
		}
//jumlah banyaknya data akun 411
	echo"</table>
	<br />
	<input type='hidden' name='jumldata' value='$no-1;' />
	<input type='hidden' name='akun' value='$Akun' />
	<center><input type='submit' name='submit' value='Update' /></center>
	</form>";
	}
		
		
//Akun 423
elseif($Akun=='423' || $Akun=='511' || $Akun=='581' || $Akun=='815'){
	$qpnbp	= mysql_query("SELECT DISTINCT kdsatker,nospm,kdakun,tgsp2d,nosp2d,kdsatkerb FROM m_spmmap WHERE kdsatkerb='' AND LEFT(kdakun,3)='$Akun' AND tgsp2d BETWEEN '$tanggal' AND '$Tanggal' ORDER BY tgsp2d,kdsatker");
	$no		= 1;
	
	echo "<br /><h3><center><font face='verdana'>Insert Data Satker Pada Potongan Tanggal: $tgl-$bln-$thn s.d. $Tgl-$Bln-$Thn</font></center></h3>
		<br />
		<form action='inserting_satkerpot.php' method='post'>
		<table border='1' align='center' width='85%'>
		<tr height='50'>
			<th>No.</th>
			<th>Satker</th>
			<th>No.SPM</th>
			<th>Tgl.SP2D</th>
			<th>No.SP2D</th>
			<th>Akun</th>
			<th>Satkerb</th>
		</tr>";
	
	while($rpnbp= mysql_fetch_array($qpnbp)) {
		$satker	= $rpnbp['kdsatker'];
		$nospm	= $rpnbp['nospm'];		
		$akun		= $rpnbp['kdakun'];
		$Tgsp2d	= $rpnbp['tgsp2d'];
		$tgsp2d	= tgl($Tgsp2d);
		$nosp2d	= $rpnbp['nosp2d'];
		$satkerb	= $rpnbp['satkerb'];
		
		echo "<tr>
				<td align='center'>$no</td>
				<td align='center'><input type='text' name='kdsatker$no' value='$satker' size='4' maxlength='6' readonly='readonly' /></td>
				<td align='center'><input type='text' name='nospm$no' value='$nospm' size='4' maxlength='5' readonly='readonly' /></td>
				<td align='center'>$tgsp2d</td>
				<td align='center'><input type='text' name='nosp2d$no' value='$nosp2d' size='5' maxlength='7' readonly='readonly' /></td>
				<td align='center'>$akun</td>
				<td align='center'><input type='text' name='kdsatkerb$no' value='$satkerb' size='4' maxlength='6' readonly='readonly' /></td>
			</tr>";
	$no++;
		}
		
	//jumlah banyaknya data akun 423
	echo"</table>
	<br />
	<input type='hidden' name='jumldata' value='$no-1;' />
	<input type='hidden' name='akun' value='$Akun' />
	<center><input type='submit' name='submit' value='Update' /></center>
	</form>";
	}
	
//Akun 811
elseif($Akun=='811'){
	$qpfk		= mysql_query("SELECT DISTINCT kdsatker,nospm,kdakun,tgsp2d,nosp2d,kdsatkerb FROM m_spmmap WHERE kdsatkerb='' AND LEFT(kdakun,3)='$Akun' AND tgsp2d BETWEEN '$tanggal' AND '$Tanggal' ORDER BY tgsp2d,kdsatker");
	$no		= 1;
	
	echo "<br /><h3><center><font face='verdana'>Insert Data Satker Pada Potongan Tanggal: $tgl-$bln-$thn s.d. $Tgl-$Bln-$Thn</font></center></h3>
		<br />
		<form action='inserting_satkerpot.php' method='post'>
		<table border='1' align='center' width='85%'>
		<tr height='50'>
			<th>No.</th>
			<th>Satker</th>
			<th>No.SPM</th>
			<th>Tgl.SP2D</th>
			<th>No.SP2D</th>
			<th>Akun</th>
			<th>Satkerb</th>
		</tr>";
	
	while($rpfk= mysql_fetch_array($qpfk)) {
		$satker	= $rpfk['kdsatker'];
		$nospm	= $rpfk['nospm'];		
		$akun		= $rpfk['kdakun'];
		$Tgsp2d	= $rpfk['tgsp2d'];
		$tgsp2d	= tgl($Tgsp2d);
		$nosp2d	= $rpfk['nosp2d'];
		$satkerb	= $rpfk['satkerb'];
		
		echo "<tr>
				<td align='center'>$no</td>
				<td align='center'><input type='text' name='kdsatker$no' value='$satker' size='4' maxlength='6' readonly='readonly' /></td>
				<td align='center'><input type='text' name='nospm$no' value='$nospm' size='4' maxlength='5' readonly='readonly' /></td>
				<td align='center'>$tgsp2d</td>
				<td align='center'><input type='text' name='nosp2d$no' value='$nosp2d' size='5' maxlength='7' readonly='readonly' /></td>
				<td align='center'>$akun</td>
				<td align='center'><input type='text' name='kdsatkerb$no' value='$satkerb' size='4' maxlength='6' readonly='readonly' /></td>
			</tr>";
	$no++;
		}
		
	//jumlah banyaknya data akun 811
	echo"</table>
	<br />
	<input type='hidden' name='jumldata' value='$no-1;' />
	<input type='hidden' name='akun' value='$Akun' />
	<center><input type='submit' name='submit' value='Update' /></center>
	</form>";
	}
mysql_close($link);
?>