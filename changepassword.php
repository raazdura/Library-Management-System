

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP MySQL Ajax Live Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

  <style>
        #showdata {
          width: 100%;
        }
        .search-list {
            background-color: lightskyblue;
            padding: 5px;
            display: flex;
        }
        .search-list .book-img img {
            height: 80px;
            width: 50px;

        }
        .search-list .book-details {
            margin-left: 5px;
        }
        .search-list .book-details p {
            font-size: 16px;
            margin: 0;
        }
  </style>
</head>
<body>
<?php
    include 'includes/config.php';
?>
<div class="container mt-4">
    <p><h2>PHP MySQL Ajax Live Search</h2></p>
    <h6 class="mt-5"><b>Search Name</b></h6>
    <div class="input-group mb-4 mt-3">
         <div class="form-outline">
            <input type="text" id="getName"/>
        </div>
        <div id="showdata">
        <?php 
          $sql = "SELECT * FROM books WHERE title LIKE 's%'";  
          $query = mysqli_query($conn,$sql);
          $data='';
          while($row = mysqli_fetch_assoc($query))
          {
            ?>
            <div class="search-list">
              <div class="book-img"><img src="img/monker_d_luffy.jpg" alt=""></div>
                  <div class="book-details">
                      <p><b><?php echo " " . $row['title'] ?></b></p>
                      <p>by <?php echo " " . $row['author']; ?></p>
                  </div>
            </div>
            <?php
          }
        ?>
      </div>
    </div>
</div>
<script>
  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'backend/search.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });
</script>
</body>
</html>