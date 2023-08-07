<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $id = intval( $_POST['id'] );
        $code = $_POST['code'];
        $title = $_POST['title'];

        $sql = "UPDATE course SET title = '$title', code = '$code' WHERE id = $id";

        if(mysqli_query($conn,$sql))
        {
            echo "Data inserted successfully";
            header("location: ../admin/course.php?page=1");
        }

        else
        {
            echo "Error on insert ". mysqli_error($con);
        }
    }
?>