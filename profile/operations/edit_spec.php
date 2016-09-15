<?php
require_once("../../private/session.php");
require_once("../../controlers/medical.php");


if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
    exit("Error: you are not logged in!");

elseif( !isset($_POST['med_id']) || !isset($_POST['spec_id']) )
    exit("Error: Medical id is missing");
else
{
    $med_id=mysqli_real_escape_string($db, $_POST['med_id']);
    $spec_id=mysqli_real_escape_string($db, $_POST['spec_id']);

    if(isset($_POST['price']) && !empty($_POST['price']))
    {
        $price=mysqli_real_escape_string($db, $_POST['price']);
        if(!update_spec_attrib($med_id,$spec_id,'price',$price))
            {echo $db->error; exit();}
    }
    if(isset($_POST['side_spec']) && !empty($_POST['side_spec']))
    {
        $side_spec=mysqli_real_escape_string($db, $_POST['side_spec']);
        if(!update_spec_attrib($med_id,$spec_id,'side_spec',$side_spec))
            {echo $db->error; exit();}
    }
    if(isset($_POST['aval_days']) && !empty($_POST['aval_days']))
    {
        $aval_days=mysqli_real_escape_string($db, $_POST['aval_days']);
        if(!update_spec_attrib($med_id,$spec_id,'aval_days',$aval_days))
           {echo $db->error; exit();}
    }

    echo "1";
}
?>