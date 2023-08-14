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

            <label for="quantity" class="grid-item"><b>Quantity</b></label>
            <input type="text" class="grid-item" id="getQuantity" placeholder="Enter quantity" name="quantity" required>
              
              
            </div>
            <div id="isbn-container" class="grid-container">  
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

            $page = $_GET['page'];
            $i = 0;
            $r = 0;

            if(isset($_POST["search"])) {
              $search = $_POST['search'];
              $sql = "SELECT r.date_return, r.student_id, s.firstname, s.lastname, ib.isbn, b.title 
              FROM students as s
              INNER JOIN returns as r
              ON r.student_id = s.id 
              INNER JOIN books as b
              ON r.book_id = b.id
              INNER JOIN indi_books as ib
              ON b.id = ib.id
              WHERE title LIKE '$search%'";
              $result = $conn->query($sql);
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
            
          ?>
          </tr>
        </table>
        <div class="pagination">
          <p>Showing <?php echo $r; ?> to <?php echo $r + $i; ?> out of <?php echo $result->num_rows ?></p>
          <ul>
            <?php if ($page > 1) { ?>
              <li>
                    <a href="returns.php?page==<?php echo $page - 1 ?>">
                      <span>Previous</span>
                    </a>
              </li>
              <li class="page-number"><Span><?php echo $page ?></Span></li>
            <?php } ?>
            
            <?php if ($page < $total_page) { ?>
            <li>
                <a href="returns.php?page==<?php echo $page + 1 ?>">
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