<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
//~ include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus sub menu
if ($module=='submenu' AND $act=='hapus'){
  mysql_query("DELETE FROM submenu WHERE id_sub='$_GET[id]'");
  
	  echo "<script type='text/javascript'>
	  window.location.href='../../media.php?module=".$module."';
	  </script>";
}

// Input sub menu
elseif ($module=='submenu' AND $act=='input'){
    mysql_query("INSERT INTO submenu(nama_sub,
                                    id_main,
				    seksi,
                                    link_sub) 
                            VALUES('$_POST[nama_sub]',
                                   '$_POST[menu_utama]',
				   '$_POST[seksi]',
                                   '$_POST[link_sub]')");
  
	  echo "<script type='text/javascript'>
	  window.location.href='../../media.php?module=".$module."';
	  </script>";
}

// Update sub menu
elseif ($module=='submenu' AND $act=='update'){
    mysql_query("UPDATE submenu SET nama_sub  = '$_POST[nama_sub]',
                                   id_main = '$_POST[menu_utama]',
				   seksi = '$_POST[seksi]',
                                   link_sub  = '$_POST[link_sub]'  
                             WHERE id_sub   = '$_POST[id]'");
  
	  echo "<script type='text/javascript'>
	  window.location.href='../../media.php?module=".$module."';
	  </script>";
}
}
?>
