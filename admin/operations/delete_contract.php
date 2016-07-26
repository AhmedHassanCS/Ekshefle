<?php
include('../session.php');


$cont_code= $_POST["cont_code"];

$exist_query= "SELECT * from contract where cont_code ='$cont_code'";

if(mysqli_num_rows($db->query($exist_query))==1)
{
	$del_query="DELETE from contract where cont_code='$cont_code'";
	if(!$db->query($del_query))
		echo "<h2>Error:</h2>"."<h3>".$db->error."</h3>";
	else header("location: /ekshefle/admin/");

}
else echo "<h2>Error:</h2>"."<h3>There's no contract with this code</h3>";
?>