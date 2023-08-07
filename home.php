<?php
    include 'includes/user_session.php';
    include 'includes/config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library | Expore</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/header.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700&family=Poppins:wght@200;300;400;600;700&display=swap');

        :root {
            --green: #27ae60;
            --black: #192a56;
            --light-color: #666;
            --box-shadow: 0.5rem rgb(0, 0, .1);
        }
        * {
            font-family: 'Nunito', sans-serif;
            margin: 0; padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            outline: none; border: none;
            text-transform: capitalize;
            transition: all .2s linear;
        }
        html {
            font-size: 62.5%;
            overflow-x: hidden;
            scroll-padding: 5.5rem;
            scroll-behavior: smooth;
        }
        .menu {
        width: 80%;
        margin: auto;
        padding: 1rem;
        /* background-color: lightslategray; */
        }
        .menu .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(17rem, 1fr));
            gap: 2.2rem;
            margin: 20px 10px;
        }
        .menu .box-container .box {
            background: #fff;
            border: 1rem solid rgda(0,0,0, .2);
            /* border-radius: .5rem; */
            /* box-shadow: var(--box-shadow); */
            box-shadow: -7px 8px 15px 4px rgba(0, 0, 0, 0.26);
            max-width: 200px;
        }
        .menu .box-container .box .availibility {
            color: white;
            background-color: var(--green);
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 0.3rem;
        }
        .menu .box-container .box .unavailibility {
            color: white;
            background-color: red;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 0.3rem;
        }
        .menu .box-container .box .image {
            height: 25rem;
            width: 100%;
            /* padding: 5px; */
            overflow: hiddden;
            position: relative;
        }
        .menu .box-container .box .image img {
            height: 100%;
            width: 100%;
            /* border-radius: .5rem; */
        }
        .menu .box-container .box .image .fa-bookmark {
            position: absolute;
            top: 1rem; right: 1rem;
            height: 4rem;
            width: 4rem;
            line-height: 4rem;
            text-align: center;
            font-size: 2rem;
            background: #fff;
            border-radius: 50%;
            color: var(--black);
        }
        .menu .box-container .box .image .fa-bookmark:hover {
            background-color: var(--green);
            color: #fff;
        }
        .menu .box-container .box .content {
            position: relative;
            padding: 0.8rem;
            /* padding-top: 0; */
            /* text-align: center; */
        }
        .menu .box-container .box .content .fa-bookmark:hover {
            background-color: black;
            color: #fff;
        }
        .menu .box-container .box .content .stars {
            font-size: 1.7rem;
            color: var(--green);
        }
        .menu .box-container .box .content h3 {
            color: var(-black);
            font-size: 1.8rem;
        }
        .menu .box-container .box .content p {
            color: var(--light-color);
            font-size: 1.4rem;
            padding: 1rem 0;
            line-height: 1.5;
        }
        .menu .box-container .box .content .price {
            color: var(--green);
            margin-left: 1rem;
            font-size: 2.5rem;
        }
        .menu .box-container .box .image, .content h3 {
            cursor: pointer;
        }

        footer {
            height: 100px;
            background-color: #121212;
        }
        footer .footer--third {
            padding: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        footer .footer--third div {
            width: 33%;
            text-align: center;
            font-size: 1.5rem;
            color: #8f8c8d;
            display: block;
        }
        .privacy a {
            color: #8f8c8d;
            text-decoration: none;
        }
    </style>
    <style>
        .bg-img-books {
        position: relative;
        background-image: url("img/lib-img.jpg");
        background-size: cover;
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="bg-img-books">
        <h1 style="width: 80%; margin: auto; color: white; font-size: 50px; padding-left: 10px;">Books</h1>
    </div>
    <!-- <div class="hello"><img src="img/lib-img.jpg" alt=""><h1>hello</h1></div> -->
    
    <div class="menu" id="menu">
        <div class="sort" style="font-size: 1.6rem; 
            margin: auto;
            padding: 10px;">
            <span style="font-weight: 500; margin: 5px 10px;">Sort By</span>
            <span style="font-weight: 500; margin: 5px 10px;">Publish Date</span>
            <span style="font-weight: 500; margin: 5px 10px;">Author A - Z</span>
            <span style="font-weight: 500; margin: 5px 10px;">Author Z - A</span>
        </div>

        <div style="text-align: center; margin: 0 0 0 20px  ; padding: 10px; border-radius: 5px;">
            <h1 class="heading" style="font-size: 2rem;">Books in the library</h1>
        </div>

        <div class="box-container">
            <?php 
            $sql = "SELECT b.id, b.title, b.photo, b.author, b.publisher, b.status, b.publish_date,
                c.name, b.category_id, co.code as course_title
            FROM course as co
            INNER JOIN books as b
            ON co.id = b.course_id
            INNER JOIN category as c
            ON b.category_id = c.id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                echo $result->num_rows;
                $i = 0;
                while($i <= 10 && $row = $result->fetch_assoc()) {
                    ?>
                    <div class="box">
                            <?php
                            if ($row["status"] == 1) {
                                echo '<div class="availibility">AVAILABLE</div>';
                            }
                            else {
                                echo '<div class="unavailibility">UNAVAILABLE</div>';
                            }
                            ?>
                        <div class="image">
                            <img src="img/<?php echo $row['photo']; ?>" alt="imgge of the book">
                        </div>
                        <div class="content">
                        
                            <h3><?php echo $row['title']?></h3>
                            <p>
                                <b>Author:</b><?php echo $row['author'];?> <br>
                                <b>Course:</b> <?php echo $row['course_title'];?><br>
                                <b>Category:</b><?php echo $row['name'];?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <script>
document.getElementById('books').style.borderBottom = "2px solid #5C1C97";

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if(sidebar.classList.contains("active")){
                sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
            }else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>

    <script>
        let dropDown = document.getElementById("drop-down");

        function showDropdown() {
            dropDown.classList.toggle("open-dropdown");
        }
    </script>

    <?php include 'includes/footer.php'; ?>