<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';
?>

    <div class="home-content">
      <div class="table-container">
      <div class="new-container">
      <button onclick="openForm()" class="new">+ Return</button>
      <div id="myForm" class="form-popup">
      <form action="../backend/add_return.php" class="form-container" method="POST">
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
      <div class="search-container">
        <form action="" class="search-bar">
            <label for="search-bar">Search:</label>
            <input type="text" id="search-bar" placeholder="Search...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
        <table>
          <tr>
            <th>Date</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>ISBN</th>
            <th>Title</th>
          </tr>
          <?php
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            else {
              $sql = "SELECT r.date_return, r.student_id, s.firstname, s.lastname, ib.isbn, b.title 
              FROM students as s
              INNER JOIN returns as r
              ON r.student_id = s.id 
              INNER JOIN books as b
              ON r.book_id = b.id
              INNER JOIN indi_books as ib
              ON b.id = ib.id";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
          ?>
                  <tr>
                    <td><?php echo $row["date_return"] ?></td>
                    <td><?php echo $row["student_id"] ?></td>
                    <td><?php echo $row["firstname"] . " " . $row["lastname"]?></td>
                    <td><?php echo $row["isbn"] ?></td>
                    <td><?php echo $row["title"] ?></td>
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
    document.getElementById('pannel-title').innerHTML = "Returns";
  document.getElementById('returns').className= 'active';
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