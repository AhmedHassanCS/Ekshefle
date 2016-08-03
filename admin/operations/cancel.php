<?php
require_once('../session.php');

$app_id= mysqli_real_escape_string($db,$_POST["app_id"]);
$med_id= mysqli_real_escape_string($db,$_POST["med_id"]);

$canc_query="DELETE from appointment
				WHERE app_id=$app_id";

if(!$db->query($canc_query))
	echo "<h2>Error: ".$db->error."</h2>";
else
	header("location: /ekshefle/admin/");
?>
