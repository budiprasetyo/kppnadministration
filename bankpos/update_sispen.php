<?php
include "koneksi.php";
$tgl		= $_POST[tgl];
$bln		= $_POST[bln];
$thn		= $_POST[thn];
$tanggal	= "$thn-$bln-$tgl";
$Tgl		= $_POST[Tgl];
$Bln		= $_POST[Bln];
$Thn		= $_POST[Thn];
$Tanggal	= "$Thn-$Bln-$Tgl";
$Akun		= $_POST[akun];

$q			= mysql_query("SELECT DISTINCT tgbuku,kdntpp,nmwajbay,kdnpwp,kddept,kdunit,kdsatker,kdfungsi,kdsfungsi,kdprogram,kdgiat,kdsgiat,kdctarik,kdsdana,kddekon,kdmap FROM d_sispen WHERE tgbuku BETWEEN '$tanggal' AND '$Tanggal' AND LEFT(kdmap,1)='$Akun' AND (kddept='' OR kdunit='' OR kdsatker='' OR kdfungsi='' OR kdsfungsi='' OR kdprogram='' OR kdgiat='' OR kdsgiat='' OR kdctarik='' OR kddekon='' OR kdsdana='')");
$R			= mysql_fetch_array($q);	

if($R[kddept]='' || $R[kdunit]='' || $R[kdsatker]='' || $R[kdfungsi]='' || $R[kdsfungsi]='' || $R[kdprogram]='' || $R[kdgiat]='' || $R[kdsgiat]='' || $R[kdctarik]='' || $R[kdsdana]='' || $R[kddekon]=''){
	echo "<script language='javascript'>
	window.alert('Data Sispen Telah Terisi Semua');
	history.back(-1);
	</script>";
	}

elseif($R[kdmap]=='') {	
	echo "<script language='javascript'>
	window.alert('Data Kelompok Akun $Akun Tidak Ada');
	history.back(-1);
	</script>";
	}
	
