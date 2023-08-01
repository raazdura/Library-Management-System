<?php
//Creating Connection With Database
$server = "localhost";
$username = "root";
$password = "";
$database = "myproject";

$conn = mysqli_connect($server,$username,$password,$database);

if($conn === false)
{
    die('Connection cannot be established'. mysqli_connect_error());
}

else
{
    // echo "Connection Established Successfully";
}

?>
