<?php 

session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script type='text/javascript'>
		  window.location.replace('index.php');
  	</script>";
}
else{

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Aplikasi Intern KPPN</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta http-equiv="Copyleft" content="Budi Prasetyo">
<meta name="author" content="metamorph" >
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="shortcut icon" href="favicon.gif" />
<link href="<?php echo "templates/style.css" ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="config/fungsi_input.js"></script>
<link href="jQueryUI/development-bundle/themes/trontastic/jquery.ui.all.css" rel="stylesheet"type="text/css" />
<script type="text/javascript" src="jQueryUI/development-bundle/jquery-1.5.1.js"></script>
<script type="text/javascript" src="jQueryUI/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="jQueryUI/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="jQueryUI/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="jQueryUI/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="jQueryUI/development-bundle/ui/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="jQueryUI/development-bundle/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="jQueryUI/jquery.validate.js"></script>
</head>

<body>
<div id="wrapper">
  <div id="container">
  <div id="header">
    <div id="menu">
      <?php include "topmenu.php"; ?>
    </div>
  </div>
  </div>
  <div id="leftcontent">
    <p>
      <?php  
			$helper	= new helper();
		    include "kiri.php"; 
		    include "kiriskpp1.php";
		    include "kirikonfirmasi.php";
		    include "kirisurat.php";
		    include "kirisatker.php";
    ?>
    </p>
  </div>
  <div id="rightcontent">
    <p>
      <?php    include "kanan.php"; ?>
    </p>
  </div>
  <div id="clearer"></div>
  <div id="footer">Copyleft 
			<span style="transform:rotate(180deg);
					-webkit-transform:rotate(180deg);
					-moz-transform:rotate(180deg);
					-o-transform:rotate(180deg);
					filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=2); 
					display: inline-block;">&copy;
			</span> 2012 Direktorat Sistem Perbendaharaan. All wrongs reserved.</div>
</div>
</body>
</html>

<?php
mysql_close($link);
}
?>
