<?
class CPhpEncoder {

	var $soft_name  = 'AROHA PHPencoder';
	var $soft_version  = '1.11';
	var $compress = true;
	var $encode_repeat = 3;

	function show_main() {
?>
<p align="center">&nbsp;</p>
<p align="center"><a href="?coding=encoder">Encoding</a></p>
<?
	}
	function encode_string($string) {
		if (empty($this->encoding)) {
			$this->encoding = 1;
		} else $this->encoding++;
		$description = "\r\n".'/*'."\r\n".'Encoder : '.$this->soft_name.' ver. '.$this->soft_version."\r\n".'WEB : http://phpencoder.aroha.sk/'."\r\n".'*/'."\r\n".'';
		if ($this->encoding==$this->encode_repeat) {
			$string = $description."?>".$string;
		} else $string = "?>".$string;
		$string = base64_encode($string);
		if ($this->compress) {
			$string = base64_encode(gzcompress($string, 9));
		}
		$string_name = '$Q'.strtoupper(md5(time().rand(1,50000)));
		$out_put = $description;
		$out_put .= $string_name.'="'.$string.'";';
		if ($this->compress) {
			$string_name = 'gzuncompress(base64_decode('.$string_name.'))';
		}
		$string_name = 'base64_decode('.$string_name.')';
		$out_put .= 'eval('.$string_name.');';
		$out_put = '<?php '.$out_put.'?>';
		if ($this->encoding<$this->encode_repeat) {
			$out_put = $this->encode_string($out_put);
		}
		return $out_put;
	}

	function file2encode($source_file, $dest_file) {
		$file = file_get_contents ($source_file);
		$out_put = $this->encode_string($file);
		file_put_contents ($dest_file, $out_put);
		return $out_put;
	}

	function encode() {
		$file = file_get_contents ($_FILES['php_script']['tmp_name']);
		$out_put = $this->encode_string($file);
		header('Content-type: application/php');
		header('Content-Disposition: attachment; filename="encode_'.$_FILES['php_script']['name'].'"');
		echo $out_put;
	}
	
	function google_ad_120x140() {
?>
		<script type="text/javascript"><!--
		google_ad_client = "pub-6881816991793389";
		google_ad_slot = "7860398403";
		google_ad_width = 120;
		google_ad_height = 240;
		//--></script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
<?
	}
	
}
?>