<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $name = $_POST['name'];

        $sql = "INSERT INTO category (name) VALUES ('$name')";

        if(mysqli_query($conn,$sql))
        {
            echo "Data inserted successfully";
            header("location: ../admin/category.php");
        }

        else
        {
            echo "Error on insert ". mysqli_error($con);
        }
    }
?>