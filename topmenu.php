<?php    
// script ini berfungsi untuk mengatur menu-menu yang dapat diakses sesuai kewenangan user --------->
echo "<ul>";

// Administrator Menu yang khusus dapat diakses admin ---------------------------//
if($_SESSION[leveluser] == 'admin' && $_SESSION[seksi] == 'ALL'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='UM') 
							AND id_main!='8'
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='UM')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}

// Administrator Menu yang khusus dapat diakses Kepala Kantor---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'KK'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='KK')
							AND id_main!='17'
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='KK')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}

// Administrator Menu yang khusus dapat diakses Kepala Subag Umum---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'AUM'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='AUM')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='AUM')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
					<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
						
}


// Administrator Menu yang khusus dapat diakses Kepala Seksi Pencairan Dana---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'APD'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='APD')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='APD')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}


// Administrator Menu yang khusus dapat diakses Kepala Seksi Bank Giro Pos---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'ABP'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='ABP')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='ABP')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}

// Administrator Menu yang khusus dapat diakses Kasi Verifikasi dan Akuntansi---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'AVR'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='AVR')
							AND id_main!='17'
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='AVR')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}

// Administrator Menu yang khusus dapat diakses Pelaksana Umum---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'UM'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='UM')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='UM')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}

// Administrator Menu yang khusus dapat diakses Pelaksana Pencairan Dana---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'PD'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='PD')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='PD')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}


// Administrator Menu yang khusus dapat diakses Pelaksana Bank Giro dan Pos---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'BP'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='BP')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='BP')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}


// Administrator Menu yang khusus dapat diakses Pelaksana Verifikasi dan Akuntansi---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'VR'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND (seksi='ALL' OR seksi='VR')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='ALL'
					OR submenu.seksi='VR')
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
								}
							echo "</div>
						</div>";
}

// Satker Menu yang khusus dapat diakses oleh Satker---------------------------//
if($_SESSION[leveluser] == 'user' && $_SESSION[seksi] == 'STK'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu 
							WHERE aktif='Y' 
							AND seksi in ('ALL','STK')
							AND id_main not in ('10','13')
							ORDER BY id_main");
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND submenu.seksi='STK'
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
					<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case AUM:
										echo 'Kasubag Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case AVR:
										echo 'Kasi Vera';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case APD:
										echo 'Kasi Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ABP:
										echo 'Kasi Bank & Giro Pos';
										break;
									case ALL:
										echo 'Administrator';
										break;
									case KK:
										echo 'Kepala Kantor';
										break;
									case STK:
										echo 'Satuan Kerja';
										break;
								}
							echo "</div>
						</div>";
						
}


