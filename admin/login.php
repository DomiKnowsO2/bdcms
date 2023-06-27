<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>BDCMS</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>


</head>

<body>

    <img src="images/img4.jpg" alt="This is a test image" height="650" width="500">
    <!--form area start-->
    <div class="form">
        <div>
        <h1>BDCMS</h1>
        <!--login form start-->
        <form class="login-form" action="inc/checkpassword.php" method="post">
            <i class="fas fa-user-circle"></i>
            <input class="user-input" type="text" name="uname" placeholder="Username" required>
            <input class="user-input" type="password" name="password" placeholder="Password" required>
            <!--<div class="options-01">
                <label class="remember-me"><input type="checkbox" name="">Remember me</label>
            </div>
            -->
            <input class="btn" type="submit" value="LOGIN">
            <a href="../index.php">Back to Home</a>
            <!--<div class="options-02">
                <p>Not Registered? <a href="#">Create an Account</a></p><br>
            </div>
            -->
        </form>
        <!--login form end-->
        <!--signup form start-->
        <form class="signup-form" action="" method="post">
            <i class="fas fa-user-plus"></i>
            <input class="user-input" type="text" name="" placeholder="Username" required>
            <input class="user-input" type="email" name="" placeholder="Email Address" required>
            <input class="user-input" type="password" name="" placeholder="Password" required>
            <input class="btn" type="submit" name="" value="SIGN UP">
            <!--<div class="options-02">
                <p>Already Registered? <a href="#">Sign In</a></p><br>
            </div>
            -->

        </form>
        <!--signup form end--></div>
    </div>
    <!--form area end-->
    <script type="text/javascript">
        $('.options-02 a').click(function () {
            $('form').animate({
                height: "toggle", opacity: "toggle"
            }, "slow");
        });
    </script>

</body>

</html>