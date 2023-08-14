<?php
    include 'includes/user_session.php';
    include 'includes/config.php';
?>

<?php
    require_once("includes/dbcontroller.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM books WHERE id ='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["title"], 'code'=>$productByCode[0]["id"], 'quantity'=>$_POST["quantity"], 'author'=>$productByCode[0]["author"], 'image'=>$productByCode[0]["Photo"]));
                
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode[0]["id"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
        break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);				
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["cart_item"]);
        break;	
    }
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
            padding: 1rem;
            /* background-color: lightslategray; */
        }
        .menu .box-container .boxes {
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
            /* max-width: 200px; */
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
    <style>
        .cart-action {
            display: flex;
        }

        .product-quantity {
            width: 30%;
            padding: 5px 10px;
            border: #E0E0E0 1px solid;
            margin: 5px;
        }
        .btnAddAction {
            width: 70%;
            padding: 5px 10px;
            background-color: #efefef;
            border: #E0E0E0 1px solid;
            color: #211a1a;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
            margin: 5px;
        }
    </style>
    <style>
        #wrapper {
        margin: 0 auto;
        display: block;
        width: 960px;
        }
        .page-header {
        text-align: center;
        font-size: 1.5em;
        font-weight: normal;
        border-bottom: 1px solid #ddd;
        margin: 30px 0
        }
        #pagination {
        margin: 25px 0 10px 0;
        padding: 0;
        text-align: center
        }
        #pagination li {
        display: inline
        }
        #pagination li a {
        display: inline-block;
        text-decoration: none;
        padding: 5px 10px;
        color: #000
        }

        /* Active and Hoverable Pagination */
        #pagination li a {
        border-radius: 5px;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
        font-size: 1.5rem;
            
        }
        #pagination li a.active {
        background-color: #4caf50;
        color: #fff
        }
        #pagination li a:hover:not(.active) {
        background-color: #ddd;
        } 
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="bg-img-books">
        <h1 style="width: 80%; margin: auto; color: white; font-size: 50px; padding-left: 10px;">Books</h1>
    </div>
    
    <div class="menu" id="menu">
        <div class="sort" style="font-size: 1.6rem; 
            margin: auto;
            padding: 10px;
            height: 50px">
            <span style="font-weight: 500; padding: 10px;">Sort By</span>
            <?php
                if(!empty($_GET["sort"])) {
                    switch($_GET["sort"]) {
                        case "authorAZ":
                            ?>
                            <a href="?sort=authorAZ">
                                <span style="font-weight: 500; padding: 10px; background: lightblue; text-decoration: none;">Author A - Z</span>
                            </a>
                            <a href="?sort=authorZA">
                                <span style="font-weight: 500; padding: 10px; text-decoration: none;">Author Z - A</span>
                            </a>
                            <?php
                        break;
                        case "authorZA":
                            ?>
                            <a href="?sort=authorAZ">
                                <span style="font-weight: 500; padding: 10px; text-decoration: none;">Author A - Z</span>
                            </a>
                            <a href="?sort=authorZA">
                                <span style="font-weight: 500; padding: 10px; background: lightblue; text-decoration: none;">Author Z - A</span>
                            </a>
                            <?php
                        break;
                        }
                } else {
                    ?>
                    <a href="?sort=authorAZ">
                        <span style="font-weight: 500; padding: 10px; text-decoration: none;">Author A - Z</span>
                    </a>
                    <a href="?sort=authorZA">
                        <span style="font-weight: 500; padding: 10px; text-decoration: none;">Author Z - A</span>
                    </a>
                    <?php
                }
            ?>
            
        </div>

        <div style="text-align: center; margin: 0 0 0 20px  ; padding: 10px; border-radius: 5px;">
            <h1 class="heading" style="font-size: 2rem;">Books in the library</h1>
        </div>

        <div class="box-container">
            <?php
                if(!empty($_GET["sort"])) {
                    switch($_GET["sort"]) {
                        case "authorAZ":
                            ?>
                            <div class="boxes">
                                <?php 
                                // Function to perform the quicksort
                                function quicksort(&$arr, $left, $right) {
                                    if ($left < $right) {
                                        $pivotIndex = partition($arr, $left, $right);
                                        quicksort($arr, $left, $pivotIndex - 1);
                                        quicksort($arr, $pivotIndex + 1, $right);
                                    }
                                }

                                // Function to partition the array for quicksort
                                function partition(&$arr, $left, $right) {
                                    $pivot = $arr[$right]['author'];
                                    $pivotIndex = $left;

                                    for ($i = $left; $i < $right; $i++) {
                                        if ($arr[$i]['author'] < $pivot) {
                                            // Swap arr[$i] and arr[$pivotIndex]
                                            $temp = $arr[$i];
                                            $arr[$i] = $arr[$pivotIndex];
                                            $arr[$pivotIndex] = $temp;

                                            $pivotIndex++;
                                        }
                                    }

                                    // Swap arr[$pivotIndex] and arr[$right] (put pivot in correct place)
                                    $temp = $arr[$pivotIndex];
                                    $arr[$pivotIndex] = $arr[$right];
                                    $arr[$right] = $temp;

                                    return $pivotIndex;
                                }

                                // Replace these with your actual database connection details
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "myproject";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch data from the database
                                $sql = "SELECT b.id, b.title, b.photo, b.author, b.publisher, b.status, b.publish_date,
                                c.name, b.category_id, co.code as course_title
                                FROM course as co
                                INNER JOIN books as b
                                ON co.id = b.course_id
                                INNER JOIN category as c
                                ON b.category_id = c.id";
                                $result = $conn->query($sql);

                                $books = array();

                                if ($result->num_rows > 0) {
                                    // Populate the $books array with data from the database
                                    while ($row = $result->fetch_assoc()) {
                                        $books[] = $row;
                                    }

                                    // Sort the books array using quicksort
                                    quicksort($books, 0, count($books) - 1);

                                    // Number of records to display per page
                                    $recordsPerPage = 2;

                                    $total_pages =  floor(count($books) / 2) + 1;

                                    // Get the current page number from the query parameter
                                    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                                    // Calculate the starting index for the current page
                                    $startIndex = ($current_page - 1) * $recordsPerPage;

                                    // Slice the books array to display only the records for the current page
                                    $booksToDisplay = array_slice($books, $startIndex, $recordsPerPage);

                                    // Print the books for the current page
                                    foreach ($booksToDisplay as $book) {
                                        ?>
                                            <div class="box">
                                            <form method="post" action="home.php?action=add&code=<?php echo $book['id']; ?>">
                                                    <?php
                                                    $sql100 = "SELECT  COUNT(id) as total FROM indi_books WHERE id = {$book['id']} && status = 1";
                                                    $result100 = $conn->query($sql100);
                                                    $row100 = $result100->fetch_assoc();
                                                    
                                                    if ($row100['total'] > 0) {
                                                        echo '<div class="availibility">AVAILABLE</div>';
                                                    }
                                                    else {
                                                        echo '<div class="unavailibility">OUT OF STOCK</div>';
                                                    }
                                                    ?>
                                                <div class="image">
                                                    <img src="img/<?php echo $book['photo']; ?>" alt="imgge of the book">
                                                </div>
                                                <div class="content">
                                                
                                                    <h3><?php echo $book['title']?></h3>
                                                    <p>
                                                        <b>Author:</b><?php echo $book['author'];?> <br>
                                                        <b>Course:</b> <?php echo $book['course_title'];?><br>
                                                        <b>Category:</b><?php echo $book['name'];?>
                                                    </p>
                                                </div>
                                                <div class="cart-action">
                                                    <?php
                                                        if ($row100['total'] > 0) {
                                                            ?>
                                                            <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                                            <input type="submit" value="Add to Cart" class="btnAddAction" />
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </form>
                                            </div>
                                        <?php
                                            }
                                            
                                            } else {
                                                echo "No books found in the database.";
                                            }

                                            // Close the database connection
                                            $conn->close();
                                        ?>
                            </div>
                            <ul id="pagination">
                                            <?php
                                                if ($current_page > 1) {
                                                    ?>
                                                    <li><a class="" href="?page=<?php echo $current_page - 1; ?>&sort=authorAZ">Previous</a></li>
                                                    <?php
                                                }
                                            ?>
                                
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $activeClass = ($i === $current_page) ? "active" : "";
                                    echo "<li><a href='?page=$i&sort=authorZA' class='$activeClass'>$i</a></li> ";
                                }
                                ?>
                                <li><a href="?page=<?php echo $current_page + 1; ?>&sort=authorAZ">Next</a></li>
                            </ul> 
                            <?php
                        break;
                        case "authorZA":
                            ?>
                            <div class="boxes">
                                <?php 
                                // Function to perform the quicksort
                                function quicksort(&$arr, $left, $right) {
                                    if ($left < $right) {
                                        $pivotIndex = partition($arr, $left, $right);
                                        quicksort($arr, $left, $pivotIndex - 1);
                                        quicksort($arr, $pivotIndex + 1, $right);
                                    }
                                }

                                // Function to partition the array for quicksort
                                function partition(&$arr, $left, $right) {
                                    $pivot = $arr[$right]['author'];
                                    $pivotIndex = $left;

                                    for ($i = $left; $i < $right; $i++) {
                                        if ($arr[$i]['author'] > $pivot) {
                                            // Swap arr[$i] and arr[$pivotIndex]
                                            $temp = $arr[$i];
                                            $arr[$i] = $arr[$pivotIndex];
                                            $arr[$pivotIndex] = $temp;

                                            $pivotIndex++;
                                        }
                                    }

                                    // Swap arr[$pivotIndex] and arr[$right] (put pivot in correct place)
                                    $temp = $arr[$pivotIndex];
                                    $arr[$pivotIndex] = $arr[$right];
                                    $arr[$right] = $temp;

                                    return $pivotIndex;
                                }

                                // Replace these with your actual database connection details
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "myproject";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch data from the database
                                $sql = "SELECT b.id, b.title, b.photo, b.author, b.publisher, b.status, b.publish_date,
                                c.name, b.category_id, co.code as course_title
                                FROM course as co
                                INNER JOIN books as b
                                ON co.id = b.course_id
                                INNER JOIN category as c
                                ON b.category_id = c.id";
                                $result = $conn->query($sql);

                                $books = array();

                                if ($result->num_rows > 0) {
                                    // Populate the $books array with data from the database
                                    while ($row = $result->fetch_assoc()) {
                                        $books[] = $row;
                                    }

                                    // Sort the books array using quicksort
                                    quicksort($books, 0, count($books) - 1);

                                    // Number of records to display per page
                                    $recordsPerPage = 2;

                                    $total_pages =  floor(count($books) / 2) + 1;

                                    // Get the current page number from the query parameter
                                    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                                    // Calculate the starting index for the current page
                                    $startIndex = ($current_page - 1) * $recordsPerPage;

                                    // Slice the books array to display only the records for the current page
                                    $booksToDisplay = array_slice($books, $startIndex, $recordsPerPage);

                                    // Print the books for the current page
                                    foreach ($booksToDisplay as $book) {
                                        ?>
                                            <div class="box">
                                            <form method="post" action="home.php?action=add&code=<?php echo $book['id']; ?>">
                                            <?php
                                            
                                            $sql100 = "SELECT  COUNT(id) as total FROM indi_books WHERE id = {$book['id']} && status = 1";
                                            $result100 = $conn->query($sql100);
                                            $row100 = $result100->fetch_assoc();
                                            
                                            if ($row100['total'] > 0) {
                                                echo '<div class="availibility">AVAILABLE</div>';
                                            }
                                            else {
                                                echo '<div class="unavailibility">OUT OF STOCK</div>';
                                            }
                                            ?>
                                        <div class="image">
                                            <img src="img/<?php echo $book['photo']; ?>" alt="imgge of the book">
                                        </div>
                                        <div class="content">
                                        
                                            <h3><?php echo $book['title']?></h3>
                                            <p>
                                                <b>Author:</b><?php echo $book['author'];?> <br>
                                                <b>Course:</b> <?php echo $book['course_title'];?><br>
                                                <b>Category:</b><?php echo $book['name'];?>
                                            </p>
                                        </div>
                                        <div class="cart-action">
                                            <?php
                                                if ($row100['total'] > 0) {
                                                    ?>
                                                    <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                                    <input type="submit" value="Add to Cart" class="btnAddAction" />
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </form>
                                            </div>
                                        <?php
                                            }
                                            
                                            } else {
                                                echo "No books found in the database.";
                                            }

                                            // Close the database connection
                                            $conn->close();
                                        ?>
                            </div>
                            <ul id="pagination">
                                <li><a class="" href="?page=<?php echo $current_page - 1; ?>&sort=authorZA">Previous</a></li>
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $activeClass = ($i === $current_page) ? "active" : "";
                                    echo "<li><a href='?page=$i&sort=authorAZ' class='$activeClass'>$i</a></li> ";
                                }
                                ?>
                                <li><a href="?page=<?php echo $current_page + 1; ?>&sort=authorZA">Next</a></li>
                            </ul> 
                            <?php
                        break;
                    }
                } 
                else {
                    ?>
                    <div class="boxes">
                        <?php 
                        // Function to perform the quicksort
                        function quicksort(&$arr, $left, $right) {
                            if ($left < $right) {
                                $pivotIndex = partition($arr, $left, $right);
                                quicksort($arr, $left, $pivotIndex - 1);
                                quicksort($arr, $pivotIndex + 1, $right);
                            }
                        }

                        // Function to partition the array for quicksort
                        function partition(&$arr, $left, $right) {
                            $pivot = $arr[$right]['title'];
                            $pivotIndex = $left;

                            for ($i = $left; $i < $right; $i++) {
                                if ($arr[$i]['title'] < $pivot) {
                                    // Swap arr[$i] and arr[$pivotIndex]
                                    $temp = $arr[$i];
                                    $arr[$i] = $arr[$pivotIndex];
                                    $arr[$pivotIndex] = $temp;

                                    $pivotIndex++;
                                }
                            }

                            // Swap arr[$pivotIndex] and arr[$right] (put pivot in correct place)
                            $temp = $arr[$pivotIndex];
                            $arr[$pivotIndex] = $arr[$right];
                            $arr[$right] = $temp;

                            return $pivotIndex;
                        }

                        // Replace these with your actual database connection details
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "myproject";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch data from the database
                        $sql = "SELECT b.id, b.title, b.photo, b.author, b.publisher, b.status, b.publish_date,
                        c.name, b.category_id, co.code as course_title
                        FROM course as co
                        INNER JOIN books as b
                        ON co.id = b.course_id
                        INNER JOIN category as c
                        ON b.category_id = c.id";
                        $result = $conn->query($sql);

                        $books = array();

                        if ($result->num_rows > 0) {
                            // Populate the $books array with data from the database
                            while ($row = $result->fetch_assoc()) {
                                $books[] = $row;
                            }

                            // Sort the books array using quicksort
                            quicksort($books, 0, count($books) - 1);

                            // Number of records to display per page
                            $recordsPerPage = 2;

                            $total_pages =  floor(count($books) / 2) + 1;

                            // Get the current page number from the query parameter
                            $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                            // Calculate the starting index for the current page
                            $startIndex = ($current_page - 1) * $recordsPerPage;

                            // Slice the books array to display only the records for the current page
                            $booksToDisplay = array_slice($books, $startIndex, $recordsPerPage);

                            // Print the books for the current page
                            foreach ($booksToDisplay as $book) {
                                ?>
                                    <div class="box">
                                    <form method="post" action="home.php?action=add&code=<?php echo $book['id']; ?>">
                                            <?php
                                            
                                            $sql100 = "SELECT  COUNT(id) as total FROM indi_books WHERE id = {$book['id']} && status = 1";
                                            $result100 = $conn->query($sql100);
                                            $row100 = $result100->fetch_assoc();
                                            
                                            if ($row100['total'] > 0) {
                                                echo '<div class="availibility">AVAILABLE</div>';
                                            }
                                            else {
                                                echo '<div class="unavailibility">OUT OF STOCK</div>';
                                            }
                                            ?>
                                        <div class="image">
                                            <img src="img/<?php echo $book['photo']; ?>" alt="imgge of the book">
                                        </div>
                                        <div class="content">
                                        
                                            <h3><?php echo $book['title']?></h3>
                                            <p>
                                                <b>Author:</b><?php echo $book['author'];?> <br>
                                                <b>Course:</b> <?php echo $book['course_title'];?><br>
                                                <b>Category:</b><?php echo $book['name'];?>
                                            </p>
                                        </div>
                                        <div class="cart-action">
                                            <?php
                                                if ($row100['total'] > 0) {
                                                    ?>
                                                    <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                                    <input type="submit" value="Add to Cart" class="btnAddAction" />
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </form>
                                    </div>
                                <?php
                                    }
                                    
                                    } else {
                                        echo "No books found in the database.";
                                    }

                                    // Close the database connection
                                    $conn->close();
                                ?>
                    </div>
                    <ul id="pagination">
                        <li><a class="" href="?page=<?php echo $current_page - 1; ?>">Previous</a></li>
                        <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $activeClass = ($i === $current_page) ? "active" : "";
                                echo "<li><a href='?page=$i' class='$activeClass'>$i</a></li> ";
                            }
                        ?>
                        <li><a href="?page=<?php echo $current_page + 1; ?>">Next</a></li>
                    </ul> 
                    <?php
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