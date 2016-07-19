<?php 
	header("Content-type: text/html; charset=utf-8");
	define('dbuser','root');
	define('dbpw','a01026691550z');
	define('dbhost','localhost');
	define('dbname','ekshefle');

	$db = new mysqli(dbhost, dbuser, dbpw, dbname);
	// Check connection
	if ($db->connect_error) {
    	die("Connection failed: " . $db->connect_error);
	} 
	if (!$db->set_charset("utf8")) {
	    printf("Error loading character set utf8: %s\n", $mysqli->error);
	    exit();
	}
?>