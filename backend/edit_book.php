<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';
 
        $id = $_POST['id'];
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $category = intval($_POST['category']);
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $publish_date = date("Y-m-d");

        $sql = "UPDATE books SET isbn ='$isbn', title = '$title', category_id = '$category', author ='$author', publisher = '$publisher', publish_date = '$publish_date'
        WHERE id = $id";

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