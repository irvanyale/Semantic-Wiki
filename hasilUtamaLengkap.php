<?php  

include_once("config.php");
include_once("fungsi.php");

if (isset($_GET['search'])) {
	
	$keyword = $_GET['search'];

	$resultExact = $sparql->query(
				"SELECT ?judul ?isi
					WHERE {
					?x dc:Judul ?judul.
					OPTIONAL {?x dc:Isi ?isi}.
					FILTER(regex(?judul,'^$keyword$','i'))
					}"
			);

	//Menampilkan artikel penuh
	foreach ($resultExact as $row) {
		$_SESSION['wiki'] = 'fullText';	
		try {
			$artikel = strip_wiki($row->isi);
			echo "<tr><td><h4><b>$row->judul</b></h4><hr></td></tr>";
			$artikel = preg_replace('/\(--ReadMore--\)/i','', $artikel);
			echo "<tr><td>".$artikel."</td></tr>";
			echo "<tr><td><a href='javascript:void(0)' id='readMin'>Tampilkan Lebih Sedikit</a></td></tr>";
			
		} catch (Exception $e) {
			echo "<tr><td><b>$row->judul</b></td></tr>";
			echo "<tr><td>(Terjadi kesalahan pada file : $row->isi)</td></tr>";
		}
		
	}
}

?>