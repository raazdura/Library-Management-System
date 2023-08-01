<?php
    include '../includes/session.php';
    include 'includes/header.php';
    include '../includes/config.php';

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else {
      $sql2 = "SELECT id FROM books";
      $result2 = $conn->query($sql2);
      $row2 = $result2->fetch_assoc();
      $sql3 = "SELECT id FROM issue";
      $result3 = $conn->query($sql3);
      $row3 = $result3->fetch_assoc();
      $sql4 = "SELECT id FROM students";
      $result4 = $conn->query($sql4);
      $row4 = $result4->fetch_assoc();
      $sql5 = "SELECT id FROM returns";
      $result5 = $conn->query($sql5);
      $row5 = $result5->fetch_assoc();
    }

?>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Books</div>
            <div class="number"><?php echo $result2->num_rows ?></div>
            <div class="indicator">
              <i class="fa-solid fa-arrow-right"></i>
              <span class="text">See more</span>
            </div>
          </div>
          <i class="fa-solid fa-book"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Issues</div>
            <div class="number"><?php echo $result3->num_rows ?></div>
            <div class="indicator">
              <i class="fa-solid fa-arrow-right"></i>
              <span class="text">See more</span>
            </div>
          </div>
          <i class="fa-solid fa-cart-plus"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Returns</div>
            <div class="number"><?php echo $result5->num_rows ?></div>
            <div class="indicator">
              <i class="fa-solid fa-arrow-right"></i>
              <span class="text">See more</span>
            </div>
          </div>
          <i class="fa-solid fa-rotate-left"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Students</div>
            <div class="number"><?php echo $result4->num_rows ?></div>
            <div class="indicator">
              <i class="fa-solid fa-arrow-right"></i>
              <span class="text">See more</span>
            </div>
          </div>
          <i class="fa-solid fa-people-group"></i>
        </div>
      </div>
    </div>
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if(sidebar.classList.contains("active")){
      sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
      }
      else {
      sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }
 </script>

<script>
  let dropDown = document.getElementById("drop-down");

  function showDropdown() {
      dropDown.classList.toggle("open-dropdown");
  }
</script>

</body>
</html>