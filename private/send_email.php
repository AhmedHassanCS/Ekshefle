<?php
function send_email($email,$hash)
{
    $subject = 'Signup | Verification'; // Give the email a subject 
    $message = "
     
    Thanks for signing up!
    Your account has been created, you can login and enjoy our service, but first:
     
    Please click this link to activate your account:
    http://localhost/ekshefle/verify.php?email=$email&hash=$hash
     
    "; 
                         
    $headers = 'From:noreply@gmail.com' . "\r\n";
    return mail($email, $subject, $message, $headers); // Send our email
}
?>