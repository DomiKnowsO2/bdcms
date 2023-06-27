<?php
session_start(); 
   
    unset($_SESSION['email']);
    unset($_SESSION['logged_in']);

header("Location: ../index.php");
exit;
?>