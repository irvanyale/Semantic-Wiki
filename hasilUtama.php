<?php 
//include config
include_once("config.php");

if (isset($_REQUEST['search'])) {
	$keyword = $_REQUEST['search'];
	//$pattern    = preg_replace('/\s|\t|\r|\n/', '|', $keyword);

	$result = $sparql->query(
				"SELECT ?judul ?isi
					WHERE {
					?x dc:Judul ?judul.
					OPTIONAL {?x dc:Isi ?isi}.
					FILTER(regex(?judul,'$keyword','i'))
					}"
			);

	$arrayResult = array();
	foreach ($result as $row) {
		array_push($arrayResult,@$row->judul,@$row->isi);
	}

	if (!empty($result)) {
		$ada = true;
		foreach ($result as $row) {
			$wiki = array();
			try {
				@$wiki = new SimpleXMLElement($row->isi, null, true);

				echo "<h4>{$wiki->judul}</h4>
					  <p>".substr("{$wiki->isi}",0,800)." &nbsp; [ ..... ]</p>
					  <a href=''>Baca Selengkapnya . . .</a><br/>";
			} catch (Exception $e) {
				echo "<p><b>$row->judul</b></p>&nbsp;&nbsp;";
				echo "<p>(Terjadi kesalahan pada file : $row->isi)</p>";
			}
			
		}
	}

}

?>