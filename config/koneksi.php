<?php
$database = "kppn_monitor";
$link = mysql_connect('localhost:3377','adminmonitor2012','4dm1nMonitor');
      if(!$link){
	      die('Could not connect: ' .mysql_error());
	  }

// Koneksi dan memilih database di server
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
