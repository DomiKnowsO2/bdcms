<!DOCTYPE html>
<html>

<head>
    <title>Dental Clinic Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            background-image: url(./images/clinic3.jpg);
            background-size: cover;
            background-position: top;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* .container {
            background-image: url(./images/img3.jpg);
            background-size: cover;
            background-position: center;
            margin-top: 20px;
            width: 50%;
            margin: auto;
        } */


        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #000;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="tel"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div>
        <img src="./images/img4.jpg" alt="This is a test image" height="650" width="500">
        <div class="form-container">
            <h2>User Login</h2>
            <form action="login.php" method="POST">
                <label for="login_email">Email:</label>
                <input type="email" id="login_email" name="login_email" required>

                <label for="login_password">Password:</label>
                <input type="password" id="login_password" name="login_password" required>

                <input type="submit" value="Login">

                <div class="signup-link">
                    Don't have an account? <a href="signup.html">Sign up</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>