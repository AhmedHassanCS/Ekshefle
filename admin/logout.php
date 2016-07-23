<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: /ekshefle/admin/login.php");
   }
?>
