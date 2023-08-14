<?php
    include '../includes/config.php';

    if ( isset($_POST['submit']) ) {
        $user_id = intval($_POST['userid']);
        $numsofbooks = intval($_POST['numsofbooks']);

        $sql = "INSERT INTO requests (u_id, status) VALUES ($user_id, 0)";
        if ( mysqli_query($conn, $sql) )    {
            $last_id = $conn->insert_id;

            $sql1 = "CREATE TABLE request{$last_id} (b_id int, quantity int)";
            if ( mysqli_query($conn, $sql1) )    {
                for ( $i = 0; $i < $numsofbooks; $i++ ) {
                    $book_id = intval($_POST['bookID']);
                    $quantity = intval($_POST['quantity']);

                    $sql2 = "INSERT INTO request{$last_id} (b_id, quantity) VALUES ($book_id, $quantity)";
                    if ( mysqli_query($conn, $sql2) )    {
                        echo "Operation Successfull !";
                        header('Location: ../home.php');
                    }
                }
            }
        }
        
    }
?>