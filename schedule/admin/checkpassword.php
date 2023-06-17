<?php include'../db-connect.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$checkpassword = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' ");
if ($checkpassword->num_rows > 0) {
    while ($row = mysqli_fetch_array($checkpassword)) {
        if ($password == $row['password']) {
            $_SESSION['user'] = $row['username'];

            header("location: home.php");
        } else {
            echo '<script>alert("Incorrect Username or Password!");history.go(-1);</script>';
        }
    }
}
else{
    echo '<script>alert("Incorrect Username or Password!");history.go(-1);</script>';
}

?>