<?php
require_once("../../private/session.php");
require_once("../../controlers/doctor.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
    exit("Error: you are not logged in!");

elseif( !isset($_POST['med_type']))
    exit("Error: Medical id is missing");
else
{
    $med_type=mysqli_real_escape_string($db, $_POST['med_type']);
    $doc_email= $_SESSION["loggedin_user"];
    $doc_id=get_doc_id($doc_email);

    $result= $db->query("INSERT into request(doc_id,med_type) values($doc_id,'$med_type')");
    if($result)
        echo "1";
    else echo $db->error;
}
?>