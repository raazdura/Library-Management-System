<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $sid = intval($_POST['sid']);
        $isbn = intval($_POST['isbn']);
        $date = date("Y-m-d");
        $qnty = $_POST['quantity'];
        echo $date;
        for ( $i=0; $i<$qnty; $i++) {
            $sql = "INSERT INTO returns (student_id, book_id, date_return) VALUES ('$sid', '$isbn', '$date')";

            if(mysqli_query($conn,$sql))
            {
                $sql1 = "UPDATE indi_books SET status = 1 WHERE isbn = $isbn";
                    if(mysqli_query($conn,$sql1)) {
                        echo "Data inserted successfully";
                        header("location: ../admin/return.php?page=1");
                    }
            }

            else
            {
                echo "Error on insert ". mysqli_error($con);
            }
        }
    }
?>