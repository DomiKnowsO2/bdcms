<?php
session_start();
// Check if the user is already logged in
// if (isset($_SESSION['email'])) {
//     // Redirect the user to the home page
//     header('Location: ./user1.php');
// }

// Check if the form has been submitted
if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Connect to the database
        $db = new PDO('mysql:host=localhost;dbname=bdcmsdb', 'root', '');

        // Get the username and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the username and password exist in the database
        $sql = "SELECT * FROM `patient_tb` WHERE email = ? AND password = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email, $password));

        // If the username and password exist, log the user in
        if ($stmt->rowCount() > 0) {
            // Set the session variables
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;

            // Redirect the user to the home page
            header('Location: ./user1.php #contact');
        } else {
            // Display an error message
            echo "<script> alert('Invalid username or password!'); history.go(-1);</script>";
        }
    }
}

if (isset($_POST['signup'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Connect to the database
        $db = new PDO('mysql:host=localhost;dbname=bdcmsdb', 'root', '');

        // Get the username and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT * FROM `patient_tb` WHERE email = ?";
        $stmt = $db->prepare($checkEmailQuery);
        $stmt->execute(array($email));

        // If the email already exists, display an error message
        if ($stmt->rowCount() > 0) {
            echo "<script> alert('Email Already Have an account!'); history.go(-1);</script>";
        } else {
            // Insert the new user into the database
            $insertQuery = "INSERT INTO `patient_tb` (`email`, `password`) VALUES (?, ?)";
            $stmt = $db->prepare($insertQuery);
            $stmt->execute(array($email, $password));

            // If the insert was successful, log the user in
            if ($stmt->rowCount() > 0) {
                // Set the session variables
                $_SESSION['email'] = $email;
                $_SESSION['logged_in'] = true;

                // Redirect the user to the home page
                header('Location: ./user1.php #contact');
                exit(); // Add exit() to prevent further execution
            } else {
                // Display an error message
                echo "<script> alert('Invalid username or password!'); history.go(-1);</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>USER LOGIN</title>
    <link rel="stylesheet" href="admin/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
</head>

<body>
    <header class="header fixed-top" style="background-color: #fff;">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <a href="index.php" class="logo">BDC<span>MS</span></a>

                <nav class="nav">
                    <a href="index.php #home">home</a>
                    <a href="index.php #about">about</a>
                    <a href="index.php #services">services</a>
                    <a href="index.php #reviews">reviews</a>
                    <a href="index.php #contact">contact</a>
                    <a href="./admin/login.php">admin</a>
                </nav>
                <div id="menu-btn" class="fas fa-bars"></div>

            </div>

        </div>

    </header>
    <img src="./images/Image.png" alt="This is a test image" height="500" width="400" class="img">
    <!--form area start-->
    <div class="form">
        <div>
            <h1>BDCMS</h1>
            <!--login form start-->
            <form class="signup-form" action="" method="post" id="signup">
                <i class="fas fa-user-plus"></i>
                <!-- <input class="user-input" type="text" name="" placeholder="Username" required> -->
                <input class="user-input" type="email" name="email" placeholder="Email Address" required>
                <input class="user-input" type="password" name="password" placeholder="Password" required>
                <input class="btn" type="submit" name="signup" value="SIGN UP">
                <div class="options-02 login">
                    <p>Already Registered? <a href="#">Sign In</a></p><br>
                </div>
            </form>
            <!--login form end-->
            <!-- signup form start -->
            <form class="login-form" action="" method="post">
                <i class="fas fa-user-circle"></i>
                <input class="user-input" type="email" name="email" placeholder="Email Address" required>
                <input class="user-input" type="password" name="password" placeholder="Password" required>
                <!-- <div class="options-01">
                        <label class="remember-me"><input type="checkbox" name="">Remember me</label>
                    </div> -->

                <input class="btn" type="submit" name="login" value="LOGIN"><br>
                <div class="options-02 signup">
                    <p>Not Registered? <a href="#">Create an Account</a></p><br>
            </form>
            <!--signup form end-->
        </div>
    </div>

    <!--form area end-->
    <script type="text/javascript">
        $('.options-02 a').click(function() {
            $('form').animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        });
    </script>
</body>
<style>
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

    .img {
        background-color: #08a671b3;
    }

    ::placeholder,
    .options-02 {
        color: #fff !important;
    }
</style>

</html>