<?php
// Modul Form Search Data Konfirmasi Sispen =================================================================================//
if($_GET['module']=='konfirmasipenerimaan'){
	
	include_once("config/koneksisp2d13.php");
	$username	= $_SESSION[namauser];
     echo "<script type=\"text/javascript\">
	     $(document).ready(function() {
		$('#tanggal').datepicker();
	});
     </script>
     <div id='stylized' class='myform'>
	     <form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
		     <h1>Form multikategori konfirmasi data penerimaan</h1>
		     <p>Form ini digunakan dalam penayangan data konfirmasi penerimaan</p>
		     
			<label>Kode Satker</label>
			<input type='checkbox' class='checkbox' name='kdsatkerCek' />
			<input type='text' id='kdsatker' name='kdsatker' maxlength='6' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'nmwajbay')\" />
				     
		     <label>Nama WP</label>
		     <input type='checkbox' class='checkbox' name='nmwajbayCek' />
		     <input type='text' id='nmwajbay' name='nmwajbay' maxlength='30' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'kdnpwp')\" />
		     
		     <label>NPWP</label>
		     <input type='checkbox' class='checkbox' name='kdnpwpCek' />
		     <input type='text' id='kdnpwp' name='kdnpwp' maxlength='15' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdmap')\" />
		     
		     <label>Akun</label>
		     <input type='checkbox' class='checkbox' name='kdmapCek' />
		     <input type='text' id='kdmap' name='kdmap'  maxlength='6' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdntpp')\" />
		     
		     <label>NTPN</label>
		     <input type='checkbox' class='checkbox' name='kdntppCek' />
		     <input type='text' id='kdntpp' name='kdntpp' maxlength='16' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'kdbankpos')\" />
		     
		     <label>Kode Bank/Pos</label>
		     <input type='checkbox' class='checkbox' name='kdbankposCek' />
		     <select name='kdbankpos' id='kdbankpos' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'tanggal')\">
				     <option selected='selected'>-- Pilih Kode Bank/Pos --</option>";
				     $qNmbankpos	= mysql_query("SELECT DISTINCT kdbankpos,nmbankpos FROM t_banpos ORDER BY kdbankpos")or die(mysql_error);
				     while($rNmbankpos	= mysql_fetch_row($qNmbankpos)){
				     		echo "<option value='$rNmbankpos[0]'>$rNmbankpos[0] - $rNmbankpos[1]</option>";			
				     }
			echo "</select>	     
		     
			<label>Tgl. Buku</label>
			<input type='checkbox' class='checkbox' name='tgbukuCek' />
			<input type='text' id='tanggal' name='tgbuku' maxlength='10' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'nilsetor')\" />
					
			<label>Jumlah</label>
			<input type='checkbox' class='checkbox'  name='nilsetorCek' />
			<input type='text' id='nilsetor' name='nilsetor' maxlength='15' onkeypress='return handleEnter(this,event)' onkeyup=\"moveOnMax(this,'submit')\" />
		     
			<input type='hidden' name='username' value='$username' />
			<input type='submit' value='Tayang' class='button' id='submit' name='tampilkanpenerimaan' />
		<div class='spacer'></div>
     	</form>
	</div>";
     }

     // Modul  Search Arsip SP2D----------------------------------------------------------------------------------------------------------------------------------------------//
