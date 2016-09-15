<?php
function patient_exist($nat_id)
{
    global $db;
    $result=$db->query("SELECT nat_id from patient where nat_id=$nat_id");
    if(mysqli_num_rows($result)>0)
        return true;
    else return false;
}
function add_patient($nat_id,$pat_name,$pat_phone,$pat_address,$pat_email)
{
    global $db;
    $result=$db->query("INSERT into patient (nat_id,pat_name,pat_phone,pat_address,pat_email) 
                        values($nat_id,'$pat_name','$pat_phone','$pat_address','$pat_email')");
    return $result;
}
function add_app($pat_id,$med_id,$spec_id,$date)
{
    global $db;
    $result=$db->query("INSERT into appointment (pat_id,med_id,spec_id,date) 
                        values ($pat_id,$med_id,$spec_id,STR_TO_DATE('$date' ,'%m-%d-%Y'))");
    return $result;
}
?>