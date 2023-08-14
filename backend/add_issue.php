<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $sid = $_POST['sid'];
        $date = date("Y-m-d");
        $qnty = $_POST['quantity'];
        echo $date;
        for ( $i=1; $i<=$qnty; $i++) {
            $isbn = intval($_POST[$i.'isbn']);
            echo $isbn;
            $qry = "SELECT id FROM indi_books WHERE isbn = $isbn";
            if(mysqli_query($conn,$qry))    {
            
                $sql = "INSERT INTO issue (student_id, isbn, date) VALUES ('$sid', $isbn, '$date')";

                if(mysqli_query($conn,$sql))
                {
                    $sql1 = "UPDATE indi_books SET status = 0 WHERE isbn = $isbn";
                    if(mysqli_query($conn,$sql1)) {
                        echo "Data inserted successfully";
                        // header("location: ../admin/issue.php?page=1");
                    }
                }
                else
                {
                    echo "Error on insert ". mysqli_error($con);
                }
            }
        }
    }
?>