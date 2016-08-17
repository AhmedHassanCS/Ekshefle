<?php

require_once("../../private/session.php");

require_once("../../private/validation.php");
require_once("../../private/send_email.php");

if(!$loggedin)
  header("location: /ekshefle/");

else {
    $old= $_SESSION['loggedin_user'];
    $new= mysqli_real_escape_string($db, $_POST['new_email']);
    if(validate_email($new))
    {
        $e_exist="SELECT doc_email from doctor where doc_email= '$new'";
        $e_result= $db->query($e_exist);
        if(mysqli_num_rows($e_result)>0){
            echo '<h3>Error: Email already exists!</h3>
                    <a type="button" href="/ekshefle/profile/">Go back to profile</a>';
        }
        else 
            {
                if($db->query("UPDATE doctor set doc_email='$new' where doc_email='$old'"))
                {
                    $get_hash=$db->query("SELECT hash from doctor where doc_email='$new'");
                    $record=$get_hash->fetch_assoc();
                    if(send_email($new, $record['hash']))
                        echo '<h3>Email changed successfully and confirmation mail has been sent to you.</h3>
                            <a type="button" href="/ekshefle/profile/">Login Again</a>';

                    else '<h3>Email changed successfully But failed to send verifivation email.</h3>
                            <a type="button" href="/ekshefle/profile/">Login Again</a>';
                }
            }
    }
    else echo '<h3>Wrong email!</h3>
                <a type="button" href="/ekshefle/profile/">Go back to profile</a>';
}
?>