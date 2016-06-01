<?php
//include config
include_once("config.php");
include_once("fungsi.php");

if ($_SESSION['wiki'] == 'home') {
		echo "<tr><td><h3>Selamat Datang</h3></td></tr>";
	}

if (isset($_GET['search'])) {
	$keyword = $_GET['search'];
	$MultiKeyword = preg_replace('/\s|\t|\r|\n/', '|', $keyword); // Memecah keyword yg > 1 menjadi perkata

	//query menggunakan SPARQL
	$result = $sparql->query(
				"SELECT ?judul ?isi
					WHERE {
					?x dc:Judul ?judul.
					OPTIONAL {?x dc:Isi ?isi}.
					FILTER(regex(?judul,'$keyword','i'))
					}"
			);

	//query menggunakan SPARQL untuk pencarian exact (tepat)
	$resultExact = $sparql->query(
				"SELECT ?judul ?isi
					WHERE {
					?x dc:Judul ?judul.
					OPTIONAL {?x dc:Isi ?isi}.
					FILTER(regex(?judul,'^$keyword$','i'))
					}"
			);

	//query menggunakan SPARQL (alternatif) untuk keyword > 1 kata
	$MultiResult = $sparql->query(
				"SELECT ?judul ?isi
					WHERE {
					?x dc:Judul ?judul.
					OPTIONAL {?x dc:Isi ?isi}.
					FILTER(regex(?judul,'$MultiKeyword','i'))
					}"
			);

	$arrayResult = array();
	foreach ($result as $row) {
		array_push($arrayResult,@$row->judul,@$row->isi); //memasukkan hasil $result ke array 
	}

	$arrayMultiResult = array();
	foreach ($MultiResult as $row) {
		array_push($arrayMultiResult,@$row->judul,@$row->isi); //memasukkan hasil $MultiResult ke array 
	}

	if (preg_grep("/$keyword/i",$arrayResult)) { 
	//jika query utama terdapat hasil pencarian yang cocok
		
		$jml = count($result);

		if (preg_grep("/^$keyword$/i",$arrayResult)) {
		$_SESSION['wiki'] = 3;	
			foreach ($resultExact as $row) {
				try {
					$artikel = read_more($row->isi); // Menampilkan artikel sebagian
					echo "<tr><td><h4><b>$row->judul</b></h4><hr></td></tr>";
					echo "<tr><td>".$artikel[0]."&nbsp; 
						  <a href='javascript:void(0)' id='readMore'>(Baca Selengkapnya . . .)</a></td></tr>";
					//print_r($artikel);
					//echo "<tr><td><a href='javascript:void(0)' id='readMore'>Baca Selengkapnya . . .</a></td></tr>";
					// @$wiki = new SimpleXMLElement($row->isi, null, true);

					// echo "<tr><td><h5>{$wiki->judul}</h5></td></tr>";
					// echo "<tr><td><p>".substr("{$wiki->isi}",0,800)." &nbsp; [ ..... ]</p></td></tr>
					// 	  <tr><td><a href='javascript:void(0)' id='readMore'>Baca Selengkapnya . . .</a></td></tr>";

				} catch (Exception $e) {
					echo "<tr><td><b>$row->judul</b></td></tr>";
					echo "<tr><td>(Terjadi kesalahan pada file : $row->isi)</td></tr>";
				}
				
			}
		}
		// jika hasil pencarian lebih dari satu
		elseif ($jml > 1) { 
		$_SESSION['wiki'] = 1;
			echo "<tr><td><h4>Beberapa kemungkinan dari kata kunci <b>$keyword</b> </h4></td></tr>";
			$no = 0;
			foreach ($result as $row) {
				echo "<tr><td>";
				$no++;
				$judul = preg_replace("/$keyword/i", '<u><b>\0</b></u>', $row->judul);
				echo "$no. <a href='?search=$row->judul' style='text-decoration:none'>".$judul."</a><br/>";
				echo "</td></tr>";
			}
		}
		// jika hasil pencarian hanya satu
		else { 
		$_SESSION['wiki'] = 2;
			foreach ($result as $row) {
				try {
					$artikel = read_more($row->isi); // Menampilkan artikel sebagian
					echo "<tr><td><h4><b>$row->judul</b></h4><hr></td></tr>";
					echo "<tr><td>".$artikel[0]."&nbsp; 
						  <a href='javascript:void(0)' id='readMore'>(Baca Selengkapnya . . .)</a></td></tr>";
					
				} catch (Exception $e) {
					echo "<tr><td><b>$row->judul</b></td></tr>";
					echo "<tr><td>(Terjadi kesalahan pada file : $row->isi)</td></tr>";
				}
				
			}
		}
	}
	elseif (preg_grep("/$MultiKeyword/i",$arrayMultiResult)) { 
	//jika query utama kosong, pisah keyword menjadi perkata
		$_SESSION['wiki'] = 0;
		$jml = count($MultiResult);
		$keyword = str_replace('|', ' ', $MultiKeyword); // Menghilangkan tanda | pada keyword
		if ($jml > 1) { //jika hasil pencarian lebih dari satu
			echo "<tr><td><h4>Beberapa kemungkinan dari kata kunci <b>$keyword</b> </h4></td></tr>";
			$no = 0;
			foreach ($MultiResult as $row) {
				echo "<tr><td>";
				$no++;
				$judul = preg_replace("/$MultiKeyword/i", '<u><b>\0</b></u>', $row->judul);
				echo "$no. <a href='?search=$row->judul' style='text-decoration:none'>".$judul."</a><br/>";
				echo "</td></tr>";
			}
		}
	}
	else{ //jika keyword tidak terdapat pada file owl
		echo "<tr><td>kosong</td></tr>";
	}

}

?>