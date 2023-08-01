<?php
   session_start();
   include 'config.php';
   
	if( !isset($_SESSION['userloggedin']) ){
      // echo "you are not logged in";
		// header("location: login.php");
		// die();
	 }
    else {
      $user_id = $_SESSION['userid'];

      $sql1 = "SELECT * FROM user WHERE uid = '$user_id'";
      $result1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

      $user_id = intval($row1['uid']);
      $user_name = $row1['username'];
      $user_email = $row1['email'];
      $user_photo = $row1['photo'];
     
    }
?>