<?php
if(!$loggedin)
  header("location: /ekshefle/");

$doc_email=$_SESSION['loggedin_user'];
$sql_get_user="SELECT is_verified from doctor where doc_email='$doc_email'";
$get_user=$db->query($sql_get_user);
$verified=false;
if(mysqli_num_rows($get_user)==1)
{
    $user=$get_user->fetch_assoc();
    if($user['is_verified']==0)
    {
       echo 
            '<div class="box-body">
                  <div class="alert alert-danger alert-dismissible">
                    <h3><i class="icon fa fa-ban"></i> Your E-mail address is not verified yet!</h3>
                    <h5>An Email has been sent to you, click on the link in that Email to verify your E-mail address.<br>
                    Until you verify your email, you will not be able to add any clinics or publish any data.<br>
                    You can change email:</h5>
                    <form action="edits/edit_email.php" method="post">
                    <input type="email" value="'.$doc_email.'" name="new_email"/><br>
                    <input type="submit" class="btn btn-success" value="Change Email" />
                    </form>
                  </div>
                </div>';
    }
    else $verified=true;
}
else echo "<h3>Are You logged in?</h3>";

?>