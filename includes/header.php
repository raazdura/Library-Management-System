
<header>
        <div class="navbar">
            <div class="logo-details">
                <a href="index.php">
                    <i class='bx bx-book'></i>
                    <span class="logo_name" style="text-decoration: none;">Library</span>
                </a>
                <div class="sidebar-button">
                    <i class='bx bx-menu sidebarBtn'></i>
                </div>
            </div>
            <div class="search-container">
                <form action="">
                <input type="text" id="getName" placeholder="Search books..."/>
                    <button><i class='bx bx-search'></i></button>
                </form>
                <div id="showdata" style="border: 0.5px silid #8f8c8d; top: 32px;">
                    <!-- search list comes here from ajax -->
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" id="home" style="font-size: 1.6rem;">Home</a></li>
                <li><a href="home.php" id="books" class="active" style="font-size: 1.6rem;">Books</a></li>
                <li><a href="about.php" id="about" style="font-size: 1.6rem;">About</a></li>
                <?php
                if ( !isset($_SESSION['userloggedin']) ) {
                ?>
                    <li><a href="login.php"><button style="display: block;">Login</button></a></li>
                <?php
                }
                else {
                ?>
                    <a href="requestbooks.php">
                        <i class='bx bxs-cart-alt' style="margin: 10px; font-size: 3rem; color: #5C1C97; position: relative;">
                            <?php
                            if(isset($_SESSION["cart_item"])) {
                            ?>
                            <span style="
                                position: absolute;
                                top: -9px;
                                font-size: 16px;
                                background: red;
                                color: white;
                                border-radius: 50%;
                                width: 15px;
                                height: 15px;
                                text-align: center;
                                right: 6px;
                            "><?php echo count($_SESSION["cart_item"]); ?></span>
                            <?php
                            }
                            ?>
                        </i>
                    </a>
                    <img src="img/<?php echo $user_photo ?>" alt="" onclick="showDropdown();" style="cursor: pointer;">
                    <i class='bx bx-chevron-up' onclick="showDropdown();" id="angle-up" style="display: none;"></i>
                <?php
                }
                ?>
                
            </ul>
            <div class="drop-down" id="drop-down">
                <div class="menu-container">
                    <div class="profile">
                        <img src="img/<?php echo $user_photo ?>" alt="">
                        <div>
                        <p style="font-weight: 600; font-size: 1.6rem;"><?php echo $row1['username'];?> <br></p>
                        <p style="font-size: 12px;"><?php echo $user_email?> <br></p>
                        <p style="font-size: 12px;">ID:<?php echo " " . $user_id;?> </p>
                        </div>
                    </div>
                    <ul>
                        <li><a href="mybooks.php" style="text-decoration: none; color: black;"><i class="fa-solid fa-user"></i>My Books</a></li>
                        <li><a href="changepassword.php" style="text-decoration: none; color: black;"><i class="fa-solid fa-key"></i>Change Password</a></li>
                        <li><a href="logout.php" style="text-decoration: none; color: black;"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <script>
        $(document).ready(function(){
            $('#getName').on("keyup", function(){
                var getName = $(this).val();
                $.ajax({
                    method:'POST',
                    url:'backend/search.php',
                    data:{name:getName},
                    success:function(response)
                    {
                            $("#showdata").html(response);
                    } 
                });
            });
        });
    </script>