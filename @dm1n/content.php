<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";

// Bagian Module Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola aplikasi atau pilih ikon-ikon pada Control Panel. </p>

		<p>&nbsp;</p>

 		<table>
		<th colspan=5><center>Control Panel</center></th>
		<tr>
		  <td width=120 align=center><a href=media.php?module=user><img src=images/user.jpg border=none></a></td>
		  <td width=120 align=center><a href=media.php?module=modul><img src=images/modul.png border=none></a></td>
    </tr>
		<tr>
		  <th width=120><b>Manajemen User</b></th>
		  <th width=120><b>Manajemen Modul</b></center></th>
		</tr>
    </table>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>


          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }
  elseif ($_SESSION['leveluser']=='user'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola aplikasi. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>


          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 	}
}

// Bagian Module Profil User
elseif ($_GET['module']=='profil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_profil/profil.php";
  }
}

// Bagian Module User
elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_users/users.php";
  }
}

// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian Menu Utama
elseif ($_GET['module']=='menuutama'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menuutama/menuutama.php";
  }
}

// Bagian Sub Menu
elseif ($_GET['module']=='submenu'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenu/submenu.php";
  }
}

// Bagian IP Server SP2D
elseif ($_GET['module']=='ipserver'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ipserver/ipserver.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
