


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
        $course = $_POST['course'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $publish_date = date("Y-m-d");


        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }

        $photo =  $_FILES["photo"]["name"];
        $date = date("Y-m-d");
         
        $sql = "INSERT INTO books (quantity, title, photo, category_id, course_id, author, publisher, publish_date)
         VALUES ('$quantity','$title', '$photo', '$category', '$course', '$author', '$publisher','$publish_date')";

        if(mysqli_query($conn,$sql))
        {
            $last_id = $conn->insert_id;

            // Inserting ISBN no of individual books 
            for ( $i = 1; $i <= $quantity; $i++) {
                $a = $i . 'isbn';
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