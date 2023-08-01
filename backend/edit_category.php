<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $id = intval( $_POST['id'] );
        $name = $_POST['name'];

        $sql = "UPDATE category SET name = '$name' WHERE id = $id";

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