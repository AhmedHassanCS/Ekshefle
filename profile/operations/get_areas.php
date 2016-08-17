<?php
//--------prevent direct access---------------
if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
//--------/prevent direct access---------------

require_once("../../private/session.php");
require_once("../../controlers/location.php");
require_once("../../private/test_input.php");

if(!$loggedin)
  header("location: /ekshefle/");

elseif(!isset($_POST['gov_name']) || !isset($_POST['city_name']))
  header("location: /ekshefle/");
else
{
    $gov_name = mysqli_real_escape_string($db,$_POST['gov_name']);
    $gov_name = test_input($gov_name);

    $city_name = mysqli_real_escape_string($db,$_POST['city_name']);
    $city_name = test_input($city_name);

    $areas_html= get_city_areas($gov_name,$city_name);
    echo $areas_html;
}
?>