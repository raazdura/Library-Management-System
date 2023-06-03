<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $publish_date = date("Y-m-d");

        $sql = "INSERT INTO books (isbn, title, category_id, author, publisher, publish_date)
         VALUES ('$isbn','$title','$category', '$author', '$publisher','$publish_date')";

        if(mysqli_query($conn,$sql))
        {
            echo "Data inserted successfully";
            header("location: ../admin/books.php");
        }

        else
        {
            echo "Error on insert ". mysqli_error($con);
        }
    }
?>