<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library | Login</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            display: grid;
            place-items: center;
            height: 100vh;
        }

        header {
            background-color: #f5f5f5;
            width: 100vw;
            position: fixed;
            top: 0;
        }
        .navbar{
        margin: auto;
        max-width: 80vw;
        display: flex;
        justify-content: space-between;
        color: white;

        }
        .navbar .logo-details{
        height: 80px;
        display: flex;
        align-items: center;
        width: 200px;
        font-weight: 600;
        }
        .navbar .logo-details a {
        display: flex;
        align-items: center;
        text-decoration: none;
        }
        .navbar .logo-details a i{
        font-size: 2rem;
        color: #5C1C97;
        min-width: 60px;
        text-align: center;
        }
        .navbar .logo-details a .logo_name{
        color: #5C1C97;
        font-size: 24px;
        }
        .navbar .nav-links{
        margin-top: 10px;
        display: flex;
        align-items: center;
        }
        .navbar .nav-links li {
            list-style: none;
            margin: 0 5px;
        }
        .navbar .nav-links li a {
            text-decoration: none;
            color: #5C1C97;
            font-weight: 600;
            /* transition: border-bottom .2s; */
        }
        .navbar .nav-links li a:hover, .navbar .nav-links li a:active{
            border-bottom: 2px solid #5C1C97;
        }
        .navbar .nav-links li button {
            background-color: #5C1C97;
            font-weight: 500;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
        }

        
        .login-page {
            display: grid;
            grid-template-columns: 40% 60%;
            height: 70vh;
            width: 60vw;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .img-container {
            background-image: url("img/pexels.jpg");
            background-size: cover;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .form-container {
            display: grid;
            place-items: center;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: #f5f5f5;
        }

        form {
            width: 75%;
            text-align: center;
            padding: 10px 5px;
        }
        h1 {
            color: #5C1C97;
            margin-bottom: 20px;
        }

        .input-container {
        width: 100%;
        position: relative;
        padding: 10px;
        }
        .select {
        width: 60%;
        margin: auto;
        }
        select {
        padding: 0.5rem;
        width: 100%;
        height: 100%;
        border: 2px solid #A9A9A9;
        border-radius: 5px;
        font-size: 18px;
        outline: none;
        transition: all 0.3s;
        color: black;
        }
        .select-label {
            position: absolute;
            left: 22px;
            top: 0px;
            transition: all 0.2s;
            padding: 0 2px;
            z-index: 1;
            color: #7e4ccb;
            font-size: 14px;
        }
        .select-label::before {
            content: "";
            height: 5px;
            position: absolute;
            background: white;
            left: 0px;
            top: 10px;
            width: 100%;
            z-index: -1;
        }

        .label {
        position: absolute;
        left: 24px;
        top: 26px;
        transition: all 0.2s;
        padding: 0 2px;
        z-index: 1;
        color: #b3b3b3;
        }
        .text-input {
        padding: 0.8rem;
        width: 100%;
        height: 100%;
        border: 2px solid #A9A9A9;
        border-radius: 5px;
        font-size: 18px;
        outline: none;
        transition: all 0.3s;
        color: black;
        }

        .label::before {
        content: "";
        height: 5px;
        position: absolute;
        background: white;
        left: 0px;
        top: 10px;
        width: 100%;
        z-index: -1;
        }

        .text-input:focus {
        border: 2px solid #7e4ccb;
        }

        .text-input:focus + .label,
        .filled {
        top: -1px;
        color: #7e4ccb;
        font-size: 14px;
        }

        .text-input::placeholder {
        font-size: 16px;
        opacity: 0;
        transition: all 0.3s;
        }
        .text-input:focus::placeholder {
        opacity: 1;
        }
        .btn {
            background: #7e4ccb;
            font-size: 20px;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }
        .btn:hover {
            background: #5C1C97;
        }
    </style>

    <title>Library Management System - User Login</title>
  </head>
  <body>
    <header>
        <div class="navbar">
            <div class="logo-details">
            <a href="index.php">
                <i class='bx bx-book'></i>
                <span class="logo_name" style="text-decoration: none;">Library</span>
            </a>
            </div>
        </div>
    </header>
    <div class="login-page">
        <div class="img-container">

        </div>
        <div class="form-container">
            <form action="backend/user_login.php" method="POST">
                <h1>LOGIN</h1>
                <div class="input-container  select">
                    <select name="user" id="user">
                        <option value="1">Librarian</option>
                        <option value="2">Teacher</option>
                        <option value="3">Student</option>
                    </select>
                    <label class="select-label" for="user">Select</label>
                </div>
                <div class="input-container">
                    <input type="email" id="email" name="email" class="text-input" autocomplete="off" placeholder="Enter your email" required />
                    <label class="label" for="email">Email</label>
                    </div>
                    <div class="input-container">
                    <input  type="password" id="password" name="password" class="text-input" autocomplete="off" placeholder="Enter your password" required />
                    <label for="password" class="label">Passwod</label>
                </div>
                <div class="input-container">
                    <input type="submit" value="Login" class="btn"/>
                </div>
                <a href="">Forgot Password?</a>
            </form>
        </div>
    </div>
    
    <script>
        document.querySelectorAll(".text-input").forEach((element) => {
  element.addEventListener("blur", (event) => {
    if (event.target.value != "") {
      event.target.nextElementSibling.classList.add("filled");
    } else {
      event.target.nextElementSibling.classList.remove("filled");
    }
  });
});
    </script>
  </body>
</html>