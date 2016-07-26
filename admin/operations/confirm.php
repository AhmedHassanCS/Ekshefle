<?php
include('../session.php');

$app_id= $_POST["app_id"];
$real_date= $_POST["real_date"];
$conf_query="UPDATE appointment
				SET confirmed=1 , real_date='$real_date'
				WHERE app_id=$app_id";

if(!$db->query($conf_query))
	echo "Error: ".$db->error;
else
	{
		//send phone message here
		header("location: /ekshefle/admin/");
	}
?>
