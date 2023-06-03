<?php
   include("../includes/config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      echo $mypassword;
      
      $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = md5('$mypassword')";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         // Store data in session variables
         $_SESSION["loggedin"] = true;
         // $_SESSION["id"] = $id;
         $_SESSION["username"] = $username;
         // Redirect user to welcome page
         header("location: dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>