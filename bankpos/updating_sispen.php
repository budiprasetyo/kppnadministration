<?php
include "koneksi.php";

$jumldata	= $_POST['jumldata'];
$Akun			= $_POST['akun'];
if($Akun=='4' || $Akun=='7' || $Akun=='8') { 

			echo '<table cellpadding="1" cellspacing="1" border="1" align="center" valign="middle" width="80%">
			<tr align="middle" valign="middle">
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">No.</th>
			<th height="50" width="19%" align="center" valign="middle"  nowrap="nowrap">NTPN</th>
			<th height="50" width="44%" align="center" valign="middle"  nowrap="nowrap">Wajib Pajak</th>	
			<th height="50" width="8%" align="center" valign="middle"  nowrap="nowrap">Akun</th>
			<th height="50" width="6%" align="center" valign="middle"  nowrap="nowrap">Dept</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">Unit</th>
			<th height="50" width="8%" align="center" valign="middle"  nowrap="nowrap">Satker</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">J.K.</th>
			</tr>
			</table>';
			}
			
else {
	
	echo '<table cellpadding="1" cellspacing="1" border="1" align="center" valign="middle" width="80%">
			<tr align="middle" valign="middle">
			<th height="50" width="3%" align="center" valign="middle"  nowrap="nowrap">No.</th>
			<th height="50" width="19%" align="center" valign="middle"  nowrap="nowrap">NTPN</th>
			<th height="50" width="44%" align="center" valign="middle"  nowrap="nowrap">Wajib Pajak</th>	
			<th height="50" width="8%" align="center" valign="middle"  nowrap="nowrap">Akun</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">Fs</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">sFs</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">Prog</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">Keg</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">sKeg</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">C.T.</th>
			<th height="50" width="5%" align="center" valign="middle"  nowrap="nowrap">S.D.</th>
			<th height="50" align="center" valign="middle"  nowrap="nowrap">J.K.</th>
			</tr>
			</table>';
			}			
				

