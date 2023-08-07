<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        echo 'successfully connected';

        $firstname = $_POST['firstname']; echo $firstname;
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $course = intval($_POST['course']);

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
         
        $sql = "INSERT INTO students (firstname, lastname, email, photo, course_id, created_on)
        VALUES('$firstname', '$lastname', '$email', '$photo', '$course', '$date')";
         if (mysqli_query($conn, $sql)) {
            echo "New record has been added successfully !";
            header("location: ../admin/books.php?page=1");
         } else {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
         }
         mysqli_close($con);
    }
?>