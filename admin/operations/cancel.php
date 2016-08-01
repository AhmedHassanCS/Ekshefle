<?php
require_once('../session.php');

$app_id= $_POST["app_id"];
$med_id= $_POST["med_id"];

$canc_query="DELETE from appointment
				WHERE app_id=$app_id";

if(!$db->query($canc_query))
	echo "Error: ".$db->error;
else
	header("location: /ekshefle/admin/");
?>
