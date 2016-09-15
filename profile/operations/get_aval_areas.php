<?php
//--------prevent direct access---------------
if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
//--------/prevent direct access---------------

require_once("../../db/config.php");
require_once("../../controlers/location.php");
require_once("../../private/test_input.php");


if(!isset($_POST['gov_name']) || !isset($_POST['city_name']))
  header("location: /ekshefle/");
else
{
    $gov_name = mysqli_real_escape_string($db,$_POST['gov_name']);
    $gov_name = test_input($gov_name);

    $city_name = mysqli_real_escape_string($db,$_POST['city_name']);
    $city_name = test_input($city_name);

    $areas_html= "";
    $result= $db->query("SELECT DISTINCT a.area_name 
                        from governorate as g, area as a, city as c,address as ad
                        where ad.area_id=a.area_id
                        and a.city_id=c.city_id
                        and g.gov_id=c.gov_id
                        and c.city_name='$city_name'
                        and g.gov_name='$gov_name'");
    
    while($row=$result->fetch_assoc())
        $areas_html=$areas_html."<option>".$row['area_name']."</option>";

    echo $areas_html;
}
?>