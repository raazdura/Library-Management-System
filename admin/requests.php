<?php
    session_start();
    include '../includes/config.php';
    include 'includes/header.php';
?>


    <div class="home-content">
      <div class="table-container">
      
      <div class="search-container" style="border: none;">
        <form action="books.php?page=1" class="search-bar" method="POST">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Search...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
        <table>
          <tr>
            <th>Request ID</th>
            <th>Username</th>
            <th>User ID</th>
            <th>Books</th>
            <th>Action</th>
          </tr>
          <?php

            $page = $_GET['page'];
            $i = 0;
            $r = 0;
            
            if(isset($_POST["search"])) {
              $search = $_POST['search'];
              $sql = "SELECT r.rq_id, r.u_id, r.status, u.username
              FROM requests as r
              INNER JOIN user as u
              ON r.u_id = c.id
              WHERE u.username LIKE '$search%'";
              $result = $conn->query($sql);
            }
            else {
                $sql = "SELECT r.rq_id, r.u_id, r.status, u.username
                FROM requests as r
                INNER JOIN user as u
                ON r.u_id = u.uid";
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
                    <td><?php echo $row["rq_id"] ?></td>
                    <td><?php echo $row["username"] ?></td>
                    <td><?php echo $row["u_id"] ?></td>
                    <td>
                        <?php 
                            $sql1 = "SELECT rq.quantity, b.title
                                    FROM request{$row["rq_id"]} as rq
                                    INNER JOIN books as b
                                    ON rq.b_id = b.id";
                            $result1 = $conn->query($sql1);
                            while($row1 = $result1->fetch_assoc()) {
                                echo "1. " . $row1["title"] . " |  Qnty: " . $row1["quantity"];
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                             if( $row["status"] == 0) {
                        ?>
                        <a href="../backend/response.php?id=<?php echo $row['rq_id']?>&response=approve" onclick="return confirm('Do you want to approve this request?');">
                            <button style="background-color: green; color: white; border: none; padding: 5px;">Approve</button>
                        </a>
                        <a href="../backend/response.php?id=<?php echo $row['rq_id']?>&response=disapprove" onclick="return confirm('Do you want to disapprove this request?');">
                            <button style="background-color: red; color: white; border: none; padding: 5px;">Disapprove</button>
                        </a>
                        <?php
                            }
                            else if( $row["status"] == 1 ) {
                        ?>
                        <button style="background-color: blueviolet; color: white; border: none; padding: 5px;" onclick="openForm()" class="new">Issue</button>
                        <div id="myForm" class="form-popup">
                          <form action="../backend/add_issue.php" class="form-container" method="POST">
                            <div style="border-bottom: 0.5px solid #D3D3D3; margin-bottom: 10px; padding: 10px;">
                              <h2>Issue Books <button type="button" onclick="closeForm()">X</button></h2>
                            </div>
                            <div class="grid-container">
                              <label for="sid" class="grid-item">Student ID</label>
                              <input type="text" placeholder="" name="sid"class="grid-item" value="<?php echo $row["u_id"] ?>" required>
                              
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
                        <?php 
                            }
                            else if( $row["status"] == 2 ) {
                        ?>
                        <button style="background-color: red; color: white; border: none; padding: 5px;">Disapproved</button>   
                        <?php 
                            }
                            else if( $row["status"] == 3 ) {
                        ?>
                        <button style="background-color: yellow; color: white; border: none; padding: 5px;">Issued</button>   
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
    document.getElementById('requests').className= 'active';
    document.getElementById('dashboard').className= '';
    document.getElementById('pannel-title').innerHTML = "Requests";

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