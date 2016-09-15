<?php
//--------prevent direct access---------------
if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
//--------/prevent direct access---------------

require_once("../../db/config.php");
require_once("../../controlers/location.php");
require_once("../../private/test_input.php");


if(!isset($_POST['gov_name']))
  header("location: /ekshefle/");
else
{

    $gov_name = mysqli_real_escape_string($db,$_POST['gov_name']);
    $gov_name = test_input($gov_name);
    $cities_html= "";
    $result= $db->query("SELECT DISTINCT c.city_name 
                        from governorate as g, area as a, city as c,address as ad
                        where ad.area_id=a.area_id
                        and a.city_id=c.city_id
                        and g.gov_id=c.gov_id
                        and g.gov_name='$gov_name'");
    
    while($row=$result->fetch_assoc())
        $cities_html=$cities_html."<option>".$row['city_name']."</option>";
    echo $cities_html;
}
?>