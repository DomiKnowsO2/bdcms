<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['link'])) {
  header("Location: login.php");
  exit;
}

$name = $_SESSION['name'];
$link = $_SESSION['link'];

include('../db-connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include './inc/header.php';
?>

<body>
  <div id="preloader">
    <div class="loader JS_on">
      <span class="binary"></span>
      <span class="binary"></span>
      <span class="getting-there">LOADING STUFF...</span>
    </div>
  </div>

  <script>
    var loader = document.getElementById("preloader");
    window.addEventListener("DOMContentLoaded", function() {
      loader.style.display = "flex";
    });

    window.addEventListener("load", function() {
      loader.style.display = "none";
    });
  </script>
  <div class="container-fluid">
    <div class="row flex-nowrap" style="height:100vh;">
      <?php
      include './inc/navbar.php';
      $page = isset($_GET['page']) ? $_GET['page'] : 'home';

      if (!file_exists($page . ".php") && !is_dir($page)) {
        include '404.html';
      } else {
        if (is_dir($page))
          include $page . './home.php';
        else
          include $page . '.php';
      }
      ?>
    </div>
  </div>
</body>
<style>
  #preloader {
    background-image: -o-linear-gradient(45deg, #6ac1c5, #bda5ff);
    background-attachment: fixed;
    background-image: linear-gradient(45deg, #6ac1c5, #bda5ff);
    background-repeat: no-repeat;
    /* background-size: 50%; */
    height: 100vh;
    width: 100%;
    position: fixed;
    z-index: 99999;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .loader {
    width: 130px;
    height: 170px;
    position: relative;
    font-family: inherit;
  }

  .loader::before,
  .loader::after {
    content: "";
    width: 0;
    height: 0;
    position: absolute;
    bottom: 30px;
    left: 15px;
    z-index: 1;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    border-bottom: 20px solid #1b2a33;
    transform: scale(0);
    transition: all 0.2s ease;
  }

  .loader::after {
    border-right: 15px solid transparent;
    border-bottom: 20px solid #162229;
  }

  .loader .getting-there {
    width: 120%;
    text-align: center;
    position: absolute;
    bottom: 0;
    left: -7%;
    font-size: 12px;
    letter-spacing: 2px;
    color: white;
  }

  .loader .binary {
    width: 100%;
    height: 140px;
    display: block;
    color: white;
    position: absolute;
    top: 0;
    left: 15px;
    z-index: 2;
    overflow: hidden;
  }

  .loader .binary::before,
  .loader .binary::after {
    font-family: "Lato";
    font-size: 24px;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
  }

  .loader .binary:nth-child(1)::before {
    content: "🦷";
    animation: a 1.1s linear infinite;
  }

  .loader .binary:nth-child(1)::after {
    content: "🦷";
    animation: b 1.3s linear infinite;
  }

  .loader .binary:nth-child(2)::before {
    content: "🩺";
    animation: c 0.9s linear infinite;
  }

  .loader .binary:nth-child(2)::after {
    content: "🩺";
    animation: d 0.7s linear infinite;
  }

  .loader.JS_on::before,
  .loader.JS_on::after {
    transform: scale(1);
  }

  @keyframes a {
    0% {
      transform: translate(30px, 0) rotate(30deg);
      opacity: 0;
    }

    100% {
      transform: translate(30px, 150px) rotate(-50deg);
      opacity: 1;
    }
  }

  @keyframes b {
    0% {
      transform: translate(50px, 0) rotate(-40deg);
      opacity: 0;
    }

    100% {
      transform: translate(40px, 150px) rotate(80deg);
      opacity: 1;
    }
  }

  @keyframes c {
    0% {
      transform: translate(70px, 0) rotate(10deg);
      opacity: 0;
    }

    100% {
      transform: translate(60px, 150px) rotate(70deg);
      opacity: 1;
    }
  }

  @keyframes d {
    0% {
      transform: translate(30px, 0) rotate(-50deg);
      opacity: 0;
    }

    100% {
      transform: translate(45px, 150px) rotate(30deg);
      opacity: 1;
    }
  }
</style>

</html>