<?php
include "koneksi.php";

$tgl	= $_POST[tgl];
$bln	= $_POST[bln];
$thn	= $_POST[thn];
$tgbuku	= "$thn-$bln-$tgl";
$kpbc	= $_POST[kpbc];
$dept	= $_POST[dept];
$unit	= $_POST[unit];
$satker	= $_POST[satker];
$dekon	= $_POST[dekon];
$akun	= $_POST[akun];
$kelmap	= $_POST[kelmap];

$update	= mysql_query("UPDATE d_sispen SET kddept='$dept',kdunit='$unit',kdsatker='$satker',kddekon='$dekon' WHERE kdmap='$akun' AND kdkelmap='$kelmap' AND kdsatker!='$satker' AND kdkpbc='$kpbc' AND tgbuku='$tgbuku'");
$query	= mysql_query("SELECT nmwajbay,kdnpwp,kdntpp,kdmap,kddept,kdunit,kdsatker,kddekon,kdlokasi,kddatidua,kdfungsi,kdsfungsi,kdprogram,kdgiat,kdsgiat,kdkpbc FROM d_sispen WHERE kdmap='$akun' AND kdkelmap='$kelmap' AND kdsatker='$satker' AND kdkpbc='$kpbc' AND tgbuku='$tgbuku'");
$no		= 1 ;
echo"<h3><center>Data Tanggal $tgl-$bln-$thn Yang Telah Diubah</center></h3>
	<br />
	<table border='1' align='center' width='85%'>
		<tr height='50'>
			<th align='center'><font face='verdana' size='2'>No.</font></th>
			<th><font face='verdana' size='2'>Wajib Pajak</font></th>
			<th align='center'><font face='verdana' size='2'>NTPN</font></th>
			<th align='center'><font face='verdana' size='2'>Dept</font></th>
			<th align='center'><font face='verdana' size='2'>Unit</font></th>
			<th align='center'><font face='verdana' size='2'>Satker</font></th>
			<th align='center'><font face='verdana' size='2'>J.K.</font></th>
		</tr>";
		
while($result	= mysql_fetch_array($query)){

$wp		= $result[nmwajbay];
$ntpn	= $result[kdntpp];
$akun	= $result[kdmap];
$dept	= $result[kddept];
$unit	= $result[kdunit];
$satker	= $result[kdsatker];
$dekon	= $result[kddekon];

echo"<tr>
		<td align='center'><font face='verdana' size='1'>$no</font></td>
		<td align='center'><font face='verdana' size='1'>$wp</font></td>
		<td align='center'><font face='verdana' size='1'>$ntpn</font></td>
		<td align='center'><font face='verdana' size='1'>$dept</font></td>
		<td align='center'><font face='verdana' size='1'>$unit</font></td>
		<td align='center'><font face='verdana' size='1'>$satker</font></td>
		<td align='center'><font face='verdana' size='1'>$dekon</font></td>
	</tr>";
	$no++;
	}
echo"</table>";
?>

