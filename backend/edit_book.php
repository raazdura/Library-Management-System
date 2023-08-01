

<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';
 
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $title = $_POST['title'];
        $category = intval($_POST['category']);
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $publish_date = $_POST['publish_date'];

        echo $category;

        $sql = "UPDATE books SET title = '$title', quantity = '$quantity', category_id = '$category', author ='$author', publisher = '$publisher', publish_date = '$publish_date'
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