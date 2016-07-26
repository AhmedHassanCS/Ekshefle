<?php
include('../session.php');
	
	$del_query="DELETE from contract where is_expired=1";
	if(!$db->query($del_query))
		echo "<h2>Error:</h2>"."<h3>".$db->error."</h3>";
	else header("location: /ekshefle/admin/");
?>