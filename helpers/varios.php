<?php
// TODO: depurar estas funciones

if ( ! function_exists('nicetrim')){
	function nicetrim($s,$MAX_LENGTH){
		$str_to_count = html_entity_decode($s);
		if (strlen($str_to_count) <= $MAX_LENGTH) {
			return $s;
		}

		$s2 = substr($str_to_count, 0, $MAX_LENGTH - 3);
		$s2 .= "...";
		return htmlentities($s2);
	}
}

if ( ! function_exists('getCookieObject')){
	function getCookieObject(){
		$nombreCookie = 'zjuegos';
		if (!isset($_COOKIE[$nombreCookie])) {
			$c = new DatosCookie();
			setcookie($nombreCookie,base64_encode(serialize($c)),pow(2,31)-1,'/',"",0, true);
			return $c;
		} else {
			$c = unserialize(base64_decode($_COOKIE[$nombreCookie]));
			return $c;
		}
	}

}

if ( ! function_exists('haveCookieObject')){
	function haveCookieObject(){
		$nombreCookie = 'zjuegos';
		return (isset($_COOKIE[$nombreCookie]));
	}

}

if ( ! function_exists('setCookieObject')){
	function setCookieObject($objeto){
		$nombreCookie = 'zjuegos';
		setcookie($nombreCookie,base64_encode(serialize($objeto)),pow(2,31)-1,'/',"",0, true);
	}
}

if ( ! function_exists('emailValido')){
	function emailValido($email){
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
			return true;
		}
		else {
			return false;
		}
	}
}

if ( ! function_exists('beginsWith')){
	function beginsWith($string, $search){
		return (strncmp($string, $search, strlen($search)) == 0);
	}
}

if ( ! function_exists('json_decode_nice')){
	function json_decode_nice($json, $assoc = FALSE){
		$json = str_replace("\\", "", $json);
		$json = utf8_encode($json);
		$json = substr($json, strpos($json,'{')+1, strlen($json));
		$json = substr($json, 0, strrpos($json,'}'));
		$json = preg_replace('/(^|,)([\\s\\t]*)([^:]*) (([\\s\\t]*)):(([\\s\\t]*))/s', '$1"$3"$4:', trim($json));

		return json_decode('{'.$json.'}', true);
	}
}

if ( ! function_exists('forceLatin')){
	function forceLatin($string) {
		$string = preg_replace('/[^((\x20-\x7F)|\xF1|\xE1|\xE9|\xED|\xF3|\xFA)]*/','', $string);
		return $string;
	}
}

if ( ! function_exists('toJsArray')){
	function toJsArray($init, $array, $campo,$final){
		$c= $init;
		$i=0;
		foreach ($array as $a){
			if ($i>0){
				$c.=',';
			}
			$c.= "'$a[$campo]'";
			$i++;
		}
		$c.= "$final;\n";
		return $c;
	}
}

if ( ! function_exists('toJsArrayPie')){
	function toJsArrayPie($init, $array,$final){
		$c= $init;
		$i=0;
		foreach ($array as $a){
			if ($i>0){
				$c.=',';
			}
			$c.= "{label: '$a[0]', value: '$a[1]'}";
			$i++;
		}
		$c.= "$final;\n";
		return $c;
	}
}

if ( ! function_exists('toJsArray2')){
	function toJsArray2($init, $array, $campos ,$final){
		$c= $init;
		$i=0;
		foreach ($array as $a){
			if ($i>0){
				$c.=',';
			}
			$c.= "[";
			$i2 = 0;
			foreach($campos as $campo){
				if ($i2>0){
					$c.=',';
				}
				$c.="'$a[$campo]'";
				$i2++;
			}
			$c.="]";
			$i++;
		}
		$c.= "$final;\n";
		return $c;
	}
}

if ( ! function_exists('randomColor')){
	function randomColor() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}
}

if ( ! function_exists('randomDarkColor')){
	function randomDarkColor() {
		return str_pad( dechex( mt_rand( 0, 128 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 128 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 128 ) ), 2, '0', STR_PAD_LEFT);
	}
}

if ( ! function_exists('getWords')){
	function getArrowIcon($valor){
		if ($valor>=0) {
			$arrow='fa-arrow-up';
			$arrow_color="#51a351";
		} else {
			$arrow='fa-arrow-down';
			$arrow_color="#bd362f";
		}
		return "<i class='fa $arrow' style='color: $arrow_color;'>&nbsp;</i>";
	}
}

if ( ! function_exists('resize_image')){
	function resize_image($file, $h, $file_dest) {
		list($width, $height) = getimagesize($file);
		$r = $width / $height;

		$w = $r * $h;
		$newwidth=$w;
		$newheight=$h;

		$src = imagecreatefromjpeg($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagejpeg($dst,$file_dest,90);
		imagedestroy($dst);
		return $dst;
	}
}
?>
