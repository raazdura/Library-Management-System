<?php
    include 'includes/user_session.php';
    require_once("includes/dbcontroller.php");
    if( !isset($user_name) ){
        // echo "you are not logged in";
        header("location: login.php");
          // die();
    }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/header.css">

    <style>
        form {
            width: 80%;
            margin: auto;
            margin-top: 20px;
            padding: 10px;
            font-size: 1.5rem;
            background-color: #f5f5f5;
        }
        form h1 {
            border-bottom: 0.5px solid black;
        }
        .request-cart  .book-container {
            display: flex;
            margin: 10px 5px;
        }
        .request-cart  .book-container img {
            height: 170px;
            width: 130px;
            margin: 5px;
        }
        .request-cart  .book-container .book-info {
            margin: 5px;
        }
        .request-cart  .book-container .book-info span {
            margin: 10px 0;
        }
        .request-cart  .book-container .book-info .book-name {
            font-weight: 700;
            font-size: 2rem;
        }
        .request-cart  .book-container .book-info input {
            border: 0.5px solid black;
            padding: 5px;
        }
        .request-cart  .book-container .book-info a {
            color: red;
        }
        .submit {
            background-color: #ffffff;
            border: green 1px solid;
            padding: 6px 10px;
            color: green;
            float: right;
            text-decoration: none;
            border-radius: 3px;
            margin: 20px 0px;
            font-size: 1.5rem;
            cursor: pointer;
        }
        #btnEmpty {
            background-color: #ffffff;
            border: #d00000 1px solid;
            padding: 6px 10px;;
            color: #d00000;
            float: left;
            text-decoration: none;
            border-radius: 3px;
            margin: 20px 0px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
    <div id="shopping-cart">
    <form action="backend/sendrequest.php" method="POST">
                        <h1>Request List</h1>
        <?php
        if(isset($_SESSION["cart_item"])) {
        ?>
                <?php		
                    $i = 0;
                    foreach ($_SESSION["cart_item"] as $item){
                    $i++;
                ?>
                    <div class="request-cart">
                        
                            <div class="book-container">
                                <img src="img/<?php echo $item["image"]; ?>" alt="">
                                <div class="book-info">
                                    <span class="book-name"><?php echo $item["name"]; ?></span> <br>
                                    <span>by <?php echo $item["author"]; ?></span> <br>
                                    <span><b>ID: </b><?php echo $item["code"]; ?></span>
                                    <input type="text" name="bookID" value="<?php echo $item["code"]; ?>" style="display: none;"><br><br><br>
                                    <span><b>Quantity:</b> 
                                    <input type="text" name="quantity" value="<?php echo $item["quantity"]; ?>"></span> <br><br>
                                    <a href="requestbooks.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">
                                        <i class="fa-solid fa-trash"></i> <span>Remove</span>
                                    </a>
                                </div>
                            </div>
                    </div>
                <?php
                }
                ?>
                
                <input type="text" name="numsofbooks" value="<?php echo $i ?>" style="display: none;">
                            <input type="text" name="userid" value="<?php echo $user_id; ?>" style="display: none;">
                            <input type="submit" name="submit" value="Send Request" class="submit">
                        
                        <a id="btnEmpty" href="requestbooks.php?action=empty">Empty Cart</a>	
            </tbody>
        </table>
        <?php
            } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
            }
        ?>
    </form>
    </div>
    <?php
//Creating Connection With Database
$server = "localhost";
$username = "root";
$password = "";
$database = "myproject";

$conn = mysqli_connect($server,$username,$password,$database);

if($conn === false)
{
    die('Connection cannot be established'. mysqli_connect_error());
}

else
{
    echo "Connection Established Successfully <br>";
    $sql100 = "SELECT  COUNT(id) as total FROM indi_books WHERE id = 1 && status = 1";
    $result100 = $conn->query($sql100);
    $row100 = $result100->fetch_assoc();
    echo $row100['total'];
}

?>
</body>
</html>