<?php 

session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{

  ob_start();	
  session_start();
  // Panggil semua fungsi yang dibutuhkan (semuanya ada di folder config)
	include "config/class.phpencoder.php";
  	include_once "config/koneksi.php";
 	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
  	include "config/helper.php";
	include "config/fungsi_seo.php";
  	  
  // Memilih template yang aktif saat ini
  $pilih_template=mysql_query("SELECT folder FROM templates WHERE aktif='Y'");
  $f=mysql_fetch_array($pilih_template);
  include "$f[folder]/template.php"; 
  }
  
?>
