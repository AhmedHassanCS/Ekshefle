<?php
include('../session.php');


$doc_email= $_POST["doc_email"];

$exist_query= "SELECT doc_id from doctor where doc_email ='$doc_email'";

if(mysqli_num_rows($db->query($exist_query))==1)
{
	$del_query="DELETE from doctor where doc_email ='$doc_email'";
	if(!$db->query($del_query))
		echo "<h2>Error:</h2>"."<h3>".$db->error."</h3>";
	else header("location: /ekshefle/admin/");

}
else echo "<h2>Error:</h2>"."<h3>There's no doctor with this username</h3>";
?>