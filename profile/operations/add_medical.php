<?php
require_once("../../private/session.php");
require_once("../../controlers/location.php");
require_once("../../controlers/medical.php");


if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
  exit("Error: you are not logged in!");

elseif(!isset($_POST["med_type"]) || !isset($_POST["med_name"]) || !isset($_POST["total_spec"]) 
        || !isset($_POST["med_phones"]) || !isset($_POST["detailed_add"]) || !isset($_POST["gov_name"]) 
        || !isset($_POST["city_name"])|| !isset($_POST["area_name"])
        )
        echo "Not all required data is sent";

elseif(empty("med_type") || empty("specialty") || empty("med_phones") || empty("detailed_add") 
        || empty("gov_name") || empty("city_name")|| empty("area_name")|| empty("avail_days")
        || empty("med_name"))
        echo "Not all required data is filled";
else {
    $doc_email= $_SESSION['loggedin_user'];
    $med_type = mysqli_real_escape_string($db, $_POST["med_type"]);
    $med_name = mysqli_real_escape_string($db, $_POST["med_name"]);
    $med_phones = mysqli_real_escape_string($db, $_POST["med_phones"]);
    $detailed_add = mysqli_real_escape_string($db, $_POST["detailed_add"]);
    $gov_name = mysqli_real_escape_string($db, $_POST["gov_name"]);
    $city_name = mysqli_real_escape_string($db, $_POST["city_name"]);
    $area_name = mysqli_real_escape_string($db, $_POST["area_name"]);
    $total_spec =  $_POST["total_spec"];

    city_exist_else_add($gov_name,$city_name);
    $area_id= area_exist_else_add($gov_name,$city_name,$area_name);
    $insert_result= add_medical($doc_email,$med_type,$med_name,$med_phones,$detailed_add,$area_id,$total_spec);
    echo $insert_result;
}

?>