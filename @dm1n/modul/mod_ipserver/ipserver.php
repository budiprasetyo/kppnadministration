<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_ipserver/aksi_ipserver.php";
switch($_GET['module']){
  // 
  case "ipserver":
    echo "<h2>IP Server</h2>
          <table>
          <tr><th>no</th><th>server</th><th>ip</th></tr>";
    $i			= 0;
    $no			= $i+1;
    $server 	= array();
    $server[0]	= "SP2D";
    $server[1]	= "Administration & Monitoring Tools";
    while ($i < 1){
      echo "<form name='ipserver' method='post' action='" . $aksi . "'>
				<tr>
				<td>$no</td>
                <td>$server[$i]</td>
                <td><input type='text' name='ipserver$no' id='ipserver' maxlength='15' /></td> 
		        </tr>";
    $i++;
    $no++;
    }
    $jumldata	= $no - 1;
	echo "<tr>
	            <td colspan='3' align='center'>
					<input type='hidden' name='jumldata' id='jumldata' value='$jumldata' />
					<input type='submit' id='submit' name='simpanipserver' value='Simpan' />
				</td>
			</tr>
	</form>
	</table>";
    break;
   
	}
}
?>
