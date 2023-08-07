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
        <form action="../backend/add_student.php"class="form-container"  method="POST" enctype="multipart/form-data" accept="image/png, image/jpeg">
          <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
            <h2>Issue Books <button type="button" onclick="closeForm()">X</button></h2>
          </div>
          <div class="grid-container">
            <label for="firstname" class="grid-item">Firstname</label>
            <input type="text" placeholder="" name="firstname"class="grid-item" required> 

            <label for="lastname" class="grid-item">Lastname</label>
            <input type="text" placeholder="" name="lastname" class="grid-item" required>

            <label for="email" class="grid-item">Email</label>
            <input type="text" placeholder="" name="email" class="grid-item" required>

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
      <div class="search-container" method="POST">
        <form action="students.php?page=1" class="search-bar">
            <label for="search-bar">Search:</label>
            <input type="text" id="search-bar" name="search" placeholder="Search...">
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

              $page = $_GET['page'];
              $i = 0;
              $r = 0;

              if(isset($_POST["search"])) {
                $search = $_POST['search'];
                $sql = "SELECT s.id, s.firstname, s.lastname, s.photo, s.course_id, c.code
                FROM students as s
                INNER JOIN course as c
                ON s.course_id = c.id
                WHERE s.firstname LIKE '$search%'";
                $result = $conn->query($sql);
              }
              else {
                $sql = "SELECT s.id, s.firstname, s.lastname, s.photo, s.course_id, c.code
                FROM students as s
                INNER JOIN course as c
                ON s.course_id = c.id";
                $result = $conn->query($sql);
              }
              $total_page =  floor($result->num_rows / 5) + 1;
                
                if ($result->num_rows > 0) {
                  if ($page > 1) {
                    $r = $r + $page * 10 - 10;
                    mysqli_data_seek($result, $r);
                  }
                  // output data of each row
                  while($i < 10 && $row = $result->fetch_assoc()) {
                    $i = $i + 1;

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
                      <td><img src="../img/<?php echo $row["photo"] ?>" alt="photo of student" style="height: 50px; width: 40px; margin: auto;"></td>
                      <td><?php echo $row["id"] ?></td>
                      <td><?php echo $row["firstname"] ?></td>
                      <td><?php echo $row["lastname"] ?></td>

                      <td>
                        <button class="edit" onclick="openEditForm('<?php echo $row['id'];?>', '<?php echo $row['firstname']; ?>', 
                            '<?php echo $row['lastname']; ?>', '<?php echo $row['course_id']; ?>', '<?php echo $row['code']; ?>', 
                            '<?php echo $row['photo']; ?>')" >
                          <i class="fa-solid fa-pen-to-square" style="margin-right: 1px;"></i>
                          Edit
                        </button>
                        
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

                              <label for="course" class="grid-item" id="course"><b>Course</b></label>
                              <select name="course" class="grid-item" id="course">
                                <option id="first"></option>
                                <?php
                                  if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                  }
                                  else {
                                    $sql1 = "SELECT * 
                                    FROM course";
                                    $result1 = $conn->query($sql1);
                                    if ($result1->num_rows > 0) {
                                      // output data of each row
                                      while($row1 = $result1->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $row1["id"] ?>"><?php echo $row1["code"] ?></option>
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
                              <input type="file" value="<?php echo $photo?>" class="grid-item photo" id="photo" name="photo">  
                            </div>
                            <div style="border-top: 0.5px solid #D3D3D3;">
                              <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
                              <button type="button" class="btn cancel" onclick="closeEditForm()"><i class="fa-solid fa-xmark"></i>Close</button>
                            </div>
                          </form>
                        </div>

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
    document.getElementById('pannel-title').innerHTML = "Students";
  document.getElementById('students').className= 'active';
  document.getElementById('dashboard').className= '';

    function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function openEditForm(id, firstname, lastname, cid, ccode, photo) {
    document.getElementById("editForm").style.display = "block";
   
    document.getElementById("id").value = id;
      document.getElementById("firstname").value = firstname;
      document.getElementById("lastname").value = lastname;
      document.getElementById("first").innerHTML = ccode;
      document.getElementById("first").value = cid;
  }

  function closeEditForm() {
    document.getElementById("editForm").style.display = "none";
  }
  </script>
</body>
</html>