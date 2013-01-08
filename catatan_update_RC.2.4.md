Hal-hal yang perlu diperhatikan:
1. copy hanya file-file dan tabel yang disebutkan di bawah ini saja (Perubahan tanggal 13 Juni 2012 dan per).
2. khusus file koneksi tidak saya sertakan.  User bisa membuat sendiri dari koneksi.php di folder config, lakukan dengan save as koneksisp2d.php (untuk sqldb12) dan koneksisp2d11.php (untuk sqldb11).  Hanya untuk user dan password ke database, silakan googling bagaimana caranya.
3. batch file juga tidak saya sertakan mengingat di development saya menggunakan linux.
4. mohon diperhatikan waktu mengkopi kiri.php.  Di dalamnya terdapat script yang diperuntukkan pengguna windows maupun unix family di baris 226, untuk windows user silakan uncomment di baris tersebut, dan berikan comment di unix family user.

Perubahan tanggal 13 Juni 2012

.htaccess
1. Penambahan sub menu Rekam Data Arsip Metode 2.
2. Penambahan sub menu Referensi Gudang.

kiri.php
1. Perubahan pada modul arsip yaitu pemberian nilai default '' pada combo box selected rak,baris,box
2. Perubahan pada query data arsip yang ditampilkan, pada awal sebelumnya data yang tersubmit walaupun 
    nomor rak, baris, dan box nya kosong ternyata tetap tersimpan dan pada penayangan data arsip yang akan direkam nomor rak,baris, dan boxnya tidak muncul lagi.
    Pada update ini perbaikan pada query akan menampilkan data yang ikut tersubmit.
3. Penambahan proses arsip sp2d metode 2.
4. Perbaikan proses search arsip berkaitan dengan penambahan proses arsip sp2d metode 2.	
5. Perbaikan proses search edit arsip berkaitan dengan penambahan proses arsip sp2d metode 2.
6. Penambahan referensi gudang (CRUD).
7. Update referensi pejabat (D)	
8. Pada load data modify jquery datepicker untuk menampilkan bulan dan tahun
9. Load data ditambahkan field nomor advis
10. Penambahan validasi load ke tabel arsip dan load data 2011

kirisurat.php
1. Perbaikan pada modul surat keluar yaitu pada konter surat keluar.  Awalnya konter dihitung dari maksimal keseluruhan surat, setelah perbaikan ini konter dihitung
    berdasarkan per jenis surat.
2. Perbaikan pada modul surat masuk submenu monitoring surat masuk, awalnya terdapat sql_error pada user tertentu.
3. Perbaikan pada form surat masuk dan surat masuk manual pada kolom nomor surat masuk dengan maxlength awal='20' menjadi 50.  Hal ini juga perubahan pada 
    tabel d_suratmasuk:
	ALTER TABLE `monitor`.`d_suratmasuk` CHANGE COLUMN `nomorsuratmasuk` `nomorsuratmasuk` VARCHAR(50) NOT NULL  ;
4. Pada search surat masuk modify jquery datepicker untuk menampilkan bulan dan tahun.
5. Penambahan range tanggal surat pada pencarian surat keluar.

d_suratmasuk
1. 	ALTER TABLE `monitor`.`d_suratmasuk` CHANGE COLUMN `nomorsuratmasuk` `nomorsuratmasuk` VARCHAR(50) NOT NULL  ;

template.php
1. Penambahan pada jquery.ui.position untuk mengatur posisi dialog




Perubahan tanggal 14 Juni 2012

d_arsipsp2d
1. ALTER TABLE `monitor`.`d_arsipsp2d` ADD COLUMN `gudang` VARCHAR(1) NOT NULL  AFTER `tgspm` ;
2. ALTER TABLE `monitor`.`d_arsipsp2d` ADD COLUMN `noadvis` VARCHAR(3) NOT NULL  AFTER `tgspm` ;


index.php
1. Penambahan autofocus

r_gudang
1. CREATE TABLE IF NOT EXISTS `r_gudang`
	( 
    	id_gudang TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   	 nm_gudang CHAR(1) NOT NULL,
   	 ket_gudang VARCHAR(75)
	)ENGINE=MyISAM;

style.css
1. Perbaikan pada desain tombol yang bersebelahan.

t_gol
1. ALTER TABLE `monitor`.`t_gol` CHANGE COLUMN `kdgol` `kdgol` CHAR(2) NOT NULL  
	, CHANGE COLUMN `nmgol` `nmgol` VARCHAR(5) NOT NULL  , CHANGE COLUMN `pangkat` `pangkat` VARCHAR(35) NOT NULL  
	, ADD PRIMARY KEY (`kdgol`) 
	, DROP INDEX `t_gol1` ;

koneksisp2d11.php
1. Penambahan koneksi sqldb11.


report.php
1. Perubahan nomor konsep SP



Perbaikan tanggal 18 September 2012
disposisisuratmasuk.php:
1. Penambahan tanda cek pada Petunjuk di report disposisi kepala kantor

index.php:
1. perubahan pada tampilan login

/templates/loginstyle.css:
1. perubahan pada tampilan login

