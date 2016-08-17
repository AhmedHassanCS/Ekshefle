<?php
   //--------prevent direct access---------------
   if( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) &&
       strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != "xmlhttprequest")
           header("location: /ekshefle/");
   //--------/prevent direct access---------------
   
   require_once('db/config.php');
   require_once('private/test_input.php');
   session_start();

   $error ="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $doc_email = mysqli_real_escape_string($db,$_POST['email']);
      $password = mysqli_real_escape_string($db,$_POST['pw']);
      $doc_email= test_input($doc_email);
      $password= test_input($password);

      
      $sql = "SELECT doc_email FROM doctor WHERE doc_email = '$doc_email' and doc_pw = sha1('$doc_email$password')";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
         $_SESSION['loggedin_user'] = $doc_email;
         echo "1";
      }else {
         $error = "Invalid Username or Password!";
         echo $error;
      }
   }
?>
