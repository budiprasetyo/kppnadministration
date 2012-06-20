<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include dirname(dirname(dirname(dirname(__FILE__)))) . "/config/koneksi.php";

	$module=$_POST['simpanipserver'];

	// Simpan IP Server
	if ($module=='Simpan'){
	  
	  $n	= $_POST['jumldata'];
	  for($i=1;$i<=$n;$i++){
	  $ipserver	= $_POST['ipserver'.$i];
		if($i == 1){
			// nama folder SimpleClassCms diubah menjadi display
			// ubah ip server webservice
			
			$handle	= @fopen(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/SimpleClassCms/conf/ip.php","w");
			$text	= "<?php
						// Include DAL
						require_once(dirname(dirname(__FILE__)) . '/inc/class/DAL.php');
						// Include config
						require_once(dirname(dirname(__FILE__)) . '/conf/config.php');

						// ip
						define ( 'DB_HOST', '".$ipserver.":3306' );
						?>";
			fwrite($handle, $text);
			fclose($handle);
			
			// ubah ip server webservice penerimaan
			$handle	= @fopen(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/penerimaan/ip.php","w");
			$text	= "<?php
						\$host = '".$ipserver.":3306';
						?>";
			fwrite($handle, $text);
			fclose($handle);
			
			// ubah ip server webservice realisasi
			$handle	= @fopen(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/realisasi/includes/ip.php","w");
			$text	= "<?php
						\$host = '".$ipserver.":3306';
						?>";
			fwrite($handle, $text);
			fclose($handle);
			
			// ubah ip server aplikasi monitoring dan administrasi
			$handle	= @fopen(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/monitor/config/ip.php","w");
			$text	= "<?php
						\$host = '".$ipserver.":3306';
						?>";
			fwrite($handle, $text);
			fclose($handle);
			
			header("location:../../media.php?module=ipserver");
		}
		elseif($i == 2){
			echo "aplikasi: " . $ipserver;
		}
	  }
	 
	}
}
?>
