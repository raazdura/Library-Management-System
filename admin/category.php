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
            <form action="../backend/add_category.php" class="form-container" method="POST">
              <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
                <h2>Issue Books <button type="button" onclick="closeForm()">X</button></h2>
              </div>
              <div class="grid-container">
                <label for="name" class="grid-item">Name</label>
                <input type="text" placeholder="" name="name"class="grid-item" required>
              </div>
              <div style="border-top: 0.5px solid #D3D3D3;">
                <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
                <button type="button" class="btn cancel" onclick="closeForm()"><i class="fa-solid fa-xmark"></i>Close</button>
              </div>
            </form>
          </div>
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
            <th style="width: 50%;">Category</th>
            <th>Tools</th>
          </tr>
          <?php
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            else {
              $sql = "SELECT * FROM category";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
          ?>
                  <tr>
                    <td><?php echo $row["name"] ?></td>
                    <td>
                      <button class="edit" onclick="openEditForm('<?php echo $row['id'];?>', '<?php echo $row['name'];?>')" >
                        <i class="fa-solid fa-pen-to-square" style="margin-right: 1px;"></i>
                        Edit
                      </button>

                      <div id="editForm" class="form-popup">
                        <form action="../backend/edit_category.php" class="form-container" method="POST">
                          <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
                            <h2>Issue Books <button type="button" onclick="closeEditForm()">X</button></h2>
                          </div>
                          <div class="grid-container">

                            <label for="id" class="grid-item" style="display: none;">Category Id</label>
                            <input type="text" placeholder="" name="id" id="id" class="grid-item" style="display: none;" required>

                            <label for="name" class="grid-item">Name</label>
                            <input type="text" placeholder="" name="name" id="name" class="grid-item" required>
                          </div>
                          <div style="border-top: 0.5px solid #D3D3D3;">
                            <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
                            <button type="button" class="btn cancel" onclick="closeEditForm()"><i class="fa-solid fa-xmark"></i>Close</button>
                          </div>
                        </form>
                      </div>
                      <a href="../backend/delete_category.php?id=<?php echo $row['id']?>" onclick="return confirm('Do you want to delete the book ?');">
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
    document.getElementById('pannel-title').innerHTML = "Category";
  document.getElementById('category').className= 'active';
  document.getElementById('dashboard').className= '';

  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

  function openEditForm(id, name) {
    document.getElementById("editForm").style.display = "block";
      
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    }

    function closeEditForm() {
      document.getElementById("editForm").style.display = "none";
    }
  </script>
</body>
</html>