<?php 
  // include("dbcon.php");
  
  //  $name = $_POST['name'];
  
  //  $sql = "SELECT * FROM users WHERE name LIKE '$name%'";  
  //  $query = mysqli_query($conn,$sql);
  //  $data='';
  //  while($row = mysqli_fetch_assoc($query))
  //  {
  //      $data .=  "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['email']."</td></tr>";
  //  }
  //   echo $data;

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
      // echo "Connection Established Successfully";
  }
  
   $name = intval($_POST['quantity']);

    for ( $i = 1; $i <= $name; $i++ ) {
      $data =  "<label for='isbn' class='grid-item'><b>ISBN No.</b></label>
      <input type='text' class='grid-item' id='getQuantity' placeholder='Enter your ISBN No.' name='". $i . "isbn' required>";
            // $data = "<p>" . $row['title']. "</p>";
            echo $data;
    }
           
       
 ?>