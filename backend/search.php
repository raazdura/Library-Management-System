<?php 
    include '../includes/config.php';
  
   $name = $_POST['name'];

    if ( !$name == "" ) {
        $sql = "SELECT * FROM books WHERE title LIKE '$name%'";  
        $query = mysqli_query($conn,$sql);
        $data='';
        while($row = $query->fetch_assoc())
        {
           $data =  "<div class='search-list'>
              <div class='book-img'><img src='img/monker_d_luffy.jpg' alt=''></div>
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