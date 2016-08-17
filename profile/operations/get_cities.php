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

elseif(!isset($_POST['gov_name']))
  header("location: /ekshefle/");
else
{
    $gov_name = test_input($_POST['gov_name']);
    $cities_html= get_gov_cities($gov_name);
    echo $cities_html;
}
?>