kiriskpp1.php:
1. Penambahan variabel untuk pencetakan tanda terima SKPP
2. penghapusan onClick="this.form.target='_blank'"

kirisurat.php:
1. Penambahan class tombol pada Form hasil pencarian data surat masuk dan keluar dengan class='normaltablesubmit'
2. Penambahan tombol Arsipkan surat masuk dan penambahan modul arsip surat masuk

reporttandapengambilanskpp.php:
1. perbaikan pada tandaterimapengambilan skpp

table submenu:
1. UPDATE `monitor`.`submenu` SET `id_main`=20 WHERE `id_sub`='18';
2. DELETE FROM `monitor`.`mainmenu` WHERE `id_main`=5; (pastikan kembali id_main nya = 5)
3. INSERT INTO `monitor`.`submenu`(nama_sub, link_sub, id_main, seksi) VALUES('Referensi Gudang', 'referensi-gudang', '16', 'UM');
4. INSERT INTO `monitor`.`submenu` (`nama_sub`, `link_sub`, `id_main`, `seksi`) VALUES ('Referensi Rak', 'referensi-rak', 16, 'UM');
5. INSERT INTO `monitor`.`submenu` (`nama_sub`, `link_sub`, `id_main`, `seksi`) VALUES ('Referensi Baris', 'referensi-baris', 16, 'UM');
6. INSERT INTO `monitor`.`submenu` (`nama_sub`, `link_sub`, `id_main`, `seksi`) VALUES ('Referensi Box', 'referensi-box', 16, 'UM');

kiri.php
1. penambahan modul referensi rak, baris, dan box


create table r_rak:

CREATE TABLE `r_rak` (    
  `id_rak` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,    
  `kd_rak` varchar(4) NOT NULL,    
  `ket_rak` varchar(75) NOT NULL,    
  PRIMARY KEY (`id_rak`)  
) ENGINE=MyISAM DEFAULT CHARSET=UTF8


create table r_baris:

CREATE TABLE `r_baris` (    
  `id_baris` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,    
  `kd_baris` varchar(5) NOT NULL,    
  `ket_baris` varchar(75) NOT NULL,    
  PRIMARY KEY (`id_baris`)  
) ENGINE=MyISAM DEFAULT CHARSET=UTF8



create table r_box:

CREATE TABLE `r_box` (
  `id_box` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kd_box` varchar(5) NOT NULL,
  `ket_box` varchar(75) NOT NULL,
  PRIMARY KEY (`id_box`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8


CREATE TABLE `d_arsipsuratmasuk` (
  `id_arsipsuratmasuk` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `idsurat` int(5) unsigned NOT NULL,
  `nm_gudang` char(1) NOT NULL,
  `no_gudang` tinyint(3) unsigned NOT NULL,
  `kd_rak` varchar(4) NOT NULL,
  `no_rak` smallint(4) unsigned NOT NULL,
  `kd_baris` varchar(5) NOT NULL,
  `no_baris` smallint(4) unsigned NOT NULL,
  `kd_box` varchar(5) NOT NULL,
  `no_box` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_arsipsuratmasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8



Update tanggal 4 Oktober 2012

Table d_arsipsuratmasuk
ALTER TABLE `monitor`.`d_arsipsuratmasuk` CHANGE COLUMN `nm_gudang` `nm_gudang` VARCHAR(1) NOT NULL  ;

kirisurat.php
1. Penambahan modul arsip surat masuk melalui submenu search surat masuk

loginstyle.css
Perubahan posisi login form dan height of body


Update tanggal 22 Oktober 2012
kiriskpp1.php
1. Perbaikan pada format nomor surat pengantar SKPP

kiri.php
1. Penambahan method update dan hapus pada referensi nomor arsip sp2d

kirisatker.php
script baru

topmenu.php
1. Penambahan kewenangan user satker
# Penambahan username: satker password: user
INSERT INTO `users`(`username`,`password`,`nama_lengkap`,
                    `level`,`blokir`,`seksi`)
            VALUES('satker',md5('user'),'Satuan Kerja','user','N','STK');

.htaccess
1. Penambahan menu satker

templates.php
1. include kirisatker.php

CREATE TABLE IF NOT EXISTS `versi`(
    id_versi  tinyint(1) unsigned not null auto_increment,
    versi   varchar(30) not null,
    PRIMARY KEY(`id_versi`)
)engine=MyIsam DEFAULT CHARSET=utf8;

UPDATE `versi` SET `versi`='RC. 2.4' WHERE id_versi=1;

index.php
1. penambahan versi


/**-----------------------
 *	Tahun 2013 
 *-----------------------*/
 
2 Januari 2013 
kirisurat.php
1. perbaikan counter sehubungan dengan tahun surat (line 2077 dan 1728)

kiriskpp1.php
1. perbaikan counter sehubungan dengan tahun agenda

d_suratkeluar
1. ALTER TABLE `monitor`.`d_suratkeluar` CHANGE COLUMN `perihal` `perihal` VARCHAR(200) NOT NULL  ;
2. ALTER TABLE `monitor`.`d_suratmasuk` CHANGE COLUMN `perihal` `perihal` VARCHAR(200) NOT NULL  ;




