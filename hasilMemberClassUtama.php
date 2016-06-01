<?php  
include_once("config.php");

if (isset($_GET['searchClass'])) {
	
	@$keyword = $_GET['searchClass'];

	$resultMember = $sparql->query(
				"SELECT ?nama ?member ?member2
				      WHERE {
				        ?x dc:Nama ?nama.
				        OPTIONAL {?x dc:hasMember ?memberX. OPTIONAL{?memberX dc:Nama ?member}
				          FILTER (?member != '')}
				  		OPTIONAL {?memberX dc:hasMember ?memberY. OPTIONAL{?memberY dc:Nama ?member2}
				          FILTER (?member2 != '')}

				        FILTER(regex(?nama,'^$keyword$','i'))
				      }"
			);
 	
		$arrayMember = array();
	foreach ($resultMember as $row) {
		array_push($arrayMember, @$row->member); // Memasukkan hasil member $resultMember ke array 
	}

	$arrayMember = array_unique($arrayMember); // Menghapus anggota array yg duplikat

 	if ($_SESSION['wiki'] == 2) {
 		
 	}
 	else{
 		$_SESSION['wiki'] = 'tampilMemberClassUtama';
 		echo "<tr><td><h4>Portal: <b>$keyword</b> </h4><hr></td></tr>";
		foreach ($arrayMember as $row) {

			echo "<tr><td>";
			echo "<h6><a href='?searchSub1Class=$row' style='text-decoration:none'>".$row."</a></h6>";
			echo "</td></tr>";

			$resultMember2 = $sparql->query( // Query utk setiap member $arrayMember
				"SELECT ?nama ?member2
				      WHERE {
				        ?x dc:Nama ?nama.
				        OPTIONAL {?x dc:hasMember ?memberX. OPTIONAL{?memberX dc:Nama ?member2}
				          FILTER (?member2 != '')}

				        FILTER(regex(?nama,'^$row$','i'))
				      }"
			);

			foreach ($resultMember2 as $row) {
				if (!empty($row->member2)) { // Memeriksa apakah member kosong
					echo "<tr><td>";
					echo "<a href='?searchSub2Class=$row->member2' style='text-decoration:none'>".$row->member2."</h6>";
					echo "</td></tr>";
				}
				else echo "<tr><td> - </td></tr>";
			}
		}

 	}

}
?>