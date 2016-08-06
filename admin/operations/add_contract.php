<?php
require_once('../session.php');

$cont_code= mysqli_real_escape_string($db, $_POST["cont_code"]);
$doc_email= mysqli_real_escape_string($db, $_POST["doc_email"]);
$med_type= mysqli_real_escape_string($db, $_POST["med_type"]);
$start_date= mysqli_real_escape_string($db, $_POST["start_date"]);
$exp_date= mysqli_real_escape_string($db, $_POST["exp_date"]);

$get_id="SELECT doc_id from doctor where doc_email='$doc_email'"; // sql injection is not handled
$res_doc = $db->query($get_id);
if(mysqli_num_rows($res_doc)==1){

    $row = $res_doc->fetch_assoc();
    $doc_id=$row["doc_id"];
    
    $exist_check="SELECT cont_code, is_expired FROM contract WHERE doc_id=$doc_id AND med_type='$med_type'"; //sql injection is not handled
    $check_result=$db->query($exist_check);
    
    if(mysqli_num_rows($check_result)>0){
        $existing=$check_result->fetch_assoc();
        //if it exists and not expired, cancel operation and print error
        if( $existing["is_expired"]==0)
            echo "<h2>Error: That contract already exist and running</h2>";

        //if it exists but expired, delete expired one and insert the new one
        else if( $existing["is_expired"]==1)
        {
            $del_old="DELETE from contract where cont_code='".$existing["cont_code"]."'";
            if($db->query($del_old)){
                $cont_query="INSERT into contract(cont_code, doc_id ,med_type,start_date, exp_date) 
                            VALUES ('$cont_code' ,$doc_id ,'$med_type' ,STR_TO_DATE('$start_date' ,'%Y-%m-%d'),STR_TO_DATE('$exp_date' ,'%Y-%m-%d'))";
                if(!$db->query($cont_query))
                    echo "<h2>Error: ".$db->error."</h2>";
                else header("location: /ekshefle/admin/");
            }else echo "<h2>Error: Can't delete existing expired contract</h2>";
        }
    }
    //if it doesn't exist just add it
    else
    {
        $cont_query="INSERT into contract(cont_code, doc_id ,med_type,start_date, exp_date) 
                    VALUES ('$cont_code' ,$doc_id ,'$med_type' ,STR_TO_DATE('$start_date' ,'%Y-%m-%d'),STR_TO_DATE('$exp_date' ,'%Y-%m-%d'))";
        if(!$db->query($cont_query))
            echo "<h2>Error: ".$db->error."</h2>";
        else {
            $update_active="UPDATE medical SET is_active=1 where doc_id=$doc_id and med_type='$med_type'";
            if(!$db->query($update_active)){
                echo "<h2>Error: ".$db->error."</h2>";
            }
            else header("location: /ekshefle/admin/");
        }
    }
}else echo "<h2>Error: No existing doctor with this username</h2>";
?>