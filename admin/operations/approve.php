<?php
include('../session.php');

$cont_code= $_POST["cont_code"];
$doc_email= $_POST["doc_email"];
$med_type= $_POST["med_type"];
$start_date= $_POST["start_date"];
$exp_date= $_POST["exp_date"];

$get_id="SELECT doc_id from doctor where doc_email='$doc_email'";
$res_doc = $db->query($get_id);
if(mysqli_num_rows($res_doc)==1){

	$row = $res_doc->fetch_assoc();
	$doc_id=$row["doc_id"];
	$cont_auery="INSERT into contract(cont_code, doc_id ,med_type,start_date, exp_date) 
				VALUES ('$cont_code' ,$doc_id ,'$med_type' ,STR_TO_DATE('$start_date' ,'%Y-%m-%d'),STR_TO_DATE('$exp_date' ,'%Y-%m-%d'))";
	if(!$db->query($cont_auery))
		echo "Error: ".$db->error;
	else{
			$del_req="DELETE from request where doc_id='$doc_id' and med_type='$med_type'";
			if(!$db->query($del_req))
				echo "Error: ".$db->error;
			else
			header("location: /ekshefle/admin/");
	}
}
?>