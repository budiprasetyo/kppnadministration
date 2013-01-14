<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <title>SMS Gateway</title>
  <meta name="generator" content="Bluefish 2.0.1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script language='javascript' type='text/javascript'>setTimeout('location.reload();',3000);</script>
</head>
<body>
<?php
########################################################################################
##    This is copyrighted by Budi Prasetyo a.k.a Metamorph.
##    About myself:
##    I am a PHP programmer working at KPPN Semarang 2.
##    Please rate this code If you find it useful. Please feel free to contact me for queries related to this script.
##    Contact me at bprast1@gmail.com.
##    Don't remove this message, try to appreciate the people that has written this code!
##
##   Thanks in advance.
#########################################################################################
?>
<br />
<br />
<br />
<br />
<table width="100%" align="center">
  <tr bgcolor="#C5C5C5">
    <td align="center"><img src="images/loading.gif" /></td>
    <td align="center"><h1>SMS Gateway Server is Running</h1></td>
  </tr>
  <tr bgcolor="#000000" class="marquees">
    <td colspan="2"><marquee scrolldelay="1" direction="left" height="20"><font color="#48FE00">Don't Close This Tab or Browser, SMS Gateway Server Will Die!</font></marquee></td>
  </tr>
</table>

<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/fungsi_seo.php";

  $proses = "SELECT DISTINCT ReceivingDateTime,SenderNumber,Coding,TextDecoded,ID,Processed
		    FROM inbox
		    WHERE Processed='false'
		    AND (TextDecoded LIKE '%idul%'
		    OR TextDecoded LIKE '%lahir%')
  	     	    ORDER BY ReceivingDateTime desc";
  $queri  =  mysql_query($proses)or die("Maaf Database Tidak Terhubung");
  while($hasil=mysql_fetch_array($queri))
       {
      
		$text   = "Kami sekeluarga jg mengucapkan slmt Idul Fitri 1432 H, mohon maaf lahir & batin atas kesalahan & khilaf. (Budi P.)";
	
		mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
					VALUES(now(),now(),'','$sender','$text',now(),'','','yes','Default_No_Compression')");
		mysql_query("UPDATE inbox SET  Processed='true'");
/*	
	$explodedtext   =explode("#",$text);
	$keys=$explodedtext[0];
	$var1=$explodedtext[1];
	$var2=$explodedtext[2];
	$var3=$explodedtext[3];
	$var4=$explodedtext[4];
	$var5=$explodedtext[5];
	$var6=$explodedtext[6];
	$var7=$explodedtext[7];
	$key     =strtolower($keys);
	$dekon=strtoupper($var4);
//Script untuk SPM
	$nospm=sprintf("%05s",$var2);
	if($key=="spm")
             { 
               $proses1 = "SELECT DISTINCT a.kdsatker,a.tgspm,a.nospm,a.tgsp2d,a.nosp2d,(a.totnilmak-a.totnilmap) jumlah,b.nmstsspm
               	 	   FROM m_spmind a LEFT JOIN t_status b
               	 	   ON a.kdstaspm=b.kdstatus
               	 	   WHERE a.kdsatker='$var1' and a.nospp='$nospm'
			   UNION
			   SELECT DISTINCT a.kdsatker,a.tgspp,a.nospp,a.tgspm,a.nospm,(a.totnilmak-a.totnilmap) jumlah,b.nmstsspm
               	 	   FROM d_spmind a LEFT JOIN t_status b
               	 	   ON a.kdstaspm=b.kdstatus
               	 	   WHERE a.kdsatker='$var1' and a.nospp='$nospm'";
               $queri1	= mysql_query($proses1)or die("Maaf Database Tidak Terhubung Query Kedua");
               $hasil1  = mysql_fetch_array($queri1);
               $Satker 	= $hasil1[kdsatker];
					$tgspp   = $hasil1[tgspp];
               $Tgspp	= date("d F Y",strtotime($tgspp));
					$nospp 	= $hasil1[nospp];
               $tgspm   = $hasil1[tgspm];
					$Tgspm   = date("d F Y",strtotime($tgspm));
               $nospm   = $hasil1[nospm];
               $jumlah  = $hasil1[jumlah];
					$Jumlah  = number_format($jumlah,0,',','.');
					$status  = $hasil1[nmstsspm];

		if($hasil1=="")
                   {
		    mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
                    VALUES(now(),now(),'','$sender','SPM yang Anda cari tidak diketemukan, cek kembali format yang Anda kirimkan, ketik SPM#Kd.Satker#No.spm',now(),'','','yes','Default_No_Compression')");
		    mysql_query("UPDATE inbox SET  Processed='true'");
                    }
                elseif($nospm=="")
                    {
                     mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
		     VALUES(now(),now(),'','$sender','Status SPM Anda saat ini $status SPM no.$nospp tgl.$Tgspp sejmlh $Jumlah',now(),'','','yes','Default_No_Compression')");
		    mysql_query("UPDATE inbox SET  Processed='true'");
                     } 
		else
                    {
                     mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
		     VALUES(now(),now(),'','$sender','Status SPM Anda saat ini $status SP2D no.$nospm tgl.$Tgspm sejmlh $Jumlah',now(),'','','yes','Default_No_Compression')");
		    mysql_query("UPDATE inbox SET  Processed='true'");
                     }
		 }
//Script untuk SKPP
	elseif($key=='skpp')
		{
			$proses2	= "SELECT DISTINCT noklr,tgsrt,tjndr,prhl FROM t_surat WHERE prhl REGEXP '$var1' AND tjndr REGEXP '$var2'";
			$queri2	=  mysql_query($proses2)or die("Maaf Database Tidak Terhubung Query Ketiga");
			$hasil2	=  mysql_fetch_array($queri2);
			$nosrt	=  $hasil2[noklr];
			$tgsrt	=  $hasil2[tgsrt];
			$Tgsrt 	=date("d F Y",strtotime($tgsrt));
			$tjnsrt	=  $hasil2[tjndr];
			$prhl	=  $hasil2[prhl];

		if($hasil2=="")
                   {
		    mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
                    VALUES(now(),now(),'','$sender','SKPP yang Anda cari belum selesai diproses atau cek kembali format yang Anda kirimkan, ketik SKPP#Nama Pd.SKPP#Tujuan SKPP',now(),'','','yes','Default_No_Compression')");
		    mysql_query("UPDATE inbox SET  Processed='true'");
                    }
                 else
                    {
		     	$message ="SKPP Anda saat ini telah diterbitkan S.Pengantar SKPP-nya $nosrt tgl.$Tgsrt prhl $prhl";
		     	//Menghitung jumlah pecahan
		    	 $jmlSMS =ceil(strlen($message)/153);
		     	//Memecah pesan asli
		     	$split    =str_split($message,153);
		     	//Proses untuk mendapatkan ID record yang akan disisipkan ke tabel OUTBOX
		     	$Query ="SHOW TABLE STATUS LIKE 'outbox'";
		    	 $result  =mysql_query($Query);
		     	$data    =mysql_fetch_array($result);
		     	$newID =$data['Auto_increment'];
		     	//Proses penyimpanan ke tabel mysql untuk setiap pecahan
		     		for ($i=1;$i<=$jmlSMS;$i++)
			 	 //Membuat udh untuk setiap pecahan, sesuai urutannya
			  	 {
				$udh="050003A7".sprintf("%02s",$jmlSMS).sprintf("%02s",$i);
			 	 //Membaca text setiap pecahan
			  	$msg =$split[$i-1];

			  	if($i==1)
					{
					$query1=mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,UDH,TextDecoded,ID,MultiPart,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
		   	       		 VALUES(now(),now(),'','$sender','$udh','SKPP Anda saat ini telah diterbitkan S.Pengantar SKPP-nya $nosrt tgl.$Tgsrt prhl $prhl','$newID','true',now(),'','','yes','Default_No_Compression')");
                     			}
			 	 else
					{
					$query2=mysql_query("INSERT INTO outbox_multipart(UDH,TextDecoded,ID,SequencePosition) 
					VALUES('$udh','$msg','$newID','$i')");
					 mysql_query("UPDATE inbox SET  Processed='true'");
					}
			}
		    }
		}
//Script untuk mengambil PIN Satker
	elseif($key=='pin')
		{
			$proses3	=  "SELECT DISTINCT * FROM pinsatker WHERE kdsatker='$var1' AND kddept='$var2' AND kdunit='$var3' AND kddekon='$dekon'";
			$queri3	=  mysql_query($proses3)or die("Maaf Database Tidak Bisa Terhubung Query Keempat");
			$hasil3	=  mysql_fetch_array($queri3);
			
			if($hasil3=="")
				{
					$Pin=rand(1,9999);
					$pin=sprintf("%04s",$Pin);
					mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
		     			VALUES(now(),now(),'','$sender','PIN Anda dengan kdsatker $var1, kddept $var2, kdunit $var3, dan kddekon $dekon adalah $pin',now(),'','','yes','Default_No_Compression')");
					mysql_query("INSERT INTO pinsatker(kdsatker,kddept,kdunit,kddekon,PIN)
					VALUES('$var1','$var2','$var3','$dekon','$pin')");
		    			mysql_query("UPDATE inbox SET  Processed='true'");
				}
			else
				{
					mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
                    			VALUES(now(),now(),'','$sender','PIN yang di-generate telah digunakan satker lain, mohon ulangi proses ini atau cek kembali format yang Anda kirimkan, ketik PIN#kd.satker#dept#unit#kode dekon',now(),'','','yes','Default_No_Compression')");
		    			mysql_query("UPDATE inbox SET  Processed='true'");
				}
		}
//Script untuk PERAN TSA
	elseif($key=='tsa')
		{
			$proses4	=  "SELECT a.kdsatker,a.nokarwas,b.* FROM d_pagub a RIGHT JOIN pinsatker b ON a.kddept=b.kddept AND a.kdunit=b.kdunit AND a.kdsatker=b.kdsatker AND a.kddekon=b.kddekon WHERE a.kdsatker='$var1' and b.PIN='$var6'";
			$queri4	=  mysql_query($proses4)or die("Maaf Database Tidak Bisa Terhubung Dengan Query Kelima");
			$hasil4	=  mysql_fetch_array($queri4);
			$kddept	=  $hasil4[kddept];
			$kdunit	=  $hasil4[kdunit];
			$karwas	=  $hasil4[nokarwas];

			if($hasil4=="")
			  {
				mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
                               	VALUES(now(),now(),'','$sender','Satker Anda mungkin bukan dlm wilayah kerja kami atau Anda blm mendptkn PIN, utk mendpt PIN, ketik PIN#kd.Satker#dept#unit#kd.dekon',now(),'','','yes','Default_No_Compression')");
		    		mysql_query("UPDATE inbox SET  Processed='true'");
			  }
			else
			  {
			      if(strlen($var2)=="8")
				{
				$tgtsa	=  substr($var2,0,2);
				$bltsa	=  substr($var2,2,2);
				$thtsa	=  substr($var2,4,4);
				$tgltsa	="$thtsa-$bltsa-$tgtsa";
				mysql_query("INSERT INTO d_tsasatker(tgest,jmlnongaji,jmlnonind,jmlgjind,tgterima,kdsatker,kdKPPN,kddept,kdunit,karwas)
				VALUES('$tgltsa','$var3','$var4','$var5',now(),'$var1','134','$kddept','$kdunit','$karwas')");
				mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
				VALUES(now(),now(),'','$sender','Perencanaan Kas Anda dg kdsatker $var1, kddept $kddept, kdunit $kdunit, dan tgl $var2 telah kami terima',now(),'','','yes','Default_No_Compression')");
				mysql_query("UPDATE inbox SET  Processed='true'");
				}
			    else
				{
				mysql_query("INSERT INTO outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity,SenderID,DeliveryReport,Coding) 
                    		VALUES(now(),now(),'','$sender','Format tanggal Anda salah, ketik ddmmyyyy,contoh: 2 Mei 2010 ketik 02052010',now(),'','','yes','Default_No_Compression')");
		    		mysql_query("UPDATE inbox SET  Processed='true'");
				}
			  }
		}
		*/
        }
echo "<br /><br /><br /><br />";
echo  "<center>This Script is &copy; Copyrighted by Metamorph (  bprast1@gmail.com at KPPN Semarang II  )</center>";
?>
</body>
</html>
