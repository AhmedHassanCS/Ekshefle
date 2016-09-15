<?php
//--------prevent direct access---------------
if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
//--------/prevent direct access---------------

require_once('db/config.php');
require_once('controlers/patient.php');
if(!isset($_POST["pat_id"]) || !isset($_POST["pat_name"]) || !isset($_POST["pat_phone"]) ||!isset($_POST["pat_address"])
    ||!isset($_POST["pat_email"]))
    exit("من فضلك إدخل البيانات كاملة!");

elseif(empty($_POST["pat_id"]) || empty($_POST["pat_name"]) || empty($_POST["pat_phone"]) ||empty($_POST["pat_address"])
    ||empty($_POST["pat_email"]))
    exit("من فضلك إدخل البيانات كاملة!");
else
{
    $nat_id=mysqli_real_escape_string($db,$_POST["pat_id"]);
    $pat_name=mysqli_real_escape_string($db,$_POST["pat_name"]);
    $pat_phone=mysqli_real_escape_string($db,$_POST["pat_phone"]);
    $pat_address=mysqli_real_escape_string($db,$_POST["pat_address"]);
    $pat_email=mysqli_real_escape_string($db,$_POST["pat_email"]);

    if(add_patient($nat_id,$pat_name,$pat_phone,$pat_address,$pat_email))
        echo "1";
    else echo $db->error;
}
?>