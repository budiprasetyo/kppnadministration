<?php
$database = "sqldb11";
$link = mysql_connect('127.0.0.1:3306','budi','M3t@m0rph');
      if(!$link){
	      die('Could not connect: ' .mysql_error());
	  }

// Koneksi dan memilih database di server
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
