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