elseif($_POST['tampilkanpenerimaan'] == "Tayang"){
     $kdsatkerCek		= $_POST['kdsatkerCek'];
     $nmwajbayCek	= $_POST['nmwajbayCek'];
     $kdnpwpCek		= $_POST['kdnpwpCek'];
     $kdmapCek		= $_POST['kdmapCek'];
     $kdntppCek		= $_POST['kdntppCek'];
     $kdbankposCek	= $_POST['kdbankposCek'];
     $tgbukuCek		= $_POST['tgbukuCek'];
     $nilsetorCek		= $_POST['nilsetorCek'];
     $kdsatker		= $_POST['kdsatker'];
     $nmwajbay	= $_POST['nmwajbay'];
     $kdnpwp		= $_POST['kdnpwp'];
     $kdmap		= $_POST['kdmap'];
     $kdntpp		= $_POST['kdntpp'];
     $kdbankpos	= $_POST['kdbankpos'];
     $nilsetor		= $_POST['nilsetor'];
     $username	= $_POST['username'];
     $TgBuku		= $_POST['tgbuku'];
     $Tgbuku		= explode("/",$TgBuku);
     $TgBUKU		= $Tgbuku[0];
     $BlBUKU		= $Tgbuku[1];
     $ThBUKU		= $Tgbuku[2];
     $tgbuku		= $ThBUKU."-".$BlBUKU."-".$TgBUKU;
     if ($ThBUKU == '2013')
     {
		include_once("config/koneksisp2d13.php");
	 }
	 else
	 {
		include_once("config/koneksisp2d.php");
	 }
     $bagianWhere="";
     
     if(isset($kdsatkerCek)){
     		$kdsatker;
		if(empty($bagianWhere)){
		$bagianWhere .= "a.kdsatker='$kdsatker'";
		}
     }
     
     if(isset($nmwajbayCek)){
     		if(empty($bagianWhere)){
				$bagianWhere .= "a.nmwajbay REGEXP '$nmwajbay'";
			}
   		else{
				$bagianWhere .= "AND a.nmwajbay REGEXP '$nmwajbay'";
     		}
     }
     
     if(isset($kdnpwpCek)){
		if(empty($bagianWhere)){
				$bagianWhere .= "a.kdnpwp='$kdnpwp'";
    		 }
     		else{
				$bagianWhere .= "AND a.kdnpwp='$kdnpwp'";
     		}
     }
     
     if(isset($kdmapCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "a.kdmap='$kdmap'";
		}
		else{
			$bagianWhere .= "AND a.kdmap='$kdmap'";
		}
     }
     
     if(isset($kdntppCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "a.kdntpp='$kdntpp'";
		}
		else{
			$bagianWhere .= "AND a.kdntpp='$kdntpp'";
		}
     }
     
     if(isset($kdbankposCek)){
		if(empty($bagianWhere)){
				$bagianWhere .= "a.kdbankpos='$kdbankpos'";
		}
		else{
				$bagianWhere .= "AND a.kdbankpos='$kdbankpos'";
		}
     }
     
     if(isset($tgbukuCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "a.tgbuku='$tgbuku'";
		}
		else{
			$bagianWhere .= "AND a.tgbuku='$tgbuku'";
		}
     }
     
     if(isset($nilsetorCek)){
		if(empty($bagianWhere)){
			$bagianWhere .= "a.nilsetor='$nilsetor'";
		}
		else{
			$bagianWhere .= "AND a.nilsetor='$nilsetor'";
		}
     }
     
     $queryCek	= "SELECT a.kdsatker, a.nmwajbay, a.kdnpwp, a.kdmap, a.kdntpp, a.kdntb, a.kdbankpos, a.tgbuku, a.nilsetor FROM d_sispen a WHERE ".$bagianWhere;
     $qCek		= mysql_query($queryCek)or die(mysql_error());
     $rCek		= mysql_fetch_row($qCek);
     
     if($rCek > 0){
     
     echo "<div id='stylized' class='myform'>
	     <form id='form' name='formShowDataPenerimaan' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
		     <h1>Form hasil data konfirmasi</h1> 
		     <p>Hasil data konfirmasi</p>
	     </form>
     </div>
     <br />	
				     
    <form name='form1' method='post' action='report/reportpenerimaan.php'>
     <table class='normaltable' border='0'>
	     <tr>
		     <th width='6%' height='40'>No.</th>
		     <th width='10%'>NPWP</th>
		     <th width='15%'>Nama WP</th>
		     <th width='15%'>NTPN - NTB</th>
		     <th width='10%'>Bank/Pos</th>
		     <th width='10%'>Tgl. Buku</th>
		     <th width='10%'>Akun</th>
		     <th width='10%'>Jumlah Setor</th>
		     <th width='5%'>Cek</th>
	     </tr>";
	     
	     $query		= "SELECT a.kdsatker, a.nmwajbay, a.kdnpwp, a.kdmap, a.kdntpp, a.kdntb, a.kdbankpos, date_format(a.tgbuku,'%d-%m-%Y') as tgbuku, format(a.nilsetor,0) as nilsetor, b.nmbankpos FROM d_sispen a LEFT JOIN t_banpos b ON a.kdbankpos=b.kdbankpos WHERE ".$bagianWhere." ORDER BY a.tgbuku";
	     $qCari		= mysql_query($query)or die(mysql_error());
	     $no	= 1;
	     $oddcol		= "#CCFF99";
	     $evencol		= "#CCDD88";
	     while($rCari		= mysql_fetch_array($qCari)){
	     if($no % 2 == 0) {$color = $evencol;}
	     else{$color = $oddcol;}
	     $kdsatker		= $rCari['kdsatker'];
	     $nmwajbay	= $rCari['nmwajbay'];
	     $kdnpwp		= $rCari['kdnpwp'];
	     $kdmap		= $rCari['kdmap'];
	     $kdntpp		= $rCari['kdntpp'];
	     $kdntb		= $rCari['kdntb'];
	     $kdbankpos	= $rCari['kdbankpos'];
	     $tgbuku		= $rCari['tgbuku'];
	     $nilsetor		= $rCari['nilsetor'];
	     $nmbankpos	= $rCari['nmbankpos'];
	     
	     echo"<tr bgcolor='$color'>
		     <td height='60'>$no</td>
		     <td>$kdnpwp</td>
		     <td>$nmwajbay</td>
		     <td>$kdntpp - $kdntb</td>
		     <td>$nmbankpos</td>
		     <td>$tgbuku</td>
		     <td>$kdmap</td>
		     <td>$nilsetor</td>
		     <td><input type='checkbox' class='checkbox'  name='cetak$no' value='$no' />
	     </tr>";
	     $no++;
	     }
	     echo"</table>";
			    $n	= 1;
				$qData	= mysql_query($query)or die(mysql_error);
				while($rData	= mysql_fetch_array($qData)){
					$kdsatker	=$rData['kdsatker'];
					$nmwajbay	=$rData['nmwajbay'];
					$kdnpwp	=$rData['kdnpwp'];
					$kdmap	=$rData['kdmap'];
					$kdntpp	=$rData['kdntpp'];
					$kdntb		= $rData['kdntb'];
					$kdbankpos=$rData['kdbankpos'];
					 $nilsetor	=$rData['nilsetor'];
					 $tgbuku	=$rData['tgbuku'];
					 $nmbankpos= $rData['nmbankpos'];
					 echo "<input type='hidden' name='kdsatker$n' value='$kdsatker' />	
			   		     <input type='hidden' name='nmwajbay$n' value='$nmwajbay' />	
					     <input type='hidden' name='kdnpwp$n' value='$kdnpwp' />	
					     <input type='hidden' name='kdmap$n' value='$kdmap' />	
					     <input type='hidden' name='kdntpp$n' value='$kdntpp' />	
					     <input type='hidden' name='kdntb$n' value='$kdntb' />
					     <input type='hidden' name='kdbankpos$n' value='$kdbankpos' />	
					     <input type='hidden' name='nmbankpos$n' value='$nmbankpos' />
					     <input type='hidden' name='nilsetor$n' value='$nilsetor' />	
					     <input type='hidden' name='tgbuku$n' value='$tgbuku' />
					     <input type='hidden' name='username$n' value='$username' />";
			     $n++;
				}
				$n=$n-1;
			     echo "<input type='hidden' name='jumldata' value='$n' />
				<input type='submit' value='Cetak' class='button1' id='submit' name='cetakpenerimaan' onClick=\"this.form.target='_blank'; return true;\"  />
			     </form>";
     
     }
     else{
     echo "<script type='text/javascript'>
	     alert('Data tersebut tidak ditemukan');
	     window.location.replace('media.php?module=konfirmasipenerimaan');
     </script>";			
     }
}	

