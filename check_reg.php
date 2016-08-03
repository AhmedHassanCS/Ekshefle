<?php

    if(isset($_POST['doc_email']) && isset($_POST['doc_pw']) && 
        isset($_POST['doc_fname']) && isset($_POST['doc_sname']) && isset($_POST['doc_lname']) && 
        isset($_POST['birth_date']) && isset($_POST['doc_phone']) && isset($_POST['gender']) && 
        isset($_POST['doc_address']) && isset($_POST['degree'])
        )
    {
        $email = mysqli_real_escape_string($db,$_POST['doc_email']);
        $doc_pw = mysqli_real_escape_string($db,$_POST['doc_pw']);
        $doc_fname = mysqli_real_escape_string($db,$_POST['doc_fname']);
        $doc_sname = mysqli_real_escape_string($db,$_POST['doc_sname']);
        $doc_lname = mysqli_real_escape_string($db,$_POST['doc_lname']);
        $birth_date = mysqli_real_escape_string($db,$_POST['birth_date']);
        $doc_phone = mysqli_real_escape_string($db,$_POST['doc_phone']);
        $gender = mysqli_real_escape_string($db,$_POST['gender']);
        $doc_address = mysqli_real_escape_string($db,$_POST['doc_address']);
        $degree = mysqli_real_escape_string($db,$_POST['degree']);

        if(isset(doc_nick))
            $dock_nick= mysqli_real_escape_string($db,$_POST['doc_nick']);
    }


?>