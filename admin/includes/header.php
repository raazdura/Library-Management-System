<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Library | Admin Dashboard </title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/issue.css">
    <link rel="stylesheet" href="css/students.css">


   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-book'></i>
      <span class="logo_name">Library</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" id="dashboard" class="active">
            <i class="fa-solid fa-gauge"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="books.php?page=1" id="books">
            <i class='bx bxs-book-alt'></i>
            <span class="links_name" id="span">Books</span>
          </a>
        </li>
        <li>
          <a href="issue.php" id="issue">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Issue</span>
          </a>
        </li>
        <li>
          <a href="returns.php" id="returns">
            <i class="fa-solid fa-rotate-left"></i>
            <span class="links_name">Returns</span>
          </a>
        </li>
        <li>
          <a href="students.php" id="students">
            <i class='bx bxs-group'></i>
            <span class="links_name">Students</span>
          </a>
        </li>
        <li>
          <a href="Category.php" id="category">
            <i class='bx bx-category'></i>
            <span class="links_name">Category</span>
          </a>
        </li>
        <li>
          <a href="course.php" id="course">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="links_name">Course</span>
          </a>
        </li>
        
        <!-- <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li> -->
        <li class="log_out">
          <a href="../logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>

  <section class="home-section">

    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard" id="pannel-title">Dashboard</span>
      </div>
      <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
      <div class="profile-details"  onclick="showDropdown();">
        <img src="../img/raaz_dura.jpg" alt="">
        <span class="admin_name">Raaz Dura</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
      <div class="drop-down" id="drop-down">
        <div class="menu-container" 
          style="margin: 10px;">
          <div class="profile">
            <img src="../img/raaz_dura.jpg" alt="" >
            <p>Raaz Dura</p>
          </div>
          <ul>
              <li><i class="fa-solid fa-user"></i>Edit Profile</li>
              <li><i class="fa-solid fa-gear"></i>Setting and Privacy</li>
              <li><i class="fa-solid fa-right-from-bracket"></i>Logout</li>
          </ul>
        </div>
      </div>
    </nav>