<?php 

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
  
   $name = intval($_POST['isbn']);
    $sql = "SELECT isbn FROM indi_books";
    $result = $conn->query($sql);
    while( $row = $result->fetch_assoc() )   {
        if ( $name == $row["isbn"] ) {
            $datas = "<span style='color: red; font-size: 12px;'> *This isbn no. is already exist </span>";
            echo $datas;
        }
    }
      
    
           
       
 ?>