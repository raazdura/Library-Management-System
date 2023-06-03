<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';
?>

<section class="home-section">
    <nav>
    <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Books</span>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <i class='bx bx-search' ></i>
        </div>
        <div class="profile-details">
            <img src="../img/raaz_dura.jpg" alt="">
            <span class="admin_name">Raaz Dura</span>
            <i class='bx bx-chevron-down' ></i>
        </div>
    </nav>
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
            <label for="isbn" class="grid-item"><b>ISBN</b></label>
            <input type="text" class="grid-item" placeholder="Enter your isbn" name="isbn" required>

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
          </select>
      </form>
      </div>
      <div class="search-container">
        <form action="" class="search-bar">
            <label for="search-bar">Search:</label>
            <input type="text" id="search-bar" placeholder="Search...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
        <table>
          <tr>
            <th>ID</th>
            <th>Category</th>
            <th>ISBN</th>
            <th>Title</th>
            <th>Auther</th>
            <th>Publisher</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          <?php
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            else {
              $sql = "SELECT b.id, b.title, b.author, b.publisher, b.isbn, b.status, b.publish_date, c.name, b.category_id
              FROM books as b
              INNER JOIN category as c
              ON b.category_id = c.id";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $isbn = $row["isbn"];
                  $cname = $row["name"];
                  $title = $row["title"];
                  $author = $row["author"];
                  $publisher = $row["publisher"];
                  $publish_date  = $row['publish_date'];
                  $cid = $row['category_id'];
          ?>
                  <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["isbn"] ?></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["author"] ?></td>
                    <td><?php echo $row["publisher"] ?></td>
                    <td><?php
                      if( $row["status"] = 0) {
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
                      <button class="edit" onclick="openEditForm()" ><i class="fa-solid fa-pen-to-square" style="margin-right: 1px;"></i>Edit</button>
                      <div id="editForm" class="form-popup">
                        <form action="../backend/edit_book.php" class="form-container" method="POST">
                          <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
                            <h2>Edit Book <button type="button" onclick="closeEditForm()">X</button></h2>
                          </div>
                          <div class="grid-container">
                          <label for="id" class="grid-item"><b>Book ID</b></label>
                          <input type="text" class="grid-item" value="<?php echo $row['id'];?>" name="id" id="id" required>

                          <label for="isbn" class="grid-item"><b>ISBN</b></label>
                          <input type="text" class="grid-item" value="<?php echo $row['isbn'];?>" name="isbn" id="isbn" required>

                          <label for="title" class="grid-item"><b>Title</b></label>
                          <input type="text" class="grid-item" value="<?php echo $row["title"] ?>" name="title" required>

                          <label for="category" class="grid-item"><b>Category</b></label>
                          <select name="category" class="grid-item" id="category">
                            <option value="<?php echo $cid ?>"><?php echo $cname ?></option>
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
                          <input type="text" class="grid-item" value="<?php echo $author ?>" name="author" required>

                          <label for="publisher" class="grid-item"><b>Publisher</b></label>
                          <input type="text" class="grid-item" value="<?php echo $publisher ?>" name="publisher" required>

                          <label for="publish_date" class="grid-item"><b>Publish Date</b></label>
                          <input type="text" class="grid-item" value="<?php echo $publish_date ?>" name="publish_date" required>  
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
            }
          ?>
          </tr>
        </table>
        <div class="pagination">
        <p>Showing 1 to 5 out of 5</p>
        <ul>
            <li><span>Previous</span></li>
            <li><Span>1</Span></li>
            <li><span>Next</span></li>
        </ul>
        </div>
      </div>
    </div>

    
</section>

                      

<script>
  document.getElementById('books').className= 'active';
  document.getElementById('dashboard').className= '';

  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  function openEditForm() {
    document.getElementById("editForm").style.display = "block";
  }

  function closeEditForm() {
    document.getElementById("editForm").style.display = "none";
  }
  </script>
</body>
</html>