else {
	
		if($Akun=='5' || $Akun=='6'){
			

			echo '<form action="updating_sispen.php" method="post">
			<table border="1" align="center" width="85%">
			<tr>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">No.</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">NTPN</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Wajib Pajak</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Akun</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">J.K.</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">C.Tarik</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">S.D.</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Fs</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">sFs</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Prog</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Keg</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">sKeg</th>
			</tr>';

			$query	= mysql_query("SELECT DISTINCT tgbuku,kdntpp,nmwajbay,kdnpwp,kdfungsi,kdsfungsi,kdprogram,kdgiat,kdsgiat,kdctarik,kdsdana,kddekon,kdmap FROM d_sispen WHERE tgbuku BETWEEN '$tanggal' AND '$Tanggal' AND LEFT(kdmap,1)='$Akun' AND (kdfungsi='' OR kdsfungsi='' OR kdprogram='' OR kdgiat='' OR kdsgiat='' OR kdctarik='' OR kddekon='' OR kdsdana='') ORDER BY kdmap");
			$no		= 1;
			while($r	= mysql_fetch_array($query)) {
				$tgbuku	= $r[tgbuku];
				$ntpn		= $r[kdntpp];
				$wp		= $r[nmwajbay];
				$akun		= $r[kdmap];
				$npwp		= $r[kdnpwp];
				$fungsi	= $r[kdfungsi];
				$sfung	= $r[kdsfungsi];
				$prog		= $r[kdprogram];
				$giat		= $r[kdgiat];
				$sgiat	= $r[kdsgiat];
				$ctarik	= $r[kdctarik];
				$sdana	= $r[kdsdana];
				$dekon	= $r[kddekon];
			
	
			echo "<tr align='middle' valign='middle'>
			<td align='center' valign='middle'>$no</td>
			<td align='center' valign='middle'><input type='text' name='kdntpp$no' value='$ntpn' size='14' readonly='readonly' /></td>
			<td align='center' valign='middle'>$wp</td>
			<td align='center' valign='middle'>$akun</td>
			<td align='center' valign='middle'><input type='text' name='kddekon$no' value='$dekon' size='2' maxlength='2' /></td>
			<td align='center' valign='middle'><input type='text' name='kdctarik$no' value='$ctarik' size='2' maxlength='1' /></td>
			<td align='center' valign='middle'><input type='text' name='kdsdana$no' value='$sdana' size='2' maxlength='2' /></td>
			<td align='center' valign='middle'><input type='text' name='kdfungsi$no' value='$fungsi' size='2' maxlength='2' /></td>
			<td align='center' valign='middle'><input type='text' name='kdsfungsi$no' value='$sfung' size='2' maxlength='2' /></td>
			<td align='center' valign='middle'><input type='text' name='kdprogram$no' value='$prog' size='2' maxlength='2' /></td>
			<td align='center' valign='middle'><input type='text' name='kdgiat$no' value='$giat' size='3' maxlength='4' /></td>
			<td align='center' valign='middle'><input type='text' name='kdsgiat$no' value='$sgiat' size='3' maxlength='2' /></td>";
			$no++;
			}	

			//jumlah banyaknya data
			echo "</tr>
			</table>
			<br />
			<input type='hidden' name='jumldata' value='$no-1;' />
			<input type='hidden' name='akun' value='$Akun' />
			<center><input type='submit' name='submit' value='Update' /></center>
			</form>";
		}
		
	elseif($Akun=='4' || $Akun=='7' || $Akun=='8') {
		echo '<form action="updating_sispen.php" method="post">
			<table border="1" align="center" width="85%">
			<tr>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">No.</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">NTPN</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Wajib Pajak</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Akun</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Dept</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Unit</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">Satker</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">J.K.</th>
			</tr>';
			
			$queryp	= mysql_query("SELECT DISTINCT tgbuku,kdntpp,nmwajbay,kdnpwp,kddept,kdunit,kdsatker,kdfungsi,kdsfungsi,kdprogram,kdgiat,kdsgiat,kdctarik,kdsdana,kddekon,kdmap FROM d_sispen WHERE tgbuku BETWEEN '$tanggal' AND '$Tanggal' AND LEFT(kdmap,1)='$Akun' AND (kddept='' OR kdunit='' OR kdsatker='' OR kddekon='') ORDER BY kdmap");
			$no		= 1;
			while($h	= mysql_fetch_array($queryp)) {
				$tgbuku	= $h[tgbuku];
				$ntpn		= $h[kdntpp];
				$wp		= $h[nmwajbay];
				$akun		= $h[kdmap];
				$dept		= $h[kddept];
				$unit		= $h[kdunit];
				$satker	= $h[kdsatker];
				$npwp		= $h[kdnpwp];
				$fungsi	= $h[kdfungsi];
				$sfung	= $h[kdsfungsi];
				$prog		= $h[kdprogram];
				$giat		= $h[kdgiat];
				$ctarik	= $h[kdctarik];
				$sdana	= $h[kdsdana];
				$dekon	= $h[kddekon];
			
			
			echo "<tr align='middle' valign='middle'>
			<td align='center' valign='middle'>$no</td>
			<td align='center' valign='middle'><input type='text' name='kdntpp$no' value='$ntpn' size='14' readonly='readonly' /></td>
			<td align='center' valign='middle'>$wp</td>
			<td align='center' valign='middle'>$akun</td>
			<td align='center' valign='middle'><input type='text' name='kddept$no' value='$dept' size='2' maxlength='3' /></td>
			<td align='center' valign='middle'><input type='text' name='kdunit$no' value='$unit' size='2' maxlength='2' /></td>
			<td align='center' valign='middle'><input type='text' name='kdsatker$no' value='$satker' size='4' maxlength='6' /></td>
			<td align='center' valign='middle'><input type='text' name='kddekon$no' value='$dekon' size='2' maxlength='2' /></td>";
			$no++;
			}	

			//jumlah banyaknya data
			echo "</tr>
			</table>
			<br />
			<input type='hidden' name='jumldata' value='$no-1;' />
			<input type='hidden' name='akun' value='$Akun' />
			<center><input type='submit' name='submit' value='Update' /></center>
			</form>";
		}
	
}	
mysql_close($link);		
?>
