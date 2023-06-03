<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $sid = $_POST['sid'];
        $isbn = $_POST['isbn'];
        $date = date("Y-m-d");
        echo $date;

        $sql = "INSERT INTO issue (student_id, book_id, date) VALUES ('$sid', '$isbn', '$date')";

        if(mysqli_query($conn,$sql))
        {
            echo "Data inserted successfully";
            header("location: ../admin/issue.php");
        }

        else
        {
            echo "Error on insert ". mysqli_error($con);
        }
    }
?>