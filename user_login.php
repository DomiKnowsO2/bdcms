<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>USER LOGIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
</head>

<body>

    <header class="header fixed-top">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <a href="login.php" class="logo">BDC<span>MS</span></a>

                <nav class="nav">
                    <a href="#home">home</a>
                    <a href="#about">about</a>
                    <a href="#services">services</a>
                    <a href="#reviews">reviews</a>
                    <a href="#contact">contact</a>
                    <a href="./admin/login.php">admin</a>
                </nav>
                <nav>
                    <a href="#contact" class="link-btn">make appointment</a>
                    <a href="user_login.php" class="link-btn">login</a>
                </nav>
                <div id="menu-btn" class="fas fa-bars"></div>

            </div>

        </div>

    </header>


    <div class="form_container">
        <div class="container2">
            <div class="form signup">
                <h1>SIGN UP</h1>
                <form class="signup-form" action="" method="post" id="signup">
                    <i class="fas fa-user-plus"></i>
                    <input class="user-input" type="text" name="" placeholder="Username" required>
                    <input class="user-input" type="email" name="" placeholder="Email Address" required>
                    <input class="user-input" type="password" name="" placeholder="Password" required>
                    <input class="btn" type="submit" name="" value="SIGN UP">
                    <div class="options-02 login">
                        <p>Already Registered? <a href="#">Sign In</a></p><br>
                    </div>
                </form>
            </div>
        </div>
        <div class="container1">
            <div class="form login">
                <h1>USER LOGIN</h1>
                <form class="login-form" action="inc/checkpassword.php" method="post">
                    <i class="fas fa-user-circle"></i>
                    <input class="user-input" type="text" name="uname" placeholder="Username" required>
                    <input class="user-input" type="password" name="password" placeholder="Password" required>
                    <div class="options-01">
                        <label class="remember-me"><input type="checkbox" name="">Remember me</label>
                    </div>

                    <input class="btn" type="submit" value="LOGIN"><br>
                    <div class="options-02 signup">
                        <p>Not Registered? <a href="#">Create an Account</a></p><br>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the container elements
            var container1 = document.querySelector(".container1");
            var container2 = document.querySelector(".container2");

            // Get the options elements
            var signInOption = document.querySelector(".options-02.login a");
            var createAccountOption = document.querySelector(".options-02.signup a");

            // Add event listeners
            signInOption.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent the default link behavior
                container1.style.display = "block";
                container2.style.display = "none";
            });

            createAccountOption.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent the default link behavior
                container1.style.display = "none";
                container2.style.display = "block";
            });
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(29, 90, 84, 0.762);
            background-image: url(./images/clinic3.jpg);
            background-position: top;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .header {
            padding: 2rem;
            border-bottom: var(--border);
        }

        .header.active {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            border: 0;
        }

        .header .logo {
            font-size: 2rem;
            color: var(--black);
        }

        .header .logo span {
            color: var(--blue);
        }

        .header .nav a {
            margin: 0 1rem;
            font-size: 1.7rem;
            color: var(--black);
        }

        .header .nav a:hover {
            color: var(--blue);
        }

        .services {
            background-color: var(--light-bg);
        }

        .services .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
            gap: 2rem;
        }

        .services .box-container .box {
            text-align: center;
            padding: 2rem;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            border-radius: .5rem;
        }

        .services .box-container .box img {
            margin: 1rem 0;
            height: 4rem;
        }

        .services .box-container .box h3 {
            font-size: 2rem;
            padding: 1rem 0;
            color: var(--black);
        }

        .services .box-container .box p {
            font-size: 1.5rem;
            color: var(--light-color);
            line-height: 2;
        }

        .process .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
            gap: 2rem;
        }

        .process .box-container .box {
            background-color: var(--blue);
            padding: 2rem;
            border-radius: .5rem;
            text-align: center;
            box-shadow: var(--box-shadow);
        }

        .process .box-container .box img {
            height: 20rem;
            margin: 1rem 0;
        }

        .process .box-container .box h3 {
            font-size: 2rem;
            color: var(--white);
            margin: 1.5rem 0;
        }

        .process .box-container .box p {
            font-size: 1.5rem;
            color: var(--white);
            line-height: 2;
        }

        .reviews {
            background-color: var(--light-bg);
        }

        .reviews .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
            gap: 2rem;
        }

        .reviews .box-container .box {
            background-color: var(--white);
            text-align: center;
            border-radius: .5rem;
            box-shadow: var(--box-shadow);
            padding: 2rem;
        }

        .reviews .box-container .box img {
            height: 10rem;
            width: 10rem;
            border-radius: 50%;
        }

        .reviews .box-container .box p {
            padding: 2rem 0;
            line-height: 2;
            font-size: 1.5rem;
            color: var(--light-color);
            margin-bottom: 0;
        }

        .reviews .box-container .box .stars {
            padding: .5rem 1.5rem;
            border-radius: .5rem;
            background-color: var(--light-bg);
            margin-bottom: 2rem;
            display: inline-block;
        }

        .reviews .box-container .box .stars i {
            font-size: 1.5rem;
            color: var(--blue);
        }

        .reviews .box-container .box h3 {
            font-size: 2rem;
            color: var(--black);
        }

        .reviews .box-container .box span {
            color: var(--light-color);
            font-size: 1.5rem;
        }

        .form_container {
            width: 25%;
            height: auto !important;
            /* background-color: white; */
            background-image: url(./images/Image.png);
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;

        }

        h1 {
            text-align: center;
            font-weight: 400;
            color: white;
            font-family: 'Courier New', Courier, monospace;
            font-size: 45px;
            padding-top: 10px;
        }

        .form {
            border: 1px solid white;
            text-align: center;
            font-family: "Poppins", sans-serif;
            background-color: #08A671;
            opacity: 0.9;
        }

        .form i {
            z-index: 0;
            color: white;
            font-size: 65px;
            margin-bottom: 40px;
            padding: 50px;

        }

        .container2 {
            display: none;
            font-family: 'Courier New', Courier, monospace;
            color: black;
        }

        .form .user-input {
            width: 80%;
            height: 55px;
            margin-bottom: 20px;
            outline: none;
            border: none;
            background: white;
            color: #000;
            font-size: 14px;
            text-align: center;
            border-radius: 5px;
            transition: 0.5s;
            transition-property: border-left, border-right, box-shadow;
            opacity: 0.8;
        }

        .form .user-input:hover,
        .form .user-input:focus,
        .form .user-input:active {
            border-left: solid 8px #f442e5;
            border-right: solid 8px #d942f4;
            box-shadow: 0 0 100px rgba(152, 244, 66, 0.993);
        }

        .form .options-01 {
            margin-bottom: 50px;
        }

        .form .options-01 input {
            width: 15px;
            height: 15px;
            margin-right: 5px;
        }

        .form .options-01 .remember-me {
            color: rgb(16, 13, 13);
            font-size: 14px;
            display: flex;
            align-items: center;
            float: left;
            cursor: pointer;
        }

        .form .options-01 a {
            color: rgb(21, 18, 18);
            font-size: 14px;
            font-style: italic;
            float: right;
        }

        .form .btn {
            margin-bottom: 10px;
            outline: none;
            border: none;
            width: 80%;
            height: 50px;
            background: #8bc0dd;
            color: rgb(55, 46, 46);
            font-size: 25px;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 1px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.5s;
            transition-property: border-left, border-right, box-shadow;
        }

        .form .btn:hover {
            border-left: solid 8px rgba(255, 255, 255, 0.5);
            border-right: solid 8px rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 100px rgb(245, 51, 209);
        }

        .form .options-02 {
            color: #bbb;
            font-size: 14px;
            margin-top: 30px;
        }

        .form .options-02 a {
            color: #4285F4;
        }
    </style>

</body>

</html>