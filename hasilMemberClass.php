<?php  
include_once("config.php");

if (isset($_GET['searchSub2Class'])) {
	
	$keyword = $_GET['searchSub2Class'];

	$resultExact = $sparql->query(
				"SELECT ?nama ?member 
					WHERE {
					  ?x dc:Nama ?nama.
					  OPTIONAL {?x dc:hasMember ?memberZ}
					  OPTIONAL {?memberZ dc:Judul ?member.
						FILTER (?member != '') }
					  FILTER(regex(?nama,'^$keyword$','i'))
					}"
			);
 	
 	if ($_SESSION['wiki'] == 2) {
 		
 	}
 	else{
 		$_SESSION['wiki'] = 'tampilMemberClass';
 		echo "<tr><td><h4>Artikel dalam Kategori <b>$keyword</b> </h4><hr></td></tr>";
		$no = 0;
		foreach ($resultExact as $row) {
			echo "<tr><td>";
			$no++;
			echo "$no. <a href='?search=$row->member' style='text-decoration:none'>".$row->member."</a><br/>";
			echo "</td></tr>";
		}
 	}

}

?>