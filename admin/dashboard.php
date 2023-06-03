<?php
    include '../includes/session.php';
    include 'includes/header.php';
?>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
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
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Books</div>
            <div class="number">40,876</div>
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
            <div class="number">38,876</div>
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
            <div class="number">12,876</div>
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
            <div class="number">11,086</div>
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
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>