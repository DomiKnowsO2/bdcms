<?php
// include 'db-connect.php';
// session_start();

// $username = $_POST['uname'];
// $password = $_POST['password'];

// $checkpassword = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username'");
// if ($checkpassword->num_rows > 0) {
// 	while ($row = mysqli_fetch_array($checkpassword)) {
// 		if ($password == $row['password']) {

// 			header("location: ./home.php");
// 		} else {
// 			echo "<script> alert('Incorrect Username or Password!'); history.go(-1);</script>";
// 		}
// 	}
// }
// else{
// 	echo "<script> alert('Username or Password are Not found!'); history.go(-1);</script>";
// }
// $conn->close();

?>


<?php
// Check if the user is already logged in
if (isset($_SESSION['uname'])) {
	// Redirect the user to the home page
	header('Location: ../index.php');
}

// Check if the form has been submitted
if (isset($_POST['uname']) && isset($_POST['password'])) {
	// Connect to the database
	$db = new PDO('mysql:host=localhost;dbname=bdcmsdb', 'root', '');

	// Get the username and password from the form
	$username = $_POST['uname'];
	$password = $_POST['password'];

	// Check if the username and password exist in the database
	$sql = "SELECT * FROM `admin` WHERE username = ? AND password = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute(array($username, $password));

	// If the username and password exist, log the user in
	if ($stmt->rowCount() > 0) {
		// Set the session variables
		$_SESSION['uname'] = $username;
		$_SESSION['logged_in'] = true;

		// Redirect the user to the home page
		header('Location: ../index.php');
	} else {
		// Display an error message
		echo "<script> alert('Invalid username or password!'); history.go(-1);</script>";
	}
}
?>