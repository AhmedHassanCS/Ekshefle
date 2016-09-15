<?php
require_once("../../private/session.php");
require_once("../../controlers/medical.php");


if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
    exit("Error: you are not logged in!");

elseif( !isset($_POST['med_id']) || !isset($_POST['spec_name']) || !isset($_POST['price']) || !isset($_POST['aval_days']) )
    exit("Error: Some element is missing".$_POST['med_id'].$_POST['spec_name'].$_POST['price'].$_POST['aval_days']);
else
{
    $med_id=mysqli_real_escape_string($db, $_POST['med_id']);
    $spec_name=mysqli_real_escape_string($db, $_POST['spec_name']);
    $price=mysqli_real_escape_string($db, $_POST['price']);
    $side_spec=mysqli_real_escape_string($db, $_POST['side_spec']);
    $aval_days=mysqli_real_escape_string($db, $_POST['aval_days']);

    $get_spec=$db->query("SELECT spec_id from specialty where spec_name='$spec_name'");
    if($get_spec){
        $spec_row=$get_spec->fetch_assoc();
        $spec_id=$spec_row["spec_id"];
        $ins_result= $db->query("INSERT into med_spec(med_id,spec_id,price,side_spec,aval_days) 
            values($med_id,$spec_id,$price,'$side_spec','$aval_days')");

        if($ins_result)
            echo "1";
        else
           {echo $db->error; exit();}
   }
   else {echo $db->error; exit();}
}
?>