<?php  

include_once("config.php");

if (isset($_GET['search'])) {
	$keyword = $_GET['search'];

	//query menggunakan SPARQL
	$result = $sparql->query(
				"SELECT ?judul ?nama
					WHERE {
					  ?x dc:Judul ?judul.
					  OPTIONAL {?x dc:isMemberOf ?memberZ. OPTIONAL{?memberZ dc:isMemberOf ?memberX}}
					  OPTIONAL {?memberX dc:hasMember ?member. OPTIONAL{?member dc:Nama ?nama}.
						FILTER (?nama != '') }
					  FILTER(regex(?judul,'$keyword','i'))
					}"
			);

	$resultExact = $sparql->query(
				"SELECT ?judul ?nama
					WHERE {
					  ?x dc:Judul ?judul.
					  OPTIONAL {?x dc:isMemberOf ?memberZ. OPTIONAL{?memberZ dc:isMemberOf ?memberX}}
					  OPTIONAL {?memberX dc:hasMember ?member. OPTIONAL{?member dc:Nama ?nama}.
						FILTER (?nama != '') }
					  FILTER(regex(?judul,'^$keyword$','i'))
					}"
			);

	if ($_SESSION['wiki'] == 2) {
		//$_SESSION['wiki'] == 'class1';
		foreach ($result as $row) {
			if (@$row->nama != '') {
		
				echo "<tr><td><a href='?searchSub2Class=$row->nama' class='mdl-button mdl-js-button mdl-js-ripple-effect'>
						$row->nama</a></td></tr>";
			         
			}
			else false;
		}
	}
	elseif ($_SESSION['wiki'] == 3) {
		//$_SESSION['wiki'] == 'class2';
		foreach ($resultExact as $row) {
			if (@$row->nama != '') {
			
				echo "<tr><td><a href='?searchSub2Class=$row->nama' class='mdl-button mdl-js-button mdl-js-ripple-effect'>
						$row->nama</a></td></tr>";
			         
			}
			else false;
		}
	}
}

?>