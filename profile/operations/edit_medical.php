<?php
require_once("../../private/session.php");
require_once("../../controlers/location.php");
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

    if(isset($_POST['med_name']))
    {
        $med_name=mysqli_real_escape_string($db, $_POST['med_name']);
        if(!update_attrib($med_id,'medical','med_name',$med_name))
            echo $db->error;
        else echo "1";

    }
    elseif(isset($_POST['spec_id']))
    {
        $spec_id=mysqli_real_escape_string($db, $_POST['spec_id']);
        if(!update_attrib($med_id,'med_spec','spec_id',$spec_id))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['phones']))
    {
        $phones=mysqli_real_escape_string($db, $_POST['phones']);
        if(!update_attrib($med_id,'medical','phones',$phones))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['detailed_add']))
    {
        $detailed_add=mysqli_real_escape_string($db, $_POST['detailed_add']);
        if(!update_attrib($med_id,'address','detailed_add',$detailed_add))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['price']))
    {
        $price=mysqli_real_escape_string($db, $_POST['price']);
        if(!update_attrib($med_id,'med_spec','price',$price))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['side_spec']))
    {
        $side_spec=mysqli_real_escape_string($db, $_POST['side_spec']);
        if(!update_attrib($med_id,'med_spec','side_spec',$side_spec))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['aval_days']))
    {
        $aval_days=mysqli_real_escape_string($db, $_POST['aval_days']);
        if(!update_attrib($med_id,'med_spec','aval_days',$aval_days))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['gov_name']) && isset($_POST['city_name']) && isset($_POST['area_name']))
    {
        $gov_name=mysqli_real_escape_string($db, $_POST['gov_name']);
        $city_name=mysqli_real_escape_string($db, $_POST['city_name']);
        $area_name=mysqli_real_escape_string($db, $_POST['area_name']); 
        
        city_exist_else_add($gov_name,$city_name);
        $area_id= area_exist_else_add($gov_name,$city_name,$area_name);

        if(!update_attrib($med_id,'address','area_id',$area_id))
            echo $db->error;
        else echo "1";
    }
}
?>