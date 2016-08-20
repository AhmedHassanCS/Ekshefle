<?php
require_once("../../private/session.php");
require_once("../../controlers/medical.php");


if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
    exit("Error: you are not logged in!");

elseif( !isset($_POST['med_id']))
    exit("Error: Medical id is missing");
else
{
    $med_id=mysqli_real_escape_string($db, $_POST['med_id']);
    $result =$db->query("DELETE from medical where med_id=$med_id");
    if($result)
        echo "1";
    else echo $db->error;
}
?>