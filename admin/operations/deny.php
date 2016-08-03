<?php 
require_once('../session.php');

$doc_email= mysqli_real_escape_string($db,$_POST["doc_email"]);
$med_type= mysqli_real_escape_string($db,$_POST["med_type"]);

$get_id="SELECT doc_id from doctor where doc_email='$doc_email'";
$res_doc = $db->query($get_id);
if(mysqli_num_rows($res_doc)==1){

	$row = $res_doc->fetch_assoc();
	$doc_id=$row["doc_id"];

	$del_req="DELETE from request where doc_id='$doc_id' and med_type='$med_type'";
	if(!$db->query($del_req))
		echo "<h2>Error: ".$db->error."</h2>";
	else
		header("location: /ekshefle/admin/");
}

?>