<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $id = $_GET['id'];
        echo $id;

        $sql = "DELETE FROM category WHERE id = $id";

        if(mysqli_query($conn,$sql))
        {
            echo "Data deleted successfully successfully";
            header("location: ../admin/category.php?page=1");
        }

        else
        {
            echo "Error on insert ". mysqli_error($con);
        }
    }
?>