<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library Management System</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">

    <style>
        #showdata {
          width: 100%;
          position: absolute;
          top: 32px;
          z-index: 100;
        }
        .search-list {
            display: flex;
            background-color: white;
            padding: 5px;
            border: 0.5px solid #8f8c8d;
        }
        .search-list .book-img img {
            height: 80px;
            width: 50px;

        }
        .search-list .book-details {
            margin-left: 5px;
        }
        .search-list .book-details p {
            font-size: 14px;
            margin: 0;
            color: black;
        }
  </style>
</head>
<body>
<?php include 'includes/header.php'; ?>
    
    <div class="bg-img">
            <div class="search-container">
                <h2 style="font-size: 3rem;">What are you looking for in the Library?</h2>
                <form action="">
                    <input type="text" placeholder="Search keyword..." style="font-size: 1.8rem;">
                    <button><i class='bx bx-search'></i></button>
                </form>
            </div>
        </div>
    <div class="home-section">
        <div class="home-content">
            <div class="user-container">
                <h2 style="font-size: 2.5rem;">Login As:</h2>
                <div class="user">
                    <a href="login.php" class="librarian">
                            <span style="font-size: 1.8rem;">Librarian</span>
                            <i class="fa-solid fa-school"></i>
                    </a>
                    <a href="login.php" class="teacher">
                        <span style="font-size: 1.8rem;">Teacher</span>
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </a>
                    <a href="login.php" class="student">
                        <span style="font-size: 1.8rem;">Student</span>
                        <i class="fa-solid fa-graduation-cap"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer--third">
            <div class="copy"><span>All content © 2023 Library Management System. All rights reserved.</span></div>
            <div class="privacy">
                <a href="/policy/protection-privacy-policy">Privacy Statement</a>    
            </div>
            <div class="founded">
                <span>Funded by</span>
                <!-- <a href="https://vancouver.ca/"><img alt="City of Vancouver Logo" src="/global/img/logos/covl.svg"></a> -->
            </div>
        </div>
    </footer>
</body>
</html>