//looping sebanyak jumldata
for($i = 1; $i <= $jumldata; $i++) { 

	$ntpn			= $_POST['kdntpp'.$i];
	$dekon		= strtoupper($_POST['kddekon'.$i]);
	$ctarik		= $_POST['kdctarik'.$i];
	$sdana		= $_POST['kdsdana'.$i];
	$fungsi		= $_POST['kdfungsi'.$i];
	$sfung		= $_POST['kdsfungsi'.$i];
	$prog			= $_POST['kdprogram'.$i];
	$giat			= $_POST['kdgiat'.$i];
	$sgiat		= $_POST['kdsgiat'.$i];
	$dept			= $_POST['kddept'.$i];
	$unit			= $_POST['kdunit'.$i];
	$satker		= $_POST['kdsatker'.$i];
	
	
	if($Akun=='4' || $Akun=='7' || $Akun=='8'){
		
		if($dekon!='' || $dept!='' || $unit!='' || $satker!=''){
			$update	= mysql_query("UPDATE d_sispen SET kddekon='$dekon',kddept='$dept',kdunit='$unit',kdsatker='$satker' WHERE kdntpp='$ntpn'");
						
			$query	= mysql_query("SELECT DISTINCT kdntpp,nmwajbay,kdnpwp,kddept,kdunit,kdsatker,kdfungsi,kdsfungsi,kdprogram,kdgiat,kdsgiat,kdctarik,kdsdana,kddekon,kdmap FROM d_sispen WHERE kdntpp='$ntpn' AND LEFT(kdmap,1)='$Akun' ORDER BY kdmap");	
			while($r	= mysql_fetch_array($query)) {	
			
			$ntpn		= $r['kdntpp'];
			$wp		= $r['nmwajbay'];
			$akun		= $r['kdmap'];
			$dept		= $r['kddept'];
			$unit		= $r['kdunit'];
			$satker	= $r['kdsatker'];
			$dekon	= $r['kddekon'];
			
			echo "<table cellpadding='1' cellspacing='1' border='1' align='center' valign='middle' width='80%'>
			<tr align='middle' valign='middle'>
			<td width='5%'  align='center' valign='middle'>$i</td>
			<td width='19%' align='center' valign='middle'>$ntpn</td>
			<td width='44%' align='center' valign='middle'>$wp</td>
			<td width='8%'  align='center' valign='middle'>$akun</td>
			<td width='6%'  align='center' valign='middle'><input type='text' name='kddept$i' value='$dept' size='2' maxlength='3' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle'><input type='text' name='kdunit$i' value='$unit' size='2' maxlength='2' readonly='readonly' /></td>
			<td width='8%'  align='center' valign='middle'><input type='text' name='kdsatker$i' value='$satker' size='4' maxlength='6' readonly='readonly' /></td>
			<td align='center' valign='middle'><input type='text' name='kddekon$i' value='$dekon' size='2' maxlength='2' readonly='readonly' /></td>";
			}	

			echo "</tr>
			</table>";
		}
	}
	
	elseif($Akun=='5' || $Akun=='6') { 
		
			if($fungsi!='' || $sfung!='' || $prog!='' || $giat!='' || $sgiat!='' || $ctarik!='' || $sdana!='' || $dekon!=''){
			$update	= mysql_query("UPDATE d_sispen SET kdfungsi='$fungsi',kdsfungsi='$sfung',kdprogram='$prog',kdgiat='$giat',kdsgiat='$sgiat',kdctarik='$ctarik',kdsdana='$sdana',kddekon='$dekon' WHERE kdntpp='$ntpn'");
						
			$query	= mysql_query("SELECT DISTINCT kdntpp,nmwajbay,kdnpwp,kddept,kdunit,kdsatker,kdfungsi,kdsfungsi,kdprogram,kdgiat,kdsgiat,kdctarik,kdsdana,kddekon,kdmap FROM d_sispen WHERE kdntpp='$ntpn' AND LEFT(kdmap,1)='$Akun' ORDER BY kdmap");	
			while($r	= mysql_fetch_array($query)) {	
			
			$ntpn		= $r['kdntpp'];
			$wp		= $r['nmwajbay'];
			$akun		= $r['kdmap'];
			$fungsi	= $r['kdfungsi'];
			$sfung	= $r['kdsfungsi'];
			$prog		= $r['kdprogram'];
			$giat		= $r['kdgiat'];
			$sgiat	= $r['kdsgiat'];
			$ctarik	= $r['kdctarik'];
			$sdana	= $r['kdsdana'];
			$dekon	= $r['kddekon'];

			echo "<table cellpadding='1' cellspacing='1' border='1' align='center' valign='middle' width='80%'>
			<tr align='middle' valign='middle'>
			<td width='5%' align='center' valign='middle' nowrap='nowrap'>$i</td>
			<td width='19%' align='center' valign='middle' nowrap='nowrap'>$ntpn</td>
			<td width='44%' align='center' valign='middle' nowrap='nowrap'>$wp</td>
			<td width='8%' align='center' valign='middle' nowrap='nowrap'>$akun</td>
			<td width='5%' align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdfungsi$i' value='$fungsi' size='2' maxlength='2' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdsfung$i' value='$sfung' size='2' maxlength='2' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdprogram$i' value='$prog' size='2' maxlength='2' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdgiat$i' value='$giat' size='2' maxlength='2' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdsgiat$i' value='$sgiat' size='2' maxlength='4' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdctarik$i' value='$ctarik' size='2' maxlength='1' readonly='readonly' /></td>
			<td width='5%'  align='center' valign='middle' nowrap='nowrap'><input type='text' name='kdsdana$i' value='$sdana' size='2' maxlength='2' readonly='readonly' /></td>
			<td align='center' valign='middle' nowrap='nowrap'><input type='text' name='kddekon$i' value='$dekon' size='2' maxlength='2' readonly='readonly' /></td>";
			}	

			echo "</tr>
			</table>";
		}
	}
}
mysql_close($link);
echo '<br />
<center><input type="button" name="button" value="Kembali" onclick="history.go(-2)" /></center>';
?>		
		