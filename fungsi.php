<?php

/*Menghilangkan elemen kosong di array*/
function array_empty_remover($array, $remove_null_number = true) {
	$new_array = array();
	$null_exceptions = array();
	foreach ($array as $key => $value) {
		$value = trim($value);
		if($remove_null_number) {
			$null_exceptions[] = '0';
		}
		if(!in_array($value, $null_exceptions) && $value != "") {
			$new_array[] = $value;
		}
	}
	return $new_array;
}

// Mengganti tag xml ke html
function strip_wiki($file){
	$artikel=file_get_contents($file);

	$wiki = preg_replace('/(<anchor>)+[a-zA-Z0-9_ -]+(<\/?anchor>)/i','', $artikel);
	$wiki = preg_replace('/(<page type="article">)/i','', $wiki);
	$wiki = preg_replace('/(<\/page>)/i','', $wiki);
	//$wiki = preg_replace('/(level....)/i','', $wiki);
	$wiki = preg_replace('/(<text>)/i','', $wiki);
	$wiki = preg_replace('/(<\/text>)/i','', $wiki);
	$wiki = preg_replace('/(<url>)+[a-zA-Z0-9_ -]+(<\/?url>)/i','', $wiki);
	//$wiki = preg_replace('/(<title>)+[a-zA-Z0-9_ -]+(<\/?title>)/i','', $wiki);
	$wiki = preg_replace('/(<target>Berkas:)+[a-zA-Z0-9_ -\.]+(<\/?target>)/i','', $wiki);
	$wiki = preg_replace('/(<param>)+[a-zA-Z0-9_ -\.]+(<\/?param>)/i','', $wiki);
	$wiki = preg_replace('/(<\/?target>)/i','', $wiki);
	$wiki = preg_replace('/(secTitle)/i','h5', $wiki);
	//$wiki = preg_replace('/(title)/i','h4', $wiki);
	$wiki = preg_replace('/(^list$)/i','ul', $wiki);
	$wiki = preg_replace('/(listEl)/i','li', $wiki);
	$wiki = preg_replace('/(link)/i','b', $wiki);
	$wiki = preg_replace('/(<\/firstPara>)/i','</firstPara>(--ReadMore--)', $wiki);

	return $wiki;
}

// Memisah artikel menjadi 2 bagian (Read More)
function read_more($file){

	$artikel = strip_wiki($file);

	$artikel = explode("(--ReadMore--)", $artikel);

	return $artikel;
}

?>
