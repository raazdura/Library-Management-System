<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $code = $_POST['code'];
        $title = $_POST['title'];

        $sql = "INSERT INTO course (code, title) VALUES ('$code', '$title')";

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