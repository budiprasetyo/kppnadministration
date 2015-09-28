<?php
require_once(dirname(dirname(__FILE__)) . '/config/class.phpencoder.php');
$PhpEncoder = new CPhpEncoder();

include_once "ip.php";
$database = "sqldb12";
$link = mysql_connect($host,'adminmonitor2012','4dm1nMonitor2012');
      if(!$link){
	      die('Could not connect: ' .mysql_error());
	  }

// Koneksi dan memilih database di server
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
