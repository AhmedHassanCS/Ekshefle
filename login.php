<?php
   require_once('db/config.php');
   session_start();
   if(isset($_SESSION['loggedin_user'])){

      $user_check = mysqli_real_escape_string($db,$_SESSION['loggedin_user']);
   
      $ses_sql = mysqli_query($db,"select doc_email from doctor where doc_email = '$user_check' ");
      
      $count = mysqli_num_rows($ses_sql);
      if($count == 1) {
         header("location: /ekshefle/profile/");
      }
   }
   $error ="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $doc_email = mysqli_real_escape_string($db,$_POST['email']);
      $password = mysqli_real_escape_string($db,$_POST['pw']); 
      
      $sql = "SELECT doc_email FROM doctor WHERE doc_email = '$doc_email' and doc_pw = sha1('$doc_email$password')";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
         $_SESSION['loggedin_user'] = $doc_email;
         header("location: /ekshefle/profile/");
      }else {
         $error = "Your Username or Password is invalid!";
         echo $error;
      }
   }
?>
