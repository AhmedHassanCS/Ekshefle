<?php
require_once('../session.php');

$app_id= mysqli_real_escape_string($db,$_POST["app_id"]);
$real_date= mysqli_real_escape_string($db,$_POST["real_date"]);
$conf_query="UPDATE appointment
				SET confirmed=1 , real_date='$real_date'
				WHERE app_id=$app_id";

if(!$db->query($conf_query))
	echo "<h2>Error: ".$db->error."</h2>";
else
	{
		//send phone message here
		header("location: /ekshefle/admin/");
	}
?>
