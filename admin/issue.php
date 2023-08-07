<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';
?>

    <div class="home-content">
      <div class="table-container">
      <div class="new-container">
        <button onclick="openForm()" class="new">+ Issue</button>
        <div id="myForm" class="form-popup">
          <form action="../backend/add_issue.php" class="form-container" method="POST">
            <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
              <h2>Issue Books <button type="button" onclick="closeForm()">X</button></h2>
            </div>
            <div class="grid-container">
              <label for="sid" class="grid-item">Student ID</label>
              <input type="text" placeholder="" name="sid"class="grid-item" required>
              <label for="isbn" class="grid-item">ISBN</label>
              <input type="text" placeholder="" name="isbn" class="grid-item" required>  
            </div>
            <div style="border-top: 0.5px solid #D3D3D3;">
              <button type="submit" class="btn save"><i class="fa-regular fa-floppy-disk"></i>Save</button>
              <button type="button" class="btn cancel" onclick="closeForm()"><i class="fa-solid fa-xmark"></i>Close</button>
            </div>
          </form>
        </div>
      </div>
        <table>
          <tr>
            <th>Date</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>ISBN</th>
            <th>Title</th>
            <th>Status</th>
          </tr>
          <?php

            $page = $_GET['page'];
            $i = 0;
            $r = 0;

            if(isset($_POST["search"])) {
              $search = $_POST['search'];
              $sql = "SELECT i.date, i.student_id, i.status, s.firstname, s.lastname, ib.isbn, b.title 
              FROM students as s
              INNER JOIN issue as i
              ON i.student_id = s.id 
              INNER JOIN books as b
              ON i.book_id = b.id
              INNER JOIN indi_books as ib
              ON b.id = ib.id
              WHERE title LIKE '$search%'";
              $result = $conn->query($sql);
            }
            else {
              $sql = "SELECT i.date, i.student_id, i.status, s.firstname, s.lastname, ib.isbn, b.title 
              FROM students as s
              INNER JOIN issue as i
              ON i.student_id = s.id 
              INNER JOIN books as b
              ON i.book_id = b.id
              INNER JOIN indi_books as ib
              ON b.id = ib.id";
              $result = $conn->query($sql);
            }
            
            $total_page =  floor($result->num_rows / 5) + 1;

              if ($result->num_rows > 0) {
                // output data of each row
                if ($page > 1) {
                  $r = $r + $page * 10 - 10;
                  mysqli_data_seek($result, $r);
                }
                while($i < 10 && $row = $result->fetch_assoc()) {
                  $i = $i + 1;
          ?>
                  <tr>
                    <td><?php echo $row["date"] ?></td>
                    <td><?php echo $row["student_id"] ?></td>
                    <td><?php echo $row["firstname"] . " " . $row["lastname"]?></td>
                    <td><?php echo $row["isbn"] ?></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php
                      if( $row["status"] = 0) {
                      ?>
                        <Button style="background: red; border: none; border-radius: 5px; color: white; padding: 0 5px;">not returned</Button></td>
                      <?php
                      }
                      else {
                      ?>
                          <Button style="background: green; border: none; border-radius: 5px; color: white; padding: 0 5px;">returned</Button></td>
                      <?php
                      }
                      ?>
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
          <p>Showing <?php echo $r; ?> to <?php echo $r + $i; ?> out of <?php echo $result->num_rows ?></p>
          <ul>
            <?php if ($page > 1) { ?>
              <li>
                    <a href="issue.php?page=<?php echo $page - 1 ?>">
                      <span>Previous</span>
                    </a>
              </li>
              <li class="page-number"><Span><?php echo $page ?></Span></li>
            <?php } ?>
            
            <?php if ($page < $total_page) { ?>
            <li>
                <a href="issue.php?page=<?php echo $page + 1 ?>">
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
    document.getElementById('pannel-title').innerHTML = "Issue";
  document.getElementById('issue').className= 'active';
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