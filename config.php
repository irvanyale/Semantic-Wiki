<?php
	//setting library EasyRdf folder
    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
    include_once "EasyRdf/EasyRdf.php";
    //include_once "EasyRdf/html_tag_helpers.php";
	
	//PREFIX
    EasyRdf_Namespace::set('dc', 'http://www.semanticweb.org/irvan/ontologies/2016/4/wiki#');
	
	//file OWL pada server
    $sparql = new EasyRdf_Sparql_Client("http://localhost:8080/openrdf-sesame/repositories/wiki");
	$readMore = false;
?>