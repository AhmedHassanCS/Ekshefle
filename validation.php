<?php
$error="";
function validate_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error= "Error: Only letters and white space allowed in names";
        return false;
    }
    else return true;
}

function validate_name($name)
{
   if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $error="Error: Invalid email format";
        return false;
    }
    else return true;

}

function validate_password($pass,$con_pass)
{
    if($pass == $con_pass) {

        if (strlen($pass) < '8') {
            $error = "Your Password Must Contain At Least 8 Characters!";
            return false;
        }
        elseif(!preg_match("#[0-9]+#",$pass)) {
            $error = "Your Password Must Contain At Least 1 Number!";
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$pass)) {
            $error = "Your Password Must Contain At Least 1 Capital Letter!";
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$pass)) {
            $error = "Your Password Must Contain At Least 1 Lowercase Letter!";
            return false;
        }
        else return true;
    }
    else {
        $error = "Error: Confirmed password doesn't match password!";
        return false;
    }
}

function validate_phone($phone)
{
   if (!preg_match("/^01[0-9]{9}$/",$phone)) {
        $error="Error: Invalid phone number!";
        return false;
    }
    else return true;

}
?>