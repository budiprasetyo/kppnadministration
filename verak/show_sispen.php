<?php
include "koneksi.php";

$tgl	= $_POST[tgl];
$bln	= $_POST[bln];
$thn	= $_POST[thn];
$tgbuku	= "$thn-$bln-$tgl";
$akun1	= $_POST[akun1];
$akun2	= $_POST[akun2];
$qkpp	= mysql_query("SELECT DISTINCT kd_kpp,nm_kpp FROM t_kpp");
$rkpp	= mysql_fetch_array($qkpp);
$kdkpp	= $rkpp[kd_kpp];
$nmkpp	= $rkpp[nm_kpp];
$query	= mysql_query("SELECT DISTINCT a.tgbuku,a.kdbankpos,a.kdntpp,SUBSTRING(a.kdnpwp,10,3) AS npwp,b.nm_kpp,a.kdmap,a.nmwajbay,a.kddept,a.kdunit,a.kdsatker,b.kd_satker,a.kddekon,format(a.nilsetor,0) as nilsetor FROM d_sispen a LEFT JOIN t_kpp b ON SUBSTRING(a.kdnpwp,10,3)=b.kd_kpp WHERE a.tgbuku='$tgbuku' AND (SUBSTRING(a.kdmap,1,1)='$akun1' OR SUBSTRING(a.kdmap,1,1)='$akun2') AND a.kdsatker!=b.kd_satker ORDER BY a.kdmap,a.kdsatker")or die("Tidak Terhubung Database");
$no		= 1 ;
echo "<br /><h3><center><font face='verdana'>Validasi Data Sispen Tanggal: $tgl-$bln-$thn</font></center></h3>
	<table border='1' align='center' width='85%'>
		<tr height='50'>
			<th align='center' width='5%'><font face='verdana' size='2'>No.</font></th>
			<th align='center' width='10%'><font face='verdana' size='2'>NTPN</font></th>
			<th align='center' width='10%'><font face='verdana' size='2'>Bank</font></th>
			<th align='center' width='10%'><font face='verdana' size='2'>NPWP</font></th>
			<th align='center' width='10%'><font face='verdana' size='2'>KPP</font></th>
			<th align='center' width='5%'><font face='verdana' size='2'>Akun</font></th>
			<th align='center' width='35%'><font face='verdana' size='2'>Wajib Bayar</font></th>
			<th align='center' width='5%'><font face='verdana' size='2'>Dept</font></th>
			<th align='center' width='5%'><font face='verdana' size='2'>Unit</font></th>
			<th align='center' width='10%'><font face='verdana' size='2'>Satker</font></th>
			<th align='center' width='10%'><font face='verdana' size='2'>J.K.</font></th>
			<th align='center' width='15%'><font face='verdana' size='2'>Jumlah</font></th>
		</tr>";
		
while($result	= mysql_fetch_array($query)){ 
		$ntpn	= $result[kdntpp];
		$bank	= $result[kdbankpos];
		$npwp	= $result[npwp];
		$kpp	= $result[nm_kpp];
		$akun	= $result[kdmap];
		$wajbay	= $result[nmwajbay];
		$dept	= $result[kddept]; 
		$unit	= $result[kdunit];
		$satker	= $result[kdsatker];
		$dekon	= $result[kddekon];
		$jumlah	= $result[nilsetor];
	
		echo"<tr height='40'>
			<td align='center'><font face='verdana' size='1'>$no</font></td>
			<td><font face='verdana' size='1'>$ntpn</font></td>
			<td align='center'><font face='verdana' size='1'>$bank</font></td>
			<td align='center'><font face='verdana' size='1'>$npwp</font></td>
			<td align='center'><font face='verdana' size='1'>$kpp</font></td>
			<td align='center'><font face='verdana' size='1'>$akun</font></td>
			<td><font face='verdana' size='1'>$wajbay</font></td>
			<td align='center'><font face='verdana' size='1'>$dept</font></td>
			<td align='center'><font face='verdana' size='1'>$unit</font></td>
			<td align='center'><font face='verdana' size='1'>$satker</font></td>
			<td align='center'><font face='verdana' size='1'>$dekon</font></td>
			<td align='right'><font face='verdana' size='1'>$jumlah</font></td>
		</tr>";
		$no++;
		}
		echo "</table>";
?>