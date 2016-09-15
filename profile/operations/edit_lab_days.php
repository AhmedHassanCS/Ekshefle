<?php
require_once("../../private/session.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
    exit("Error: you are not logged in!");

elseif( !isset($_POST['med_id']) || !isset($_POST['aval_days']))
    exit("Error: Data missing");
else
{
    $med_id=mysqli_real_escape_string($db, $_POST['med_id']);
    $aval_days=mysqli_real_escape_string($db, $_POST['aval_days']);

    $res=$db->query("UPDATE lab_days set aval_days='$aval_days' where med_id=$med_id");
    if($res)
        echo "1";
    else echo $db->error;

}
?>