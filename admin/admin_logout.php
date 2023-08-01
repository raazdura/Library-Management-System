<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: admin/admin_login.php");
   }
?>