/*

// Administrator & Seksi Verifikasi dan Akuntansi, Admin, Menu yang khusus dapat diakses semua user ==============//
if($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'VR'){

	if($_SESSION[seksi] == 'VR'){
		$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL' OR seksi='VR') ORDER BY id_main");
	}
	elseif($_SESSION[seksi] == 'ALL'){
		$main=mysql_query("SELECT DISTINCT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL' OR seksi='UM') ORDER BY id_main");
	}
		while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
			<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND submenu.id_sub!='45'
					AND (submenu.seksi='VR'
					OR submenu.seksi='ALL'
					OR submenu.seksi='UM'
					OR (submenu.id_main='4'
					AND submenu.nama_sub NOT LIKE '%surat%masuk%'))
					ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
			echo "</ul>
			</li>";
			}       
			echo "<style type='text/css'>
					#welcome
						{
							font-weight:bold;
							color: #FF6600;
							padding-top:9px;
							margin-left:650px;
						}
					#welcome #user
						{
							display:inline;
							font-style:italic;
							color: #FFFFFF;
						}
					#welcome #seksi
						{
							display:inline;
							font-style:italic;
							color: #FFFF00;
						}
					</style>
						<div id='welcome'>Username:  
							<div id='user'>"
								. $_SESSION[namauser]  .
							"</div>
							 Seksi: <div id='seksi'>";
								switch($_SESSION[seksi]){
									case UM:
										echo 'Sub Bagian Umum';
										break;
									case VR:
										echo 'Verifkasi & Akuntansi';
										break;
									case PD:
										echo 'Pencairan Dana';
										break;
									case BP:
										echo 'Bank & Giro Pos';
										break;
									case ALL:
										echo 'Sub Bagian Umum';
										break;

								}
							echo "</div>
						</div>";
	}

// Seksi Sub Bagian Umum, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'UM'){
		$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL' OR seksi='UM') ORDER BY id_main");
			
		while($r=mysql_fetch_array($main)){
			echo "<li><a href='$r[link]'>$r[nama_menu]</a>
					<ul>";
			$sub=mysql_query("SELECT * FROM submenu, mainmenu  
					WHERE submenu.id_main=mainmenu.id_main 
					AND submenu.id_main=$r[id_main]
					AND (submenu.seksi='UM'
					OR submenu.seksi='ALL')
					ORDER BY submenu.id_sub");
			while($w=mysql_fetch_array($sub)){
				echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
			}
			echo "</ul>
					</li>";
		}        
		echo "<style type='text/css'>
#welcome
		{
			font-weight:bold;
		color: #FF6600;
		padding-top:9px;
		margin-left:650px;
}
#welcome #user
		{
			display:inline;
		font-style:italic;
		color: #FFFFFF;
}
#welcome #seksi
		{
			display:inline;
		font-style:italic;
		color: #FFFF00;
}
		</style>
						<div id='welcome'>Username:  
				<div id='user'>"
				. $_SESSION[namauser]  .
				"</div>
				Seksi: <div id='seksi'>";
		switch($_SESSION[seksi]){
			case UM:
				echo 'Sub Bagian Umum';
				break;
			case VR:
				echo 'Verifkasi & Akuntansi';
				break;
			case PD:
				echo 'Pencairan Dana';
				break;
			case BP:
				echo 'Bank & Giro Pos';
				break;
		}
		echo "</div>
				</div>";
}

//Seksi Pencairan Dana, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'PD'){
	$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL' OR seksi='PD') ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				AND (submenu.seksi='PD'
				OR submenu.seksi='ALL')
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
			#welcome
				{
					font-weight:bold;
				color: #FF6600;
				padding-top:9px;
				margin-left:650px;
					}
			#welcome #user
				{
					display:inline;
				font-style:italic;
				color: #FFFFFF;
					}
			#welcome #seksi
				{
					display:inline;
				font-style:italic;
				color: #FFFF00;
					}
				</style>
			<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
		switch($_SESSION[seksi]){
			case UM:
				echo 'Sub Bagian Umum';
				break;
			case VR:
				echo 'Verifkasi & Akuntansi';
				break;
			case PD:
				echo 'Pencairan Dana';
				break;
			case BP:
				echo 'Bank & Giro Pos';
				break;
	}
	echo "</div>
		</div>";
}

//Seksi Bank dan Giro Pos, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'BP'){
	$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL' OR seksi='BP') ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				AND (submenu.seksi='BP'
				OR submenu.seksi='ALL')
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
			#welcome
				{
					font-weight:bold;
				color: #FF6600;
				padding-top:9px;
				margin-left:650px;
					}
			#welcome #user
				{
					display:inline;
				font-style:italic;
				color: #FFFFFF;
					}
			#welcome #seksi
				{
					display:inline;
				font-style:italic;
				color: #FFFF00;
					}
				</style>
			<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
		switch($_SESSION[seksi]){
			case UM:
				echo 'Sub Bagian Umum';
				break;
			case VR:
				echo 'Verifkasi & Akuntansi';
				break;
			case PD:
				echo 'Pencairan Dana';
				break;
			case BP:
				echo 'Bank & Giro Pos';
				break;
	}
	echo "</div>
		</div>";
}

// Kepala Seksi Pencairan Dana, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'APD'){
	$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL'  OR seksi='PD') ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				AND (submenu.seksi='APD'
				OR submenu.seksi='ALL')
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
			#welcome
			{
				font-weight:bold;
				color: #FF6600;
				padding-top:9px;
				margin-left:550px;
			}
			#welcome #user
			{
				display:inline;
				font-style:italic;
				color: #FFFFFF;
			}
			#welcome #seksi
			{
				display:inline;
				font-style:italic;
				color: #FFFF00;
			}
		</style>
			<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
			switch($_SESSION[seksi]){
					case UM:
						echo 'Sub Bagian Umum';
						break;
					case VR:
						echo 'Verifkasi & Akuntansi';
						break;
					case PD:
						echo 'Pencairan Dana';
						break;
					case BP:
						echo 'Bank & Giro Pos';
						break;
					case APD:
						echo 'Kepala Seksi Pencairan Dana';
						break;
			}
		echo "</div>
				</div>";
		}
		
// Kepala Seksi Bank dan Giro Pos, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'ABP'){
	$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL'  OR seksi='BP') ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				AND (submenu.seksi='ABP'
				OR submenu.seksi='BP')
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
			#welcome
			{
				font-weight:bold;
				color: #FF6600;
				padding-top:9px;
				margin-left:550px;
			}
			#welcome #user
			{
				display:inline;
				font-style:italic;
				color: #FFFFFF;
			}
			#welcome #seksi
			{
				display:inline;
				font-style:italic;
				color: #FFFF00;
			}
		</style>
			<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
			switch($_SESSION[seksi]){
					case UM:
						echo 'Sub Bagian Umum';
						break;
					case VR:
						echo 'Verifkasi & Akuntansi';
						break;
					case PD:
						echo 'Pencairan Dana';
						break;
					case BP:
						echo 'Bank & Giro Pos';
						break;
					case APD:
						echo 'Kepala Seksi Pencairan Dana';
						break;
					case ABP:
						echo 'Kepala Seksi Bank Giro Pos';
						break;
			}
		echo "</div>
				</div>";
}

// Kepala Seksi Bank dan Giro Pos, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'user' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'AVR'){
	$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL'  OR seksi='AVR' OR seksi='VR') ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				AND (submenu.seksi='AVR'
				OR submenu.seksi='VR')
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
			#welcome
			{
				font-weight:bold;
				color: #FF6600;
				padding-top:9px;
				margin-left:550px;
			}
			#welcome #user
			{
				display:inline;
				font-style:italic;
				color: #FFFFFF;
			}
			#welcome #seksi
			{
				display:inline;
				font-style:italic;
				color: #FFFF00;
			}
		</style>
			<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
			switch($_SESSION[seksi]){
					case UM:
						echo 'Sub Bagian Umum';
						break;
					case VR:
						echo 'Verifkasi & Akuntansi';
						break;
					case PD:
						echo 'Pencairan Dana';
						break;
					case BP:
						echo 'Bank & Giro Pos';
						break;
					case APD:
						echo 'Kepala Seksi Pencairan Dana';
						break;
					case ABP:
						echo 'Kepala Seksi Bank Giro Pos';
						break;
					case AVR:
						echo 'Kepala Seksi Vera';
						break;
			}
		echo "</div>
				</div>";
}


// Kepala Sub Bagian Umum, Admin, Menu yang khusus dapat diakses semua user ==============//	
elseif($_SESSION[leveluser] == 'admin' || $_SESSION[seksi] == 'ALL' || $_SESSION[seksi] == 'AUM'){
	$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL'  OR seksi='UM') ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				AND (submenu.seksi='AUM'
				OR submenu.seksi='ALL')
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
			#welcome
			{
				font-weight:bold;
				color: #FF6600;
				padding-top:9px;
				margin-left:550px;
			}
			#welcome #user
			{
				display:inline;
				font-style:italic;
				color: #FFFFFF;
			}
			#welcome #seksi
			{
				display:inline;
				font-style:italic;
				color: #FFFF00;
			}
		</style>
			<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
			switch($_SESSION[seksi]){
					case UM:
						echo 'Sub Bagian Umum';
						break;
					case VR:
						echo 'Verifkasi & Akuntansi';
						break;
					case PD:
						echo 'Pencairan Dana';
						break;
					case BP:
						echo 'Bank & Giro Pos';
						break;
					case APD:
						echo 'Kepala Seksi Pencairan Dana';
						break;
					case AUM:
						echo 'Kepala Sub Bagian Umum';
						break;
			}
		echo "</div>
				</div>";
}

// Kepala Kantor KPPN =============//	
elseif($_SESSION[leveluser] == 'user' &&  $_SESSION[seksi] == 'KK' || $_SESSION[seksi] == 'ALL'){
			$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='ALL' OR seksi='KK') ORDER BY id_main");
			
			while($r=mysql_fetch_array($main)){
				echo "<li><a href='$r[link]'>$r[nama_menu]</a>
						<ul>";
				$sub=mysql_query("SELECT DISTINCT * FROM submenu, mainmenu  
						WHERE submenu.id_main=mainmenu.id_main 
						AND submenu.id_main=$r[id_main]
						AND (submenu.seksi='KK'
						OR submenu.seksi='ALL'
						OR submenu.nama_sub REGEXP 'monitoring')
						GROUP BY submenu.nama_sub
						ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
					echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
				echo "</ul>
						</li>";
			}        
			echo "<style type='text/css'>
			#welcome
			{
				font-weight:bold;
			color: #FF6600;
			padding-top:9px;
			margin-left:650px;
				}
			#welcome #user
			{
				display:inline;
			font-style:italic;
			color: #FFFFFF;
				}
			#welcome #seksi
			{
				display:inline;
			font-style:italic;
			color: #FFFF00;
				}
			</style>
						<div id='welcome'>Username:  
					<div id='user'>"
					. $_SESSION[namauser]  .
					"</div>
					Seksi: <div id='seksi'>";
			switch($_SESSION[seksi]){
				case UM:
					echo 'Sub Bagian Umum';
					break;
				case VR:
					echo 'Verifkasi & Akuntansi';
					break;
				case PD:
					echo 'Pencairan Dana';
					break;
				case BP:
					echo 'Bank & Giro Pos';
					break;
				case KK:
					echo 'Kepala Kantor';
					break;
			}
			echo "</div>
					</div>";
	}

// Admin =============//	
elseif($_SESSION[leveluser] == 'admin' &&  $_SESSION[seksi] == 'ALL'){
			$main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' AND (seksi='UM') ORDER BY id_main");
			
			while($r=mysql_fetch_array($main)){
				echo "<li><a href='$r[link]'>$r[nama_menu]</a>
						<ul>";
				$sub=mysql_query("SELECT DISTINCT * FROM submenu, mainmenu  
						WHERE submenu.id_main=mainmenu.id_main 
						AND submenu.id_main=$r[id_main]
						AND (submenu.seksi='KK'
						OR submenu.seksi='ALL'
						OR submenu.seksi='UM'
						OR submenu.nama_sub REGEXP 'monitoring')
						GROUP BY submenu.nama_sub
						ORDER BY submenu.id_sub");
				while($w=mysql_fetch_array($sub)){
					echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
				}
				echo "</ul>
						</li>";
			}        
			echo "<style type='text/css'>
			#welcome
			{
				font-weight:bold;
			color: #FF6600;
			padding-top:9px;
			margin-left:650px;
				}
			#welcome #user
			{
				display:inline;
			font-style:italic;
			color: #FFFFFF;
				}
			#welcome #seksi
			{
				display:inline;
			font-style:italic;
			color: #FFFF00;
				}
			</style>
						<div id='welcome'>Username:  
					<div id='user'>"
					. $_SESSION[namauser]  .
					"</div>
					Seksi: <div id='seksi'>";
			switch($_SESSION[seksi]){
				case UM:
					echo 'Sub Bagian Umum';
					break;
				case VR:
					echo 'Verifkasi & Akuntansi';
					break;
				case PD:
					echo 'Pencairan Dana';
					break;
				case BP:
					echo 'Bank & Giro Pos';
					break;
				case KK:
					echo 'Kepala Kantor';
					break;
			}
			echo "</div>
					</div>";
	}
		
		/*
//  Admin Menu yang khusus dapat mengkses semua user ==============//
		if($_SESSION[leveluser] == 'admin' && $_SESSION[seksi] == 'ALL'){
	$main=mysql_query("SELECT DISTINCT * FROM mainmenu WHERE (seksi='UM' OR seksi='PD' OR seksi='BP' OR seksi='VR') AND aktif='Y' ORDER BY id_main");
		
	while($r=mysql_fetch_array($main)){
		echo "<li><a href='$r[link]'>$r[nama_menu]</a>
				<ul>";
		$sub=mysql_query("SELECT DISTINCT * FROM submenu, mainmenu  
				WHERE submenu.id_main=mainmenu.id_main 
				AND submenu.id_main=$r[id_main]
				ORDER BY submenu.id_sub");
		while($w=mysql_fetch_array($sub)){
			echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
		}
		echo "</ul>
				</li>";
	}       
	echo "<style type='text/css'>
#welcome
	{
		font-weight:bold;
	color: #FF6600;
	padding-top:9px;
	margin-left:610px;
		}
#welcome #user
	{
		display:inline;
	font-style:italic;
	color: #FFFFFF;
		}
#welcome #seksi
	{
		display:inline;
	font-style:italic;
	color: #FFFF00;
		}
	</style>
		<div id='welcome'>Username:  
			<div id='user'>"
			. $_SESSION[namauser]  .
			"</div>
			Seksi: <div id='seksi'>";
	switch($_SESSION[seksi]){
		case UM:
			echo 'Sub Bagian Umum';
			break;
		case VR:
			echo 'Verifkasi & Akuntansi';
			break;
		case PD:
			echo 'Pencairan Dana';
			break;
		case BP:
			echo 'Bank & Giro Pos';
			break;
		default:
			echo 'Administrator';
			break;
	}
	echo "</div>
			</div>";
		}
*/
	
echo "</ul>";
?>
