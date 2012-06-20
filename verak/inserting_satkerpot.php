<?php
require "koneksi.php";
include "fungsi_rp.php";

$jumldata	= $_POST['jumldata'];
$Akun			= $_POST['akun'];

echo '<table cellpadding="1" cellspacing="1" border="1" align="center" valign="middle" width="80%">
		<tr align="middle" valign="middle">
		<th width="5%" height="50" align="center" valign="middle"  nowrap="nowrap">No.</th>
		<th width="10%" height="50" align="center" valign="middle"  nowrap="nowrap">Satker</th>
		<th width="10%" height="50" align="center" valign="middle"  nowrap="nowrap">No.SPM</th>	
		<th width="15%" height="50" align="center" valign="middle"  nowrap="nowrap">Tgl.SP2D</th>
		<th width="10%" height="50" align="center" valign="middle"  nowrap="nowrap">No.SP2D</th>
		<th width="10%" height="50" align="center" valign="middle"  nowrap="nowrap">Satkerb</th>
		<th width="10%" height="50" align="center" valign="middle"  nowrap="nowrap">Akun</th>
		<th width="20%" height="50" align="center" valign="middle"  nowrap="nowrap">Jumlah</th>
		</tr>
		</table>';
					
//looping sejumlah banyaknya data
for($i = 1; $i <= $jumldata; $i++) {	

	$satker	= $_POST['kdsatker'.$i];
	$nospm	= $_POST['nospm'.$i];
	$nosp2d	= $_POST['nosp2d'.$i];
	$satkerb	= $_POST['kdsatkerb'.$i];
	$kpp		= $_POST['kpp'.$i];
	
//Akun 411
	if($Akun=='411'){
		

		$updatePjk	= mysql_query("UPDATE m_spmmap SET kdsatkerb='$kpp' WHERE nosp2d='$nosp2d' AND kdsatkerb=''");	
		
		$query		= mysql_query("SELECT kdsatker,nospm,tgsp2d,nosp2d,kdsatkerb,kdakun,nilmap FROM m_spmmap WHERE kdsatker='$satker' AND nospm='$nospm' AND LEFT(kdakun,3)='$Akun'");
		while($r 	= mysql_fetch_array($query)) {
			
			$satker	= $r['kdsatker'];
			$nospm	= $r['nospm'];
			$Tgsp2d	= $r['tgsp2d'];
			$tgsp2d	= tgl($Tgsp2d);
			$nosp2d	= $r['nosp2d'];
			$satkerb	= $r['kdsatkerb'];
			$akun		= $r['kdakun'];
			$Nilmap	= $r['nilmap'];
			$nilmap	= bil($Nilmap); 
		
	echo "<table cellpadding='1' cellspacing='1' border='1' align='center' width='80%'>
			<tr align='middle'>
				<td width='5%' align='middle'>$i</td>
				<td width='10%' align='middle'>$satker</td>
				<td width='10%' align='middle'>$nospm</td>
				<td width='15%' align='middle'>$tgsp2d</td>
				<td width='10%' align='middle'>$nosp2d</td>
				<td width='10%' align='middle'>$satkerb</td>
				<td width='10%' align='middle'>$akun</td>
				<td width='20%' align='right'>$nilmap</td>";
				}
	echo "</tr>
			</table>";
			}
		
//Akun 423,511,581,815
	elseif($Akun=='423' || $Akun=='511' || $Akun=='581' || $Akun=='815') {
		
		$updatePNBP	= mysql_query("UPDATE m_spmmap SET kdsatkerb='$satker' WHERE nosp2d='$nosp2d' AND kdsatkerb=''");
		
		$qPNBP		= mysql_query("SELECT kdsatker,nospm,tgsp2d,nosp2d,kdsatkerb,kdakun,nilmap FROM m_spmmap WHERE kdsatker='$satker' AND nospm='$nospm' AND LEFT(kdakun,3)='$Akun'");
		while($rPNBP= mysql_fetch_array($qPNBP)) {
			$satker	= $rPNBP['kdsatker'];
			$nospm	= $rPNBP['nospm'];
			$Tgsp2d	= $rPNBP['tgsp2d'];
			$tgsp2d	= tgl($Tgsp2d);
			$nosp2d	= $rPNBP['nosp2d'];
			$satkerb	= $rPNBP['kdsatkerb'];
			$akun		= $rPNBP['kdakun'];
			$Nilmap	= $rPNBP['nilmap'];
			$nilmap	= bil($Nilmap); 
			
	echo "<table cellpadding='1' cellspacing='1' border='1' align='center' width='80%'>
			<tr align='middle'>
				<td width='5%' align='middle'>$i</td>
				<td width='10%' align='middle'>$satker</td>
				<td width='10%' align='middle'>$nospm</td>
				<td width='15%' align='middle'>$tgsp2d</td>
				<td width='10%' align='middle'>$nosp2d</td>
				<td width='10%' align='middle'>$satkerb</td>
				<td width='10%' align='middle'>$akun</td>
				<td width='20%' align='right'>$nilmap</td>";
				}
	echo "</tr>
			</table>";
	}
	
//Akun 811
	elseif($Akun=='811') {
		
		$updatePfk	= mysql_query("UPDATE m_spmmap SET kdsatkerb='987361' WHERE nosp2d='$nosp2d' AND kdsatkerb=''");
		
		$qPfk		= mysql_query("SELECT kdsatker,nospm,tgsp2d,nosp2d,kdsatkerb,kdakun,nilmap FROM m_spmmap WHERE kdsatker='$satker' AND nospm='$nospm' AND LEFT(kdakun,3)='$Akun'");
		while($rPfk= mysql_fetch_array($qPfk)) {
			$satker	= $rPfk['kdsatker'];
			$nospm	= $rPfk['nospm'];
			$Tgsp2d	= $rPfk['tgsp2d'];
			$tgsp2d	= tgl($Tgsp2d);
			$nosp2d	= $rPfk['nosp2d'];
			$satkerb	= $rPfk['kdsatkerb'];
			$akun		= $rPfk['kdakun'];
			$Nilmap	= $rPfk['nilmap'];
			$nilmap	= bil($Nilmap); 
			
	echo "<table cellpadding='1' cellspacing='1' border='1' align='center' width='80%'>
			<tr align='middle'>
				<td width='5%' align='middle'>$i</td>
				<td width='10%' align='middle'>$satker</td>
				<td width='10%' align='middle'>$nospm</td>
				<td width='15%' align='middle'>$tgsp2d</td>
				<td width='10%' align='middle'>$nosp2d</td>
				<td width='10%' align='middle'>$satkerb</td>
				<td width='10%' align='middle'>$akun</td>
				<td width='20%' align='right'>$nilmap</td>";
				}
	echo "</tr>
			</table>";
	}
}
mysql_close($link);
echo '<br />
<center><input type="button" name="button" value="Kembali" onclick="history.go(-2)" /></center>';
?>