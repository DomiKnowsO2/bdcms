<?php
session_start(); 
   
    unset($_SESSION['link']);
    unset($_SESSION['name']);
    unset($_SESSION['uname']);
    unset($_SESSION['logged_admin']);

header("Location: ../index.php");
exit;
?>