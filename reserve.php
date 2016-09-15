<?php
//--------prevent direct access---------------
if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
//--------/prevent direct access---------------

require_once('db/config.php');
require_once('controlers/patient.php');
if(!isset($_POST["pat_id"]) || !isset($_POST["med_id"]) || !isset($_POST["spec_id"]) ||!isset($_POST["date"]))
    exit("Data missing!");
elseif(empty($_POST["pat_id"])||empty($_POST["med_id"])||empty($_POST["spec_id"])||empty($_POST["date"]))
    exit("Data missing!");
else
{
    $nat_id=mysqli_real_escape_string($db,$_POST["pat_id"]);
    $med_id=mysqli_real_escape_string($db,$_POST["med_id"]);
    $spec_id=mysqli_real_escape_string($db,$_POST["spec_id"]);
    $date=mysqli_real_escape_string($db,$_POST["date"]);

    if(add_app($nat_id,$med_id,$spec_id,$date))
        echo "1";
    else echo $db->error;
}
?>