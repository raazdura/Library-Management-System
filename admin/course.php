<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';

?>

<section class="home-section">
    <nav>
    <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Course</span>
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
        <form action="../backend/add_course.php" class="form-container" method="POST">
          <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
            <h2>Add Course <button type="button" onclick="closeForm()">X</button></h2>
          </div>
          <div class="grid-container">
            <label for="code" class="grid-item">Code</label>
            <input type="text" placeholder="" name="code"class="grid-item" required>

            <label for="title" class="grid-item">Title</label>
            <input type="text" placeholder="" name="title"class="grid-item" required>
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
            <th>Code</th>
            <th>Title</th>
            <th>Tools</th>
          </tr>
            <?php
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                else {
                    $sql = "SELECT code, title FROM course";
                    $result = $conn->query($sql);
                  
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
            ?>
                            <tr>
                                <td><?php echo $row["code"] ?></td>
                                <td><?php echo $row["title"] ?></td>
                                <td>
                                <button class="edit"><i class="fa-solid fa-pen-to-square" style="margin-right: 1px;"></i>Edit</button>
                                <button class="delete"><i class="fa-regular fa-trash-can" style="margin-right: 1px;"></i>Delete</button>
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
  document.getElementById('course').className= 'active';
  document.getElementById('dashboard').className= '';

  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  </script>
</body>
</html>