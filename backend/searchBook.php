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
  
   $search = $_POST['search'];

    if ( !$name == "" ) {
        $sql = "SELECT * FROM books WHERE title LIKE '$name%'";  
        $query = mysqli_query($conn,$sql);
        $data='';
        while($row = $query->fetch_assoc())
        {
           $data =  "<div class='search-list'>
              <div class='book-img'><img src='img/" . $row['photo'] . "' alt=''></div>
                  <div class='book-details'>
                      <p><b>". " " . $row['title'] . "</b></p>
                      <p>by" ." " . $row['author'] . "</p>
                  </div>
            </div>";
            // $data = "<p>" . $row['title']. "</p>";
            echo $data;
        }
    }
 ?>