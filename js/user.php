<?php
session_start();
include('./db-connect.php');
// $_SESSION['user'] = 'user';

$patient_id = "";
$firstName = "";
$middleName = "";
$lastName = "";
$birthdate = "";
$address = "";
$email = "";
$phone = "";

if (isset($_SESSION['email'])) {
   $email = $_SESSION['email'];

   $query = "SELECT * FROM patient_tb WHERE email = '$email'";
   $result = mysqli_query($conn, $query);

   if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $patient_id = $row['patient_id'];
      $firstName = $row['firstName'];
      $middleName = $row['middleName'];
      $lastName = $row['lastName'];
      $birthdate = $row['birthdate'];
      $address = $row['address'];
      $phone = $row['phone'];
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BDCMS</title>

   <!-- sample commit2 -->
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="./css/mod.css">


   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>

</head>

<body>

   <!-- header section starts  -->

   <header class="header fixed-top">

      <div class="row align-items-center justify-content-between">
         <nav>
            <a href="#" class="logo">BDC<span>MS</span></a>
         </nav>


         <nav class="nav">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#services">services</a>
            <a href="#reviews">reviews</a>
            <a href="#contact">Appointment</a>
         </nav>
         <nav class="right none">

            <a href="#" class="btn btn-round btn-green align-items-center justify-content-center" data-toggle="tooltip" data-placement="bottom" title="Notification" data-delay="1000">
               <i class="fas fa-bell"><span class="notification">2</span></i>
            </a>
            <a href="./admin/logout.php" class="btn btn-round btn-green align-items-center justify-content-center" data-toggle="tooltip" data-placement="bottom" title="Logout" data-delay="1000">
               <i class="fas fa-sign-out-alt"></i>
            </a>

         </nav>
         <div id="menu-btn" class="fas fa-bars"></div>

      </div>
   </header>
 


   <section class="contact" id="contact">

      <h1 class="heading">make appointment</h1>

      <form action="save_appointment.php" method="post">
         <input type="number" name="patient_id" value="<?php echo $patient_id; ?>" class="box" required>
         <span>First name :</span>
         <input type="text" name="fname" value="<?php echo $firstName; ?>" placeholder="Enter your Firstname" class="box" required>
         <span>Middle name :</span>
         <input type="text" name="mname" value="<?php echo $middleName; ?>" placeholder="Enter your Middlename" class="box" required>
         <span>Last name :</span>
         <input type="text" name="lname" value="<?php echo $lastName; ?>" placeholder="Enter your Lastname" class="box" required>
         <span>Birth Date :</span>
         <input type="date" name="birthdate" value="<?php echo $birthdate; ?>" placeholder="Enter your birthdate" class="box" required>
         <span>Address :</span>
         <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Enter your Address" class="box" required>
         <span>your email :</span>
         <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your Email" class="box" required>
         <span>your number :</span>
         <input type="text" name="number" value="<?php echo $phone; ?>" placeholder="Enter your Phone Number" class="box" required>

         <span for="service">Service:</span>
         <select name="service" id="service" class="box" required>
            <option value="">Please Select</option>
            <?php
            $servicesquery = "SELECT * FROM services_tb";
            $servicesresult = mysqli_query($conn, $servicesquery);
            while ($servicerow = $servicesresult->fetch_assoc()) :
            ?>
               <option value="<?php echo $servicerow['service_id']; ?>"><?php echo $servicerow['service_name']; ?>
               </option>
            <?php endwhile; ?>
         </select>

         <span>appointment date :</span>
         <!-- <input type="datetime-local" name="date" class="box" required> -->
         <!-- <input type="datetime-local" id="myDatePicker" name="date" class="box" required> -->
         <input type="text" name="date" id="date"class="box" placeholder="Enter your date">
         <input type="text" name="time" id="time"class="box" placeholder="Enter your time">
         <input type="submit" value="make appointment" name="submit" class="link-btn">
      </form>

   </section>
   <script>
      flatpickr("#myDatePicker", {
         enableTime: true,
         dateFormat: "Y-m-d H:i",
         // Add more options as needed
      });

      $(function() {
         $('[data-toggle="tooltip"]').tooltip()
      });
   </script>
   <script src="js/script.js"></script>

</body>

</html>