<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';
?>

<section class="home-section">
    <nav>
    <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Students</span>
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
      <form action="../backend/add_student.php"class="form-container"  method="POST" enctype="multipart/form-data" accept="image/png, image/jpeg">
          <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
            <h2>Issue Books <button type="button" onclick="closeForm()">X</button></h2>
          </div>
          <div class="grid-container">
            <label for="firstname" class="grid-item">Firstname</label>
            <input type="text" placeholder="" name="firstname"class="grid-item" required>
            <label for="lastname" class="grid-item">Lastname</label>
            <input type="text" placeholder="" name="lastname" class="grid-item" required>
            <label for="course" class="grid-item">Course</label>
            <select name="course" class="grid-item" id="">
              <option value="-Select-">-Select-</option>
              <?php
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                else {
                  $sql = "SELECT * 
                  FROM course";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
              ?>
                      <option value="<?php echo $row["id"] ?>"><?php echo $row["code"] ?></option>
              <?php
                    }
                  } 
                  else {
                    echo "0 results";
                  }
                }
              ?>
            </select>
            <label for="photo" class="grid-item">Photo</label>
            <input type="file" class="grid-item photo" name="photo">  
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
            <th>Course</th>
            <th>Photo</th>
            <th>Student ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Action</th>
          </tr>
          <tr>
            <?php
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              else {
                $sql = "SELECT s.id, s.firstname, s.lastname, s.photo, s.course_id, c.code
                FROM students as s
                INNER JOIN course as c
                ON s.course_id = c.id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    $ccode = $row["code"];
                    $photo = $row["photo"];
                    $sid = $row["id"];
                    $fname = $row["firstname"];
                    $lname = $row["lastname"];
                    $cid = $row['course_id'];
                    $ccode = $row['code'];
            ?>
                    <tr>
                      <td><?php echo $row["code"] ?></td>
                      <td><img src="../img/<?php echo $row["photo"] ?>" alt="photo of student" style="height: 60px; width: 50px;"></td>
                      <td><?php echo $row["id"] ?></td>
                      <td><?php echo $row["firstname"] ?></td>
                      <td><?php echo $row["lastname"] ?></td>

                      <td>
                        <button class="edit" onclick="openEditForm()" ><i class="fa-solid fa-pen-to-square" style="margin-right: 1px;"></i>Edit</button>
                        
                        <a href="../backend/delete_student.php?id=<?php echo $sid?>" onclick="return confirm('Do you want to delete the book ?');">
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

                        <div id="editForm" class="form-popup">
                          <form action="../backend/edit_student.php"class="form-container"  method="POST" enctype="multipart/form-data" accept="image/png, image/jpeg">
                            <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
                              <h2>Edit Books <button type="button" onclick="closeEditForm()">X</button></h2>
                            </div>
                            <div class="grid-container">
                              <label for="id" class="grid-item"><b>Student ID</b></label>
                              <input type="text" class="grid-item" value="<?php echo $sid;?>" name="id" id="id" required>
                              <label for="firstname" class="grid-item">Firstname</label>
                              <input type="text" placeholder="" value="<?php echo $fname?>" name="firstname"class="grid-item" required>
                              <label for="lastname" class="grid-item">Lastname</label>
                              <input type="text" placeholder="" value="<?php echo $lname?>" name="lastname" class="grid-item" required>
                              <label for="course" class="grid-item">Course</label>
                              <select name="course" class="grid-item" id="">
                                <option value="<?php echo $cid ?>"><?php echo $ccode?></option>
                                <?php
                                  if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                  }
                                  else {
                                    $sql = "SELECT * 
                                    FROM course";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                      // output data of each row
                                      while($row = $result->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row["id"] ?>"><?php echo $row["code"] ?></option>
                                <?php
                                      }
                                    } 
                                    else {
                                      echo "0 results";
                                    }
                                  }
                                ?>
                                </select>
                              <label for="photo" class="grid-item">Photo</label>
                              <input type="file" value="<?php echo $photo?>" class="grid-item photo" name="photo">  
                            </div>
                            <div style="border-top: 0.5px solid #D3D3D3;">
                              <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
                              <button type="button" class="btn cancel" onclick="closeEditForm()"><i class="fa-solid fa-xmark"></i>Close</button>
                            </div>
                          </form>
                        </div>

<script>
  document.getElementById('students').className= 'active';
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