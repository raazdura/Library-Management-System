<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $quantity = $_POST['quantity'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $publish_date = date("Y-m-d");

        $sql = "INSERT INTO books (quantity, title, category_id, author, publisher, publish_date)
         VALUES ('$quantity','$title','$category', '$author', '$publisher','$publish_date')";

        if(mysqli_query($conn,$sql))
        {
            $last_id = $conn->insert_id;

            // Inserting ISBN no of individual books 
            for ( $i = 1; $i <= $quantity; $i++) {
                $a = (string)$i;
                $isbn = $_POST[$a];
                $sql1 = "INSERT INTO indi_books (id, isbn) VALUES ('$last_id', '$isbn')";
                if (mysqli_query($conn,$sql1)) {
                    echo "Data inserted successfully";
                    header("location: ../admin/books.php?page=1");
                }
            }
        }

        else
        {
            echo "Error on insert ". mysqli_error($con);
        }

        
    }
?>