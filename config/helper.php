<?php
// created by Budi Prasetyo
	class helper{
		
		// constructor
		public function __construct(){}
		
		// show month not in numeric
		public function month($bulan){
			switch($bulan){
				case 1:
				echo "Januari";
				break;
				case 2:
				echo "Februari";
				break;
				case 3:
				echo "Maret";
				break;
				case 4:
				echo "April";
				break;
				case 5:
				echo "Mei";
				break;
				case 6:
				echo "Juni";
				break;
				case 7:
				echo "Juli";
				break;
				case 8:
				echo "Agustus";
				break;
				case 9:
				echo "September";
				break;
				case 10:
				echo "Oktober";
				break;
				case 11:
				echo "November";
				break;
				case 12:
				echo "Desember";
				break;
			}
		}
		
		public function jeniskewenangan($kddekon){
			switch($kddekon){
				case 1:
				echo "KP";
				break;
				case 2:
				echo "KD";
				break;
				case 3:
				echo "DK";
				break;
				case 4:
				echo "TP";
				break;
				case 5:
				echo "UB";
				break;
				case 6:
				echo "DS";
				break;
			}
		}
		
		// in format date('n')
		public function namaBulan($bulan){
			switch($bulan){
				case 1:
				$bulan = "januari";
				return $bulan;
				break;
				case 2:
				$bulan = "pebruari";
				return $bulan;
				break;
				case 3:
				$bulan = "maret";
				return $bulan;
				break;
				case 4:
				$bulan = "april";
				return $bulan;
				break;
				case 5:
				$bulan = "mei";
				return $bulan;
				break;
				case 6:
				$bulan = "juni";
				return $bulan;
				break;
				case 7:
				$bulan = "juli";
				return $bulan;
				break;
				case 8:
				$bulan = "agustus";
				return $bulan;
				break;
				case 9:
				$bulan = "september";
				return $bulan;
				break;
				case 10:
				$bulan = "oktober";
				return $bulan;
				break;
				case 11:
				$bulan = "nopember";
				return $bulan;
				break;
				case 12:
				$bulan = "desember";
				return $bulan;
				break;
			}
		}
		
		public function dateConvert($date){
			if(strstr($date,"/") || strstr($date,".")){
				$date = preg_split("/[\/]|[.]+/",$date);
				$date = $date[2] . "-" . $date[1] . "-" . $date[0];
				return $date;
			}
			elseif(strstr($date,"-")){
				$date = preg_split("/[-]+/",$date);
				$date = $date[2] . "-" . $date[1] . "-" . $date[0];
				return $date;
			}	
		}
		
		function encrypt_string($input)
		{
		 
			$inputlen = strlen($input);// Counts number characters in string $input
			$randkey = rand(1, 9); // Gets a random number between 1 and 9
		 
			$i = 0;
			while ($i < $inputlen)
			{
		 
				$inputchr[$i] = (ord($input[$i]) - $randkey);//encrpytion
		 
				$i++; // For the loop to function
			}
		 
		//Puts the $inputchr array togtheir in a string with the $randkey add to the end of the string
			$encrypted = implode('.', $inputchr) . '.' . (ord($randkey)+50);
			return $encrypted;
		}
		 
		function decrypt($str, $key)
		{
			$str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);

			# Strip padding out.
			$block = mcrypt_get_block_size('des', 'ecb');
			$pad = ord($str[($len = strlen($str)) - 1]);
			if ($pad && $pad < $block && preg_match(
				  '/' . chr($pad) . '{' . $pad . '}$/', $str
													)
			   ) {
			  return substr($str, 0, strlen($str) - $pad);
			}
			return $str;
		}
		
		public function deviasiRPA($pagurpa,$realisasi){
			$deviasi = round(((abs($pagurpa-$realisasi)/$pagurpa) * 100),2);
			return $deviasi;
		}
		
	}
?>
