<?php

include "ip.php";
$database = "sqldb13";
$link = mysql_connect($host,'root','M3t@m0rph');
      if(!$link){
	      die('Could not connect: ' .mysql_error());
	  }

// Koneksi dan memilih database di server
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
