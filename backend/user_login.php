<?php
   include("../includes/config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {

        $user = intval($_POST['user']);
        $useremail = mysqli_real_escape_string($conn,$_POST['email']);
        $userpassword = mysqli_real_escape_string($conn,$_POST['password']);
        
        if ($user == 1) {
            $sql = "SELECT * FROM user WHERE email = '$useremail' and password = md5('$userpassword') AND role = $user";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $count = mysqli_num_rows($result);
                
            if($count == 1) {
                $_SESSION["userloggedin"] = true;
                // $_SESSION["email"] = $useremail;
                // $_SESSION["password"] = $userpassword;
                // $_SESSION['user'] = $user;
                // $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['uid'];
                // $_SESSION['photo'] = $row['photo'];

                header("location: ../admin\dashboard.php");
            }else {
                echo "Your Login Name or Password is invalid";
                echo $user;
            }
        }
        if ($user == 2) {
            $sql = "SELECT uid FROM user WHERE email = '$useremail' and password = md5('$userpassword') AND role = '$user'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            

            $count = mysqli_num_rows($result);
                
            if($count == 1) {
                $_SESSION["userloggedin"] = true;
                // $_SESSION["email"] = $useremail;
                // $_SESSION["password"] = $userpassword;
                // $_SESSION['user'] = $user;
                // $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['uid'];
                // $_SESSION['photo'] = $row['photo'];

                header("location: ../home.php");
            }else {
                echo "Your Login Name or Password is invalid";
                
            }
        }
        if ($user == 3) {
            $sql = "SELECT * FROM user WHERE email = '$useremail' and password = md5('$userpassword') AND role = '$user'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            echo $user;

            $count = mysqli_num_rows($result);
                
            if($count == 1) {
                $_SESSION["userloggedin"] = true;
                // $_SESSION["email"] = $useremail;
                // $_SESSION["password"] = $userpassword;
                // $_SESSION['user'] = $user;
                // $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['uid'];
                // $_SESSION['photo'] = $row['photo'];

                header("location: ../home.php");
            }else {
                $error = "Your Login Name or Password is invalid";
                echo $user;
                echo $error;
            }
        }
   }
?>