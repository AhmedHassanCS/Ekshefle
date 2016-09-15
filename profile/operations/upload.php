<?php

    require_once("../../private/session.php");

    $sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
    $targetPath = "../../images/profile_pics/".$_SESSION['loggedin_user'].".jpg"; // Target path where file is to be
    move_uploaded_file($sourcePath,$targetPath) ;  

?>