<?php
    include '../includes/config.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {

        echo 'successfully connected';

        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $course = intval($_POST['course']);

        if ( isset($_POST['photo']))    {

            echo $course;

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
            
            $sql = "UPDATE students SET firstname = '$firstname', lastname = '$lastname', photo = '$photo', course_id = '$course', created_on = '$date' 
                WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                echo "New record has been added successfully !";
                header("location: ../admin/students.php");
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
            mysqli_close($con);
            }
        else {
            echo "photo not set";

            $sql = "UPDATE students SET firstname = '$firstname', lastname = '$lastname', course_id = '$course' 
            WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                echo "New record has been added successfully !";
                header("location: ../admin/students.php");
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
            mysqli_close($con);
        }
    }
?>