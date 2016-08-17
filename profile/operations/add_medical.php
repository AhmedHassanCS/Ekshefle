<?php
require_once("../../private/session.php");

if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
  header("location: /ekshefle/");

elseif(!isset("med_type") || !isset("specialty") || !isset("med_phones") || !isset("detailed_add") 
        || !isset("gov_name") || !isset("city_name")|| !isset("area_name")|| !isset("avail_days")
        || !isset("med_name"))
        echo "Not all required data is sent";
elseif(empty("med_type") || empty("specialty") || empty("med_phones") || empty("detailed_add") 
        || empty("gov_name") || empty("city_name")|| empty("area_name")|| empty("avail_days")
        || empty("med_name"))
        echo "Not all required data is filled";

?>