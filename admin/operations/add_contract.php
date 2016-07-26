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
	
	$exist_check="SELECT cont_code, is_expired FROM contract WHERE doc_id=$doc_id AND med_type='$med_type'";
	$check_result=$db->query($exist_check);
	
	if(mysqli_num_rows($check_result)>0){
		$existing=$check_result->fetch_assoc();
		//if it exists and not expired, cancel operation and print error
		if( $existing["is_expired"]==0)
			echo "Error: That contract already exist and running";
		
		//if it exists but expired, delete expired one and insert the new one
		else if( $existing["is_expired"]==1)
		{
			$del_old="DELETE from contract where cont_code='".$existing["cont_code"]."'";
			if($db->query($del_old)){
				$cont_query="INSERT into contract(cont_code, doc_id ,med_type,start_date, exp_date) 
							VALUES ('$cont_code' ,$doc_id ,'$med_type' ,STR_TO_DATE('$start_date' ,'%Y-%m-%d'),STR_TO_DATE('$exp_date' ,'%Y-%m-%d'))";
				if(!$db->query($cont_query))
					echo "Error: ".$db->error;
				else header("location: /ekshefle/admin/");
			}else echo "Error: Can't delete existing expired contract";
		}
	}
	//if it doesn't exist just add it
	else
	{
		$cont_query="INSERT into contract(cont_code, doc_id ,med_type,start_date, exp_date) 
					VALUES ('$cont_code' ,$doc_id ,'$med_type' ,STR_TO_DATE('$start_date' ,'%Y-%m-%d'),STR_TO_DATE('$exp_date' ,'%Y-%m-%d'))";
		if(!$db->query($cont_query))
			echo "Error: ".$db->error;
		else echo check_result["is_expired"];//header("location: /ekshefle/admin/");
	}
}else echo "Error: No existing doctor with this username";
?>