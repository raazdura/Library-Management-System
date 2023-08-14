<?php
    include 'includes/user_session.php';
    include 'includes/config.php';
    if( !isset($user_name) ){
        // echo "you are not logged in";
        header("location: login.php");
          // die();
       }
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
            /* padding: 1rem; */
            /* background-color: lightskyblue;
            border-radius: 10px; */
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
            /* box-shadow: -7px 8px 15px 4px rgba(0, 0, 0, 0.26); */
            max-width: 200px;
        }
        .menu .box-container .box .availibility {
            color: white;
            background-color: var(--green);
            text-align: center;
            font-size: 1.6rem;
            font-weight: 600;
            padding: 0.3rem;
        }
        .menu .box-container .box .image {
            height: 25rem;
            width: 100%;
            overflow: hiddden;
            position: relative;
            padding: 5px;
        }
        .menu .box-container .box .image:hover {
            padding: 0;
        }
        .menu .box-container .box .image img {
            height: 100%;
            width: 100%;
            box-shadow: -7px 8px 15px 4px rgba(0, 0, 0, 0.26);
        }
        .menu .box-container .box .content h2 {
            color: var(-black);
            font-size: 1.7rem;
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
        .user-profile {
            background-color: lightskyblue;
            width: 80%;
            margin: auto;
            margin-top: 10px;
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 10px;
        }
        .user-profile .user-img img {
            height: 100px;
            width: 100px;
            border-radius: 10px;

        }
        .user-profile .user-details {
            margin-left: 20px;
        }
        .user-profile .user-details p {
            margin: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
    <div class="user-profile">
        <?php 
            $sql2 = "SELECT s.firstname, s.lastname, s.id , c.title, c.code
            FROM students as s
            INNER JOIN course as c
            ON s.course_id = c.id 
            WHERE user_id = $user_id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            if ($result2->num_rows > 0){
                ?>
                <div class="user-img"><img src="img/<?php echo $user_photo; ?>" alt=""></div>
                <div class="user-details">
                    <p><b>Name:</b><?php echo " " . $row2['firstname'] . " " . $row2['lastname']; ?></p>
                    <p><b>Faculty:</b><?php echo " " . $row2['title'] . "(" . $row2['code'] . ")" ?></p>
                    <!-- <p><b>Batch:</b></p> -->
                    <p><b>Student ID:</b><?php echo " " . $row2['id']; ?></p>
                </div>
                <?php
            }
        ?>
        
    </div>
    <!-- <div class="sort" style="font-size: 1.6rem;">
        <span style="font-weight: 500;">Sort By</span>
        <span>Publish Date</span>
        <span>Author A - Z</span>
        <span>Author Z - A</span>
    </div> -->
    
    <section class="menu" id="menu">
        
        <div style="text-align: center; margin-top: 40px; padding: 10px; border-radius: 5px; background: lightcoral;">
            <!-- <h3 class="heading" style="font-size: 2rem;">Books</h3> -->
            <h1 class="sub-heading" style="font-size: 2rem;">Books you have borrowed</h1>
        </div>

    <div class="box-container">
    
        <?php 
        $sql = "SELECT i.date, i.status, ib.isbn, b.title, b.photo
                FROM issue as i
                INNER JOIN indi_books as ib
                ON i.isbn = ib.isbn
                INNER JOIN books as b
                ON ib.id = b.id
                WHERE i.student_id = $user_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            
            $i = 0;
            while($i <= 10 && $row = $result->fetch_assoc()) {
                ?>
                <div class="box">
                        
                    <div class="image">
                        <img src="img/<?php echo $row['photo']; ?>" alt="">
                    </div>
                    <div class="content" style="text-align: center; margin-top: 10px;">
                    
                        <h2><?php echo $row['title']?></h2>
                        <p>
                            <b>ISBN No.:</b><?php echo " " . $row['isbn'];?> <br>
                            <b>Issue Date:</b> <?php echo " " . $row['date'];?><br>
                        </p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    </section>

    <script>
        document.getElementById('myBooks').style.borderBottom = "2px solid #5C1C97";

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