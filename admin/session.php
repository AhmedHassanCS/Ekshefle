<?php
   require_once('/../db/config.php');
   session_start();
   if(!isset($_SESSION['login_user'])){
      header("location: /ekshefle/admin/login.php");
   }
   else{
   $user_check = mysqli_real_escape_string($db,$_SESSION['login_user']);
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   $count = mysqli_num_rows($ses_sql);
      if($count != 1) {
         header("location: /ekshefle/admin/login.php");
      }
   }
?>