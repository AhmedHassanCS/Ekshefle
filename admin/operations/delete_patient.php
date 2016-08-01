<?php
require_once('../session.php');


$nat_id= $_POST["nat_id"];

$exist_query= "SELECT nat_id from patient where nat_id ='$nat_id'";

if(mysqli_num_rows($db->query($exist_query))==1)
{
	$del_query="DELETE from patient where nat_id ='$nat_id'";
	if(!$db->query($del_query))
		echo "<h2>Error:</h2>"."<h3>".$db->error."</h3>";
	else header("location: /ekshefle/admin/");

}
else echo "<h2>Error:</h2>"."<h3>There's no pateint with this national id</h3>";
?>