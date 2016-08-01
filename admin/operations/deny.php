<?php 
require_once('../session.php');

$doc_email= $_POST["doc_email"];
$med_type= $_POST["med_type"];

$get_id="SELECT doc_id from doctor where doc_email='$doc_email'";
$res_doc = $db->query($get_id);
if(mysqli_num_rows($res_doc)==1){

	$row = $res_doc->fetch_assoc();
	$doc_id=$row["doc_id"];

	$del_req="DELETE from request where doc_id='$doc_id' and med_type='$med_type'";
	if(!$db->query($del_req))
		echo "Error: ".$db->error;
	else
		header("location: /ekshefle/admin/");
}

?>