<?php 
require_once("session.php");
require_once("test_input.php");
//require header
if(!$loggedin)
    require_once("header.html");
else
    require_once("profile/header.php");

$error="";
//make sure data is set and not empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $doc_email= mysqli_real_escape_string($db,$_GET['email']);
    $doc_email=test_input($doc_email);

    $hash= mysqli_real_escape_string($db,$_GET['hash']);
    $hash=test_input($hash);

    $sql_get_user="SELECT is_verified from doctor where doc_email='$doc_email' and hash='$hash'";
    $get_user=$db->query($sql_get_user);
    if(mysqli_num_rows($get_user)==1)
    {
        $user=$get_user->fetch_assoc();
        if($user['is_verified']==0)
        {
            $set_verified=$db->query("UPDATE doctor set is_verified=1 where doc_email='$doc_email' and hash='$hash'");
            
            if(!$set_verified)
                $error="Couldn't verfy your Email, please contact our customer services.";
        }
        else $error="Your account is already verified";
    }
    else $error="Invalid URL. Email is not verified!";
}
else
{
    $error="Invalid URL. Email is not verified!";
}

if($error=="")
    echo '<section class="container">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h3><i class="icon fa fa-check"></i> Email address verified successfully!</h3>
                Now you can login or go to your profile if you have already loggedin.
            </div>
        </section>';
else
    echo '<section class="container">
            <div class="box-body">
              <div class="alert alert-danger alert-dismissible">
                <h3><i class="icon fa fa-ban"></i> Failed!</h3>'.$error.'
              </div>
            </div>
           </section>';

?>

<script src="/ekshefle/js/vendor/jquery-1.9.1.min.js"></script>
<script src="/ekshefle/js/vendor/bootstrap.min.js"></script>
<script src="/ekshefle/js/main.js"></script>
