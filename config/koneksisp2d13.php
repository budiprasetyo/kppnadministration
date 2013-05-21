<?php

include "ip.php";
$database = "sqldb13";
$link = mysql_connect($host,'adminmonitor2012','4dm1nMonitor2012');
      if(!$link){
	      die('Could not connect: ' .mysql_error());
	  }

// Koneksi dan memilih database di server
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
