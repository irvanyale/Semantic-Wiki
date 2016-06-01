<?php 

include_once("config.php");
include_once("fungsi.php");

if (isset($_GET['search'])) {
	$keyword = $_GET['search'];

	//query menggunakan SPARQL
	$result = $sparql->query(
				"SELECT ?judul ?member ?isi 
					WHERE {
					  ?x dc:Judul ?judul.
					  OPTIONAL {?x dc:isMemberOf ?memberZ. OPTIONAL{?memberZ dc:hasMember ?memberX}}
					  OPTIONAL {?memberX dc:Judul ?member.
						FILTER (?member != ?judul && ?member != '')}
						OPTIONAL {?memberX dc:Isi ?isi}
					  FILTER(regex(?judul,'$keyword','i'))
					}"
			);

	$resultExact = $sparql->query(
				"SELECT ?judul ?member ?isi 
					WHERE {
					  ?x dc:Judul ?judul.
					  OPTIONAL {?x dc:isMemberOf ?memberZ. OPTIONAL{?memberZ dc:hasMember ?memberX}}
					  OPTIONAL {?memberX dc:Judul ?member.
						FILTER (?member != ?judul && ?member != '')}
						OPTIONAL {?memberX dc:Isi ?isi}
					  FILTER(regex(?judul,'^$keyword$','i'))
					}"
			);

	if ($_SESSION['wiki'] == 2) {
		
		foreach ($result as $row) {
			if (!empty(@$row->member)) {
				$judul = preg_replace("/$keyword/i", '<u><b>\0</b></u>', $row->member);
				try {
						$artikel = read_more($row->isi);

						echo "	<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
			              <table>
			              	<tr>
			              		<td><h5><a href='?search=$row->member' style='text-decoration:none'>".$judul."</a></h5></td>
			              	</tr>
			              	<tr>
			              		<td>".$artikel[0]." &nbsp; <a href='?search=$row->member'>(Baca Selengkapnya . . .)</a></td>
			              	</tr>
			              </table>
			            </div>";

				} catch (Exception $e) {
						echo "	<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
			              <table>
			              	<tr>
			              		<td><h5><a href='?search=$row->member' style='text-decoration:none'>".$judul."</a></h5></td>
			              	</tr>
			              	<tr>
			              		<td>(Terjadi kesalahan pada file : $row->isi)</td>
			              	</tr>
			              </table>
			            </div>";
				}
			}
			else false;
		}
	}
	elseif ($_SESSION['wiki'] == 3) {
		foreach ($resultExact as $row) {
			if (!empty(@$row->member)) {
				$judul = preg_replace("/$keyword/i", '<u><b>\0</b></u>', $row->member);
				try {
						$artikel = read_more($row->isi);

						echo "	<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
			              <table>
			              	<tr>
			              		<td><h5><a href='?search=$row->member' style='text-decoration:none'>".$judul."</a></h5></td>
			              	</tr>
			              	<tr>
			              		<td>".$artikel[0]." &nbsp; <a href='?search=$row->member'>(Baca Selengkapnya . . .)</a></td>
			              	</tr>
			              </table>
			            </div>";

				} catch (Exception $e) {
						echo "	<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
			              <table>
			              	<tr>
			              		<td><h5><a href='?search=$row->member' style='text-decoration:none'>".$judul."</a></h5></td>
			              	</tr>
			              	<tr>
			              		<td>(Terjadi kesalahan pada file : $row->isi)</td>
			              	</tr>
			              </table>
			            </div>";
				}
			}
			else false;
		}
	}
}
?>