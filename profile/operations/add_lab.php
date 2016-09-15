<?php
require_once("../../private/session.php");
require_once("../../controlers/location.php");
require_once("../../controlers/medical.php");
require_once("../../controlers/doctor.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
  exit("Error: you are not logged in!");

elseif(!isset($_POST["med_name"]) || !isset($_POST["days"]) 
        || !isset($_POST["phones"]) || !isset($_POST["detailed_add"]) || !isset($_POST["gov_name"]) 
        || !isset($_POST["city_name"])|| !isset($_POST["area_name"])
        )
    echo "Not all required data is sent";
else
{
    $doc_email= $_SESSION['loggedin_user'];
    $doc_id= get_doc_id($doc_email);
    $med_name = mysqli_real_escape_string($db, $_POST["med_name"]);
    $phones = mysqli_real_escape_string($db, $_POST["phones"]);
    $detailed_add = mysqli_real_escape_string($db, $_POST["detailed_add"]);
    $gov_name = mysqli_real_escape_string($db, $_POST["gov_name"]);
    $city_name = mysqli_real_escape_string($db, $_POST["city_name"]);
    $area_name = mysqli_real_escape_string($db, $_POST["area_name"]);
    $aval_days = mysqli_real_escape_string($db, $_POST["days"]);

    city_exist_else_add($gov_name,$city_name);
    $area_id= area_exist_else_add($gov_name,$city_name,$area_name);
    if(is_active($doc_email,'Lab'))
        $ins_query=$db->query("INSERT into medical (med_name,doc_id,phones,med_type,is_active) 
                            values('$med_name',$doc_id,'$phones','Lab',1)");
    else
        $ins_query=$db->query("INSERT into medical (med_name,doc_id,phones,med_type) 
                            values('$med_name',$doc_id,'$phones','Lab')");

    if(!$ins_query)
        echo $db->error;
    else
    {
        $med_id= $db->insert_id;
        $add_ins_query=$db->query("INSERT into address (med_id,detailed_add,area_id) 
                            values($med_id,'$detailed_add',$area_id)");
        if(!$add_ins_query)
        {
            $db->query("DELETE from medical where med_id=$med_id");
            echo $db->error;
        }
        else
        {
            $days_ins_query=$db->query("INSERT into lab_days (med_id,aval_days) 
                            values($med_id,'$aval_days')");
            if(!$days_ins_query)
            {
                $db->query("DELETE from medical where med_id=$med_id");
                $db->query("DELETE from address where med_id=$med_id");
                echo $db->error;  
            }
            else echo "1";
        }
    }

}
?>