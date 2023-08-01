<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';
?>


    <div class="home-content">
      <div class="table-container">
      <div class="new-container">
      <button onclick="openForm()" class="new">+ New</button>
      <div id="myForm" class="form-popup">
          <form action="../backend/add_book.php" class="form-container" method="POST">
            <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
              <h2>Add Book <button type="button" onclick="closeForm()">X</button></h2>
            </div>
            <div class="grid-container">
              <label for="title" class="grid-item"><b>Title</b></label>
              <input type="text" class="grid-item" placeholder="Enter title of the book" name="title" required>

              <label for="category" class="grid-item"><b>Category</b></label>
              <select name="category" class="grid-item" id="category">
                <?php
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
                  else {
                    $sql = "SELECT * 
                    FROM category";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                ?>
                        <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
                <?php
                      }
                    } 
                    else {
                      echo "0 results";
                    }
                  }
                ?>
              </select>

              <label for="author" class="grid-item"><b>Author</b></label>
              <input type="text" class="grid-item" placeholder="Enter author of the book" name="author" required>

              <label for="publisher" class="grid-item"><b>Publisher</b></label>
              <input type="text" class="grid-item" placeholder="Enter publisher" name="publisher" required>

              <label for="publish_date" class="grid-item"><b>Publish Date</b></label>
              <input type="text" class="grid-item" placeholder="Enter publish date" name="publish_date" required> 
              
              <label for="quantity" class="grid-item"><b>Quantity</b></label>
              <input type="text" class="grid-item" id="getQuantity" placeholder="Enter your quantity" name="quantity" required>
              
            </div>
            <div id="isbn-container" class="grid-container">
                
            </div>
            <div style="border-top: 0.5px solid #D3D3D3;">
              <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
              <button type="button" class="btn cancel" onclick="closeForm()"><i class="fa-solid fa-xmark"></i>Close</button>
            </div>
          </form>
      </div>
      <form class="category">
          <label>Category: </label>
          <select class="form-control input-sm" id="select_category">
            <option value="0">ALL</option>
            <?php
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                else {
                  $sql = "SELECT * 
                  FROM category";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
              ?>
                      <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
              <?php
                    }
                  } 
                  else {
                    echo "0 results";
                  }
                }
              ?>
          </select>
      </form>
      </div>
      <div class="search-container">
        <form action="books.php?page=1" class="search-bar" method="POST">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Search...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
        <table>
          <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>Auther</th>
            <th>Publisher</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          <?php

            $page = $_GET['page'];
            
            if(isset($_POST["search"])) {
              $search = $_POST['search'];
              $sql = "SELECT b.id, b.title, b.author, b.publisher, b.quantity, b.status, b.publish_date, c.name, b.category_id
              FROM books as b
              INNER JOIN category as c
              ON b.category_id = c.id
              WHERE title LIKE '$search%'";
              $result = $conn->query($sql);
            }
            else {
              $sql = "SELECT b.id, b.title, b.author, b.publisher, b.quantity, b.status, b.publish_date, c.name, b.category_id
              FROM books as b
              INNER JOIN category as c
              ON b.category_id = c.id";
              $result = $conn->query($sql);
            }
            
            $total_page =  floor($result->num_rows / 5) + 1;
            echo $total_page;

            if ($result->num_rows > 0) {
              // output data of each row
              $i = 0;
              $r = 0;
              if ($page > 1) {
                $r = $r + $page * 10 - 10;
                mysqli_data_seek($result, $r);
              }
              while($i < 10 && $row = $result->fetch_assoc()) {
                $i = $i + 1;
          ?>
                  <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["author"] ?></td>
                    <td><?php echo $row["publisher"] ?></td>
                    <td><?php echo $row["quantity"] ?></td>
                    <td><?php
                      if( $row["status"] == 0) {
                      ?>
                        <Button style="background: red; border: none; border-radius: 5px; color: white; padding: 0 5px;">unavailable</Button></td>
                      <?php
                      }
                      else {
                      ?>
                          <Button style="background: green; border: none; border-radius: 5px; color: white; padding: 0 5px;">available</Button></td>
                      <?php
                      }
                      ?>
                    </td>
                    <td>
                      <button class="edit"  onclick="openEditForm('<?php echo $row['id'];?>', '<?php echo $row['category_id']; ?>', 
                        '<?php echo $row['title']; ?>', '<?php echo $row['author']; ?>', '<?php echo $row['publisher']; ?>', 
                        '<?php echo $row['quantity']; ?>', '<?php echo $row['publish_date']; ?>', '<?php echo $row['name']; ?>')" >
                        <i class="fa-solid fa-pen-to-square" style="margin-right: 1px;">
                      </i>Edit</button>

                      <div id="editForm" class="form-popup">
                        <form action="../backend/edit_book.php" class="form-container" method="POST">
                          <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
                            <h2>Edit Book <button type="button" onclick="closeEditForm()">X</button></h2>
                          </div>
                          <div class="grid-container">
                          <label for="id" class="grid-item" style="display: none;"><b>Book ID</b></label>
                          <input type="text" class="grid-item" style="display: none;" name="id" id="id" required>

                          <label for="title" class="grid-item"><b>Title</b></label>
                          <input type="text" class="grid-item" id="name" name="title" required>

                          <label for="quantity" class="grid-item"><b>Quantity</b></label>
                          <input type="text" class="grid-item" name="quantity" id="quantity" required>

                          <label for="category" class="grid-item" id="category"><b>Category</b></label>
                          <select name="category" class="grid-item" id="category">
                            <option id="first"></option>
                            <?php
                              if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                              }
                              else {
                                $sql1 = "SELECT * 
                                FROM category";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                  // output data of each row
                                  while($row1 = $result1->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>
                            <?php
                                  }
                                } 
                                else {
                                  echo "0 results";
                                }
                              }
                            ?>
                          </select>

                          <label for="author" class="grid-item"><b>Author</b></label>
                          <input type="text" class="grid-item" id="author" name="author" required>

                          <label for="publisher" class="grid-item"><b>Publisher</b></label>
                          <input type="text" class="grid-item" id="publisher" name="publisher" required>

                          <label for="publish_date" class="grid-item"><b>Publish Date</b></label>
                          <input type="text" class="grid-item" id="publish_date" name="publish_date" required>  
                          </div>
                          <div style="border-top: 0.5px solid #D3D3D3;">
                            <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
                            <button type="button" class="btn cancel" onclick="closeEditForm()"><i class="fa-solid fa-xmark"></i>Close</button>
                          </div>
                        </form>
                      </div>

                      <a href="../backend/delete_book.php?id=<?php echo $row['id']?>" onclick="return confirm('Do you want to delete the book ?');">
                        <button class="delete"><i class="fa-regular fa-trash-can" style="margin-right: 1px;"></i>Delete</button>
                      </a>
                    </td>
                  </tr>
          <?php
                }
              } 
              else {
                echo "0 results";
              }
              $conn->close();
          ?>
          </tr>
        </table>
        <div class="pagination">
        <p>Showing <?php echo $r + 1; ?> to <?php echo $r + $i; ?> out of <?php echo $result->num_rows ?></p>
        <ul>
            <?php if ($page > 1) { ?>
              <li>
                    <a href="books.php?page=<?php echo $page - 1 ?>">
                      <span>Previous</span>
                    </a>
              </li>
            <?php } ?>
            <li class="page-number"><Span><?php echo $page ?></Span></li>
            <?php if ($page < $total_page) { ?>
            <li>
                <a href="books.php?page=<?php echo $page + 1 ?>">
                  <span>Next</span>
                </a>
            </li>
            <?php } ?>
        </ul>
        </div>
      </div>
    </div>
              
</section>

                      

  <script>
    document.getElementById('pannel-title').innerHTML = "Books";
    document.getElementById('books').className= 'active';
    document.getElementById('dashboard').className= '';
    document.getElementById('pannel-title').innerHTML = "Books";

    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }

    function openEditForm(bid, cid, btitle, author, publisher, quantity, publish_date, cname) {
      document.getElementById("editForm").style.display = "block";
      
      document.getElementById("id").value = bid;
      document.getElementById("quantity").value = quantity;
      document.getElementById("name").value = btitle;
      document.getElementById("publisher").value = publisher;
      document.getElementById("author").value = author;
      document.getElementById("publish_date").value = publish_date;
      document.getElementById("first").innerHTML = cname;
      document.getElementById("first").value = cid;

      
    }

    function closeEditForm() {
      document.getElementById("editForm").style.display = "none";
    }
  </script>

<script>
  $(document).ready(function(){
   $('#getQuantity').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'isbnDiv.php',
       data:{quantity:getName},
       success:function(response)
       {
            $("#isbn-container").html(response);
       } 
     });
   });
  });
</script>
</body>
</html>