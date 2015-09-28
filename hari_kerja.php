<?php
     include "config/koneksi.php";
     //list hari kerja
     $qharikerja = mysql_query("SELECT DISTINCT tgyulian FROM t_yulian WHERE kdlibur='L' AND year(tgyulian)='2011' AND month(tgyulian)='08'")or die(mysql_error());
     $tgnow		= date("d-m-Y");
     $pisahtgl		= explode("-",$tgnow);
     $tgl1			= $pisahtgl[0];
     $bln1		= $pisahtgl[1];
     $thn1		= $pisahtgl[2];
	     
     $n	= 1;
     $sum=0;
     
     while($rharikerja	= mysql_fetch_array($qharikerja)){
	     $hari	= $rharikerja['tgyulian'];	
	   //echo $hari."<br />";
	
	     $tanggalsls	= date("Y-m-d",mktime(0, 0, 0, $bln1, $tgl1+$n, $thn1));
	   echo $tanggalsls."<br />";
	     
	    if($tanggalsls == $hari){
		    echo "Hari libur";
	    }
	    
     }
	     /*
	       // counter looping
			       $i = 0;
     
		// counter untuk jumlah hari minggu
				$sum = 0;
		do{
		// mengenerate tanggal berikutnya
				$tanggal = date("d-m-Y", mktime(0, 0, 0, $bln1, $tgl1+$i, $thn1));
		
		// cek jika harinya minggu, maka counter $sum bertambah satu, lalu tampilkan tanggalnya
				if (date("$harilibur", mktime(0, 0, 0, $bln1, $tgl1+$i, $thn1)) != 0)
						{
							$sum++;
							echo $tanggal."<br>";
						} 	 
			
			// increment untuk counter looping
					$i++;
		}
		while($tanggal != $tanggalsls);
		*/
?>