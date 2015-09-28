<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Monitoring Laporan KPPN</title>
		<style type="text/css">
		.wrapper {background:#eee;padding:5px;}
		.wrapper p {
			width: 100%;
			font:normal 26px verdana;
			text-align: center;
			text-shadow: #505050 0.075em 0.075em 0.075em;
			}
		.wrapper h3 {
			font:normal 18px verdana;
			text-align: center;
			margin-top: -15px;
			}

		a img {border:0;vertical-align:text-bottom;}
		a {
			text-decoration:none;
			color: #FFFFFF;
		}
		table {
			border-collapse:collapse;
			margin-left:10px;
			}

		th {
			height:30px;
			border-right:1px solid #fff;
			color:#fff;
			font:normal 14px arial;
			letter-spacing:2px;
			background: #808080;
			}
		td {
			text-align:center;
			background:transparent url(image/bg_td_ordinary.gif) repeat-x bottom left;
			border-right:1px solid #fff;
			color:#fff;
			width:180px;
			height:40px;
			font:bold 12px/18px verdana;
		}
		td.seksi {
			text-align:left;
			padding-left: 20px;
			background:transparent url(image/bg_td_seksi.gif) repeat-x bottom left;
			border-right:1px solid #fff;
			color:#fff;
			width:180px;
			height:40px;
			font:bold 16px verdana;
		}
		td.periode{
			padding-left: 40px;
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#EA7815), to(#F2994B));
			background-image: -webkit-linear-gradient(top, #EA7815, #F2994B); 
			background-image:    -moz-linear-gradient(top, #EA7815, #F2994B);
			background-image:     -ms-linear-gradient(top, #EA7815, #F2994B);
			background-image:      -o-linear-gradient(top, #EA7815, #F2994B);
			font: bold italic 14px verdana;
			text-align: left;
		}
		td.nama_laporan{
			width:230px;
			overflow:hidden;
			display:inline-block;
			font-size: 11px;
			font-weight: bold;
		}

		td.belum{
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#600C02), to(#D3594C));
			background-image: -webkit-linear-gradient(top, #600C02, #D3594C); 
			background-image:    -moz-linear-gradient(top, #600C02, #D3594C);
			background-image:     -ms-linear-gradient(top, #600C02, #D3594C);
			background-image:      -o-linear-gradient(top, #600C02, #D3594C);
		}
		td.terlambat {
			text-align:center;
			background:transparent url(image/bg_td_late.gif) repeat-x bottom left;
			border-right:1px solid #fff;
			color:#fff;
			width:180px;
			height:40px;
			font:bold 12px/18px verdana;
		}
		td.selesai {
			text-align:center;
			background:transparent url(image/bg_td_finish.gif) repeat-x bottom left;
			border-right:1px solid #fff;
			color:#fff;
			width:180px;
			height:40px;
			font:bold 12px/18px verdana;
		}

		td.on {background:transparent url(image/bg_td_on.gif) no-repeat bottom left;}
		th.on {
			background:transparent url(image/bg_th_on.gif) no-repeat bottom left;
			padding-bottom:9px;
			width:148px;
		}

		tfoot td {
			background:transparent url(image/bg_td_ordinary.gif) repeat-x top left;
			vertical-align:top;
			padding-top:8px;
		}
		tfoot td.on {
			background:transparent url(image/bg_foot_td_on.gif) no-repeat top left;
			padding-top:16px;
		}
		tfoot td.side {background: transparent url(image/bg_foot_td_side.gif) no-repeat top left;}

		
		#row_upload {
			text-decoration: none;
			position:relative;
			display:block;
			color:#FFFFFF;
		}
		#detail_upload {
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#404040), to(#808080));
			background-image: -webkit-linear-gradient(top, #404040, #808080); 
			background-image:    -moz-linear-gradient(top, #404040, #808080);
			background-image:     -ms-linear-gradient(top, #404040, #808080);
			background-image:      -o-linear-gradient(top, #404040, #808080);
			zoom: 1;
			filter: alpha(opacity=85);
			opacity: 0.85;
			position:absolute;
			font-size:10px;
			padding: 4px;
			width:180px;
			height:100px;
			display:none;
			color:#FFFFFF;
		}
		#row_upload:hover #detail_upload {
			color: #FFFFFF;
			display:block;
			left:-100px;
		}

		</style>

		<link href='<?php echo dirname(dirname(__FILE__))."/jQueryUI/development-bundle/themes/trontastic/jquery.ui.all.css"; ?>' rel="stylesheet"type="text/css" />
		<script type="text/javascript" src='<?php echo dirname(dirname(__FILE__))."/jQueryUI/development-bundle/jquery-1.5.1.js"; ?>'></script>
		<script type="text/javascript" src='<?php echo dirname(dirname(__FILE__))."/jQueryUI/development-bundle/ui/jquery.ui.core.js"; ?>'></script>
		<script type="text/javascript" src='<?php echo dirname(dirname(__FILE__))."/jQueryUI/development-bundle/ui/jquery.ui.widget.js"; ?>'></script>		
		<script type="text/javascript" src='<?php echo dirname(dirname(__FILE__))."/jQueryUI/development-bundle/ui/jquery.ui.datepicker.js"; ?>'></script>
		<script type="text/javascript" src='<?php echo dirname(dirname(__FILE__))."/jQueryUI/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"; ?>'></script>
		
		<script type="text/javascript">
		/*
			$(document).ready(function() {
				$(document ).tooltip({
					position: {
							my: "center bottom-20",
							at: "center top",
							using: function( position, feedback ) {
							$( this ).css( position );
							$( "<div>" )
							.addClass( "arrow" )
							.addClass( feedback.vertical )
							.addClass( feedback.horizontal )
							.appendTo( this );
						}
					}
				});
			});
		*/
				$(document).ready(function() {
					$('#tanggal').datepicker({
							changeMonth: true,
							changeYear: true
						});
					});
				$(document).ready(function() {
					$('#tanggal1').datepicker({
							changeMonth: true,
							changeYear: true
						});
					});
		</script>
		 <style>
			.ui-tooltip, .arrow:after {
				background: black;
				border: 2px solid white;
			}
			.ui-tooltip {
				padding: 10px 20px;
				color: white;
				border-radius: 20px;
				font: bold 14px "Helvetica Neue", Sans-Serif;
				text-transform: uppercase;
				box-shadow: 0 0 7px black;
			}
			.arrow {
				width: 70px;
				height: 16px;
				overflow: hidden;
				position: absolute;
				left: 50%;
				margin-left: -35px;
				bottom: -16px;
			}
			.arrow.top {
				top: -16px;
				bottom: auto;
			}
			.arrow.left {
				left: 20%;
			}
			.arrow:after {
				content: "";
				position: absolute;
				left: 20px;
				top: -20px;
				width: 25px;
				height: 25px;
				box-shadow: 6px 5px 9px -9px black;
				-webkit-transform: rotate(45deg);
				-moz-transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				-o-transform: rotate(45deg);
				tranform: rotate(45deg);
			}
			.arrow.top:after {
				bottom: -20px;
				top: auto;
			}
		</style>
</head>
<body>

<div class="wrapper">
<?php
// call helper class
include_once(dirname(dirname(__FILE__)) .  "/config/helper.php");
$helper		= new helper();
$year		= date("Y");

?>
<p>Monitoring Pengiriman Laporan KPPN</p>
<h3>Tahun Anggaran <?php echo $year; ?></h3>
<table id="monitoringaplikasi">
	<thead>
		<tr>
			<th rowspan = "2">No.</th>
			<th rowspan = "2">Nama Laporan</th>
			<th colspan = "12">Bulan</th>
		</tr>
		<tr>
			<th>Jan</th>
			<th>Feb</th>
			<th>Mar</th>
			<th>Apr</th>
			<th>Mei</th>
			<th>Jun</th>
			<th>Jul</th>
			<th>Ags</th>
			<th>Sep</th>
			<th>Okt</th>
			<th>Nop</th>
			<th>Des</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td class="choiceA"><!-- <a href="#" onclick="activateThisColumn('choiceA');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceB"><!-- <a href="#" onclick="activateThisColumn('choiceB');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
			<td class="choiceC"><!-- <a href="#" onclick="activateThisColumn('choiceC');return false;"><img src="image/choose.gif" /></a> --></td>
		</tr>
	</tfoot>
	<tbody>
		<?php
		require_once(dirname(dirname(__FILE__)) . "/config/koneksi.php");
			$parents 	= array();
			$childs 	= array();
			$q	= mysql_query("SELECT b.idseksi,b.id_periode,b.nama_laporan,a.id_monitoring_laporan,a.id_laporan,a.01,a.02,a.03,a.04,a.05,a.06,a.07,a.08,a.09,a.10,a.11,a.12,
								a.file_01,a.file_02,a.file_03,a.file_04,a.file_05,a.file_06,a.file_07,a.file_08,a.file_09,a.file_10,a.file_11,a.file_12,
								a.tgl_01,a.tgl_02,a.tgl_03,a.tgl_04,a.tgl_05,a.tgl_06,a.tgl_07,a.tgl_08,a.tgl_09,a.tgl_10,a.tgl_11,a.tgl_12,
								a.user_01,a.user_02,a.user_03,a.user_04,a.user_05,a.user_06,a.user_07,a.user_08,a.user_09,a.user_10,a.user_11,a.user_12
								FROM d_monitoring_laporan a JOIN r_laporan b WHERE a.id_laporan = b.id_laporan");

			while($h	= mysql_fetch_array($q)){	
			
			// status warna setiap row
			// status tgl_01
			if($h['tgl_01'] == '0000-00-00')
			{
				$status_01 = "<td class = 'belum'>";
			}
			else
			{
				$status_01 = "<td class = 'selesai'>";
			}
			// status tgl_02
			if($h['tgl_02'] == '0000-00-00')
			{
				$status_02 = "<td class = 'belum'>";
			}
			else
			{
				$status_02 = "<td class = 'selesai'>";
			}
			// status tgl_03
			if($h['tgl_03'] == '0000-00-00')
			{
				$status_03 = "<td class = 'belum'>";
			}
			else
			{
				$status_03 = "<td class = 'selesai'>";
			}
			// status tgl_04
			if($h['tgl_04'] == '0000-00-00')
			{
				$status_04 = "<td class = 'belum'>";
			}
			else
			{
				$status_04 = "<td class = 'selesai'>";
			}
			// status tgl_05
			if($h['tgl_05'] == '0000-00-00')
			{
				$status_05 = "<td class = 'belum'>";
			}
			else
			{
				$status_05 = "<td class = 'selesai'>";
			}
			// status tgl_06
			if($h['tgl_06'] == '0000-00-00')
			{
				$status_06 = "<td class = 'belum'>";
			}
			else
			{
				$status_06 = "<td class = 'selesai'>";
			}
			// status tgl_07
			if($h['tgl_07'] == '0000-00-00')
			{
				$status_07 = "<td class = 'belum'>";
			}
			else
			{
				$status_07 = "<td class = 'selesai'>";
			}
			// status tgl_08
			if($h['tgl_08'] == '0000-00-00')
			{
				$status_08 = "<td class = 'belum'>";
			}
			else
			{
				$status_08 = "<td class = 'selesai'>";
			}
			// status tgl_09
			if($h['tgl_09'] == '0000-00-00')
			{
				$status_09 = "<td class = 'belum'>";
			}
			else
			{
				$status_09 = "<td class = 'selesai'>";
			}
			// status tgl_10
			if($h['tgl_10'] == '0000-00-00')
			{
				$status_10 = "<td class = 'belum'>";
			}
			else
			{
				$status_10 = "<td class = 'selesai'>";
			}
			// status tgl_11
			if($h['tgl_11'] == '0000-00-00')
			{
				$status_11 = "<td class = 'belum'>";
			}
			else
			{
				$status_11 = "<td class = 'selesai'>";
			}
			// status tgl_12
			if($h['tgl_12'] == '0000-00-00')
			{
				$status_12 = "<td class = 'belum'>";
			}
			else
			{
				$status_12 = "<td class = 'selesai'>";
			}
			
			// uraian seksi
			$q_seksi	= "SELECT uraianseksi FROM r_seksi WHERE idseksi = '".$h['idseksi']."'";
			$q_seksi	= mysql_query($q_seksi);
			$r_seksi	= mysql_fetch_object($q_seksi);
			// uraian periode
			$q_periode	= "SELECT periode FROM r_periode WHERE id_periode = '".$h['id_periode']."'";
			$q_periode	= mysql_query($q_periode);
			$r_periode	= mysql_fetch_object($q_periode);
			$periode_lap= ucfirst(strtolower($r_periode->periode));
			
			$seksi		= "<tr><td class='seksi' colspan='14'>{$r_seksi->uraianseksi}</td></tr>";
			$periode	= "<tr><td class='periode' colspan='14'>{$periode_lap}</td></tr>";
			
			$laporan	= "<td class = 'nama_laporan'>" . $h['nama_laporan'] . "</td>" . 
							$status_01 . "<div id = 'row_upload'><a href='../laporan/".$h['file_01']."' target='_blank'>" . $helper->dateMonth($h['tgl_01']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_01'].". Dientri ke database pada ".$h['01']."</div></div></td>" .
							$status_02 . "<div id = 'row_upload'><a href='../laporan/".$h['file_02']."' target='_blank'>" . $helper->dateMonth($h['tgl_02']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_02'].". Dientri ke database pada ".$h['02']."</div></div></td>" .
							$status_03 . "<div id = 'row_upload'><a href='../laporan/".$h['file_03']."' target='_blank'>" . $helper->dateMonth($h['tgl_03']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_03'].". Dientri ke database pada ".$h['03']."</div></div></td>" .
							$status_04 . "<div id = 'row_upload'><a href='../laporan/".$h['file_04']."' target='_blank'>" . $helper->dateMonth($h['tgl_04']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_04'].". Dientri ke database pada ".$h['04']."</div></div></td>" .
							$status_05 . "<div id = 'row_upload'><a href='../laporan/".$h['file_05']."' target='_blank'>" . $helper->dateMonth($h['tgl_05']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_05'].". Dientri ke database pada ".$h['05']."</div></div></td>" .
							$status_06 . "<div id = 'row_upload'><a href='../laporan/".$h['file_06']."' target='_blank'>" . $helper->dateMonth($h['tgl_06']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_06'].". Dientri ke database pada ".$h['06']."</div></div></td>" .
							$status_07 . "<div id = 'row_upload'><a href='../laporan/".$h['file_07']."' target='_blank'>" . $helper->dateMonth($h['tgl_07']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_07'].". Dientri ke database pada ".$h['07']."</div></div></td>" .
							$status_08 . "<div id = 'row_upload'><a href='../laporan/".$h['file_08']."' target='_blank'>" . $helper->dateMonth($h['tgl_08']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_08'].". Dientri ke database pada ".$h['08']."</div></div></td>" .
							$status_09 . "<div id = 'row_upload'><a href='../laporan/".$h['file_09']."' target='_blank'>" . $helper->dateMonth($h['tgl_09']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_09'].". Dientri ke database pada ".$h['09']."</div></div></td>" .
							$status_10 . "<div id = 'row_upload'><a href='../laporan/".$h['file_10']."' target='_blank'>" . $helper->dateMonth($h['tgl_10']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_10'].". Dientri ke database pada ".$h['10']."</div></div></td>" .
							$status_11 . "<div id = 'row_upload'><a href='../laporan/".$h['file_11']."' target='_blank'>" . $helper->dateMonth($h['tgl_11']) . "</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_11'].". Dientri ke database pada ".$h['11']."</div></div></td>" .
							$status_12 . "<div id = 'row_upload'><a href='../laporan/".$h['file_01']."' target='_blank'>";

			
			$parents[$seksi][$periode][$laporan] = $h['tgl_12'];
			
			}
		
		// array parents is here --
		
			
			foreach($parents as $seksi=>$seksiperiode)
			{
				echo $seksi;
				
				foreach($seksiperiode as $periode=>$laporans)
				{
					echo $periode;
					$i	= 1;
					foreach($laporans as $laporan=>$tgl_12)
					{
						echo "<tr><td>{$i}</td>{$laporan}". $helper->dateMonth($tgl_12) ."</a><div id = 'detail_upload'>Pengirim data ini adalah ".$h['user_12'].". Dientri ke database pada ".$h['12']."</div></div></td></tr>";
						$i++;
					}
					
				}
			}
		?>		
	</tbody>
</table>

</div>
</body>
</html>
