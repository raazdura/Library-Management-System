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
              <a href="books.php?page=1" style="text-decoration: none;">
                <span class="text">See more</span>
                <i class="fa-solid fa-arrow-right" style="height: 20px;
  width: 20px;
  background: #fff;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  color: #000;
  font-size: 15px;
  margin-right: 5px;"></i>
                </a>
            </div>
          </div>
          <i class="fa-solid fa-book"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Issues</div>
            <div class="number"><?php echo $result3->num_rows ?></div>
            <div class="indicator">
            <a href="issue.php?page=1" style="text-decoration: none;">
                <span class="text">See more</span>
                <i class="fa-solid fa-arrow-right" style="height: 20px;
  width: 20px;
  background: #fff;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  color: #000;
  font-size: 15px;
  margin-right: 5px;"></i>
                </a>
            </div>
          </div>
          <i class="fa-solid fa-cart-plus"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Returns</div>
            <div class="number"><?php echo $result5->num_rows ?></div>
            <div class="indicator">
            <a href="returns.php?page=1" style="text-decoration: none;">
                <span class="text">See more</span>
                <i class="fa-solid fa-arrow-right" style="height: 20px;
  width: 20px;
  background: #fff;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  color: #000;
  font-size: 15px;
  margin-right: 5px;"></i>
                </a>
            </div>
          </div>
          <i class="fa-solid fa-rotate-left"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Students</div>
            <div class="number"><?php echo $result4->num_rows ?></div>
            <div class="indicator">
            <a href="students.php?page=1" style="text-decoration: none;">
                <span class="text">See more</span>
                <i class="fa-solid fa-arrow-right" style="height: 20px;
  width: 20px;
  background: #fff;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  color: #000;
  font-size: 15px;
  margin-right: 5px;"></i>
                </a>
            </div>
          </div>
          <i class="fa-solid fa-people-group"></i>
        </div>
      </div>
    </div>
  </section>

  

<script>
  let dropDown = document.getElementById("drop-down");

  function showDropdown() {
      dropDown.classList.toggle("open-dropdown");
  }
</script>

</body>
</html>