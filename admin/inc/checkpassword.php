<?php
session_start();
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
		// Fetch the row from the result set
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Get the column name
		$columnName = $row['name'];
		$link = $row['link'];

		// Set the session variables
		$_SESSION['link'] = $link;
		$_SESSION['name'] = $columnName;
		$_SESSION['uname'] = $username;
		$_SESSION['logged_admin'] = true;

		// Redirect the user to the home page
		header('Location: ../index.php');
	} else {
		// Display an error message
		echo "<script> alert('Invalid username or password!'); history.go(-1);</script>";
	}
}
