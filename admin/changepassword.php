<?php
    include 'includes/user_session.php';
    include 'includes/config.php';
?>

<?php
  $currentErr = $newNconfirmErr = "";
  if ( isset($_POST['submit']) ) {
    $current = $_POST['currentPassword'];
    $new = $_POST['newPassword'];
    $confirm = $_POST['confirmPassword'];
    
    if ( $current != "Raaz")  {
      $currentErr = "*Current passowrd is incorrect";
      
      if ( $new != $confirm ) {
        $newNconfirmErr = "*Confirm passowrd is not same as new password";
      }
      else {
        $sql = "UPDATE admin SET password = md5('$new') WHERE id = 1";
        if ( mysqli_query($conn, $sql) )  {
          echo "Passowrd Changed";
        }
      }
  }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/header.css">
</head>
<style>
  form {
    width: 60%;
    background-color: #e5e5e5;
    margin: auto;
    margin-top: 5%;
    padding: 40px;
  }
  form h1 {
    text-align: center;
    color: #5C1C97;
    margin-bottom: 20px;
  }
  form input,
  form label {
    width: 100%;
    font-size: 14px;
    margin: 10px 0;
    height: 20px;
    color: #5C1C97;
  }
  form input {
    padding: 5px;
    height: 30px;
  }
  button {
    background-color: #5C1C97;
    color: white;
    padding: 10px;
  }
  span {
    font-size: 12px;
    color: red;
  }
</style>
<body>
  <header>
    <div class="navbar">
      <div class="logo-details">
          <a href="index.php">
              <i class='bx bx-book'></i>
            <span class="logo_name" style="text-decoration: none;">Library</span>
          </a>
          <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
          </div>
      </div>
    </div>
  </header>
  <form action="" method="POST">
    <h1>Change Password</h1>
    <br>
    <span><?php echo $currentErr; ?></span>
    <br>
    <span><?php echo $newNconfirmErr; ?></span>
    <br>
    <label for="Current Password">Current Passowrd</label>
    <input type="password" name="currentPassword" id="currentPassword" required>
    
    <label for="Current Password">New Passowrd</label>
    <input type="password" name="newPassword" id="newPassword" required>

    <label for="Current Password">Confirm Passowrd</label>
    <input type="password" name="confirmPassword" id="confirmPassword" required>

    <button name="submit" onclick="myFunction();">Save</button>
  </form>
</body>
</html>



