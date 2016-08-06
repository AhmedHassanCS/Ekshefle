<?php
$loggedin=false;
   require_once('db/config.php');
   session_start();
   if(isset($_SESSION['loggedin_user'])){
      $user_check = mysqli_real_escape_string($db,$_SESSION['loggedin_user']);
      $ses_sql = mysqli_query($db,"select doc_email from doctor where doc_email = '$user_check' ");
      $count = mysqli_num_rows($ses_sql);
         if($count == 1) {
            $loggedin=true;
      } 
   }
?>