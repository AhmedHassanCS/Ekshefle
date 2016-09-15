<?php
require_once("../../private/session.php");
require_once("../../controlers/location.php");
require_once("../../controlers/doctor.php");


if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
    strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
        header("location: /ekshefle/");
elseif(!$loggedin)
    exit("Error: you are not logged in!");

else
{
    $doc_email=$_SESSION['loggedin_user'];
    if(isset($_POST['doc_fname']) && isset($_POST['doc_sname']) && isset($_POST['doc_lname']))
    {

        $fname=mysqli_real_escape_string($db, $_POST['doc_fname']);
        $sname=mysqli_real_escape_string($db, $_POST['doc_sname']);
        $lname=mysqli_real_escape_string($db, $_POST['doc_lname']);

        $res= $db->query("UPDATE doctor 
                            set doc_fname='$fname' 
                            , doc_lname='$lname' 
                            , doc_sname='$sname' 
                            where doc_email='$doc_email'");
        if(!$res)
            echo $db->error;
        else echo "1";

    }
    elseif(isset($_POST['spec_id']))
    {
        $spec_id=mysqli_real_escape_string($db, $_POST['spec_id']);
        if(!update_doc_attrib('spec_id',$spec_id,$doc_email))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['doc_phone']))
    {
        $phone=mysqli_real_escape_string($db, $_POST['doc_phone']);
        if(!update_doc_attrib('doc_phone',$phone,$doc_email))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['degree']))
    {
        $degree=mysqli_real_escape_string($db, $_POST['degree']);
        if(!update_doc_attrib('degree',$degree,$doc_email))
            echo $db->error;
        else echo "1";
    }
    elseif(isset($_POST['doc_address']))
    {
        $doc_address=mysqli_real_escape_string($db, $_POST['doc_address']);
        if(!update_doc_attrib('doc_address',$doc_address,$doc_email))
            echo $db->error;
        else echo "1";
    }
}
?>