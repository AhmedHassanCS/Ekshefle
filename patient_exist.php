<?php
//--------prevent direct access---------------
if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
//--------/prevent direct access---------------

require_once('db/config.php');
require_once('controlers/patient.php');
if(!isset($_POST["pat_id"]))
    exit("National ID missing!");
else
{
    $pat_id=mysqli_real_escape_string($db,$_POST["pat_id"]);
    if (patient_exist($pat_id))
        echo "1";
    else echo "0";
}

?>