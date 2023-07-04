<?php
session_start();
include('./db-connect.php');
if (!isset($_SESSION['email'])) {
   header("Location: user_login.php");
   exit;
}
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
   $notification_count_query = "SELECT COUNT(*) AS notification_count FROM notification_tb WHERE patient_id = '$patient_id' AND count = 0";
   $notification_count_result = mysqli_query($conn, $notification_count_query);

   if ($notification_count_result && mysqli_num_rows($notification_count_result) > 0) {
      $notification_count_row = mysqli_fetch_assoc($notification_count_result);
      $notification_count = $notification_count_row['notification_count'];
   } else {
      $notification_count = 0;
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
   <link rel="stylesheet" href="./admin/calendar/evo-calendar/css/evo-calendar.min.css">
   <link rel="stylesheet" href="./admin/calendar/evo-calendar/css/evo-calendar.royal-navy.min.css">
   <link rel="stylesheet" href="./admin/calendar/demo/demo.css">
   <link rel="stylesheet" href="./admin/calendar/evo-calendar/css/evo-calendar.css">

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
   <div id="preloader">
      <div class="loader JS_on">
         <span class="binary"></span>
         <span class="binary"></span>
         <span class="getting-there">LOADING STUFF...</span>
      </div>
   </div>
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

            <a href="#" class="btn btn-round btn-green align-items-center justify-content-center" id="myBtn"
               data-toggle="tooltip" data-placement="bottom" title="Notification">
               <i class="fas fa-bell">
                  <?php if ($notification_count == 0) {
                  } else { ?>
                     <span class="notification">
                        <?php echo $notification_count; ?>
                     </span>
                  <?php } ?>
               </i>
            </a>
            <script>
               var notificationButton = document.getElementById('myBtn');
               notificationButton.addEventListener('click', function () {
                  <?php
                  $notification_count = 0;
                  ?>

                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', './includes/update_notification_count.php', true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function () {
                     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Update the displayed count to 0
                        var notificationCount = document.querySelector('.notification');
                        if (notificationCount) {
                           notificationCount.textContent = '0';
                           notificationCount.style.display = 'none';
                        }
                     }
                  };
                  xhr.send('patient_id=<?php echo $patient_id; ?>');

               });
            </script>
            <a href="./includes/logout.php" class="btn btn-round btn-green align-items-center justify-content-center"
               data-toggle="tooltip" data-placement="bottom" title="Logout" data-delay="1000">
               <i class="fas fa-sign-out-alt"></i>
            </a>

         </nav>

         <div id="menu-btn" class="fas fa-bars"></div>

      </div>
   </header>

   <!-- home section starts  -->

   <section class="home" id="home">

      <div class="container">

         <div class="row min-vh-100 align-items-center">
            <div class="content text-center text-md-left">
               <h3>balatan dental clinic management system</h3>
               <p>Dr. Ricardo P. Enciso</p>
               <p>Assistant Felwin B. Barreda</p>

               <a href="user_login.php" class="link-btn">make appointment</a>
            </div>
         </div>

      </div>

   </section>

   <!-- home section ends -->

   <!-- about section starts  -->

   <section class="about" id="about">

      <div class="container">

         <div class="row align-items-center">

            <div class="col-md-6 image">
               <img src="images/clinic3.jpg" class="w-100 mb-5 mb-md-0" alt="">
            </div>

            <div class="col-md-6 content">
               <span>about us</span>
               <h3>Balatan rural health unit is government owned health center located in Balatan, Camarines Sur.</p>
                  <p>"“Every tooth in a man's head is more valuable than a diamond.” So remember to brush your teeth,
                     and look after them as well as you would look after a diamond!"</p>
                  <p></p>
                  <a href="user_login.php" class="link-btn">make appointment</a>
            </div>

         </div>

      </div>

   </section>

   <!-- about section ends -->

   <!-- services section starts  -->

   <section class="services" id="services">

      <h1 class="heading">our services</h1>

      <div class="box-container container">

         <div class="box">
            <img src="images/icon-1.svg" alt="">
            <h3>Alignment specialist</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/icon-2.svg" alt="">
            <h3>Cosmetic dentistry</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/icon-3.svg" alt="">
            <h3>Oral hygiene experts</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/icon-4.svg" alt="">
            <h3>Root canal specialist</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/icon-5.svg" alt="">
            <h3>Live dental advisory</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/icon-6.svg" alt="">
            <h3>Cavity inspection</h3>
            <p></p>
         </div>

      </div>

   </section>

   <!-- services section ends -->

   <!-- process section starts  -->

   <section class="process">

      <h1 class="heading">work process</h1>

      <div class="box-container container">

         <div class="box">
            <img src="images/process-1.png" alt="">
            <h3>Cosmetic Dentistry</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/process-2.png" alt="">
            <h3>Pediatric Dentistry</h3>
            <p></p>
         </div>

         <div class="box">
            <img src="images/process-3.png" alt="">
            <h3>Dental Implants</h3>
            <p></p>
         </div>

      </div>

   </section>

   <!-- process section ends -->

   <!-- reviews section starts  -->

   <section class="reviews" id="reviews">

      <h1 class="heading"> satisfied clients </h1>

      <div class="box-container container">

         <div class="box">
            <img src="images/name1.jpg" alt="">
            <p>"Dr's hand is light, I didn't feel any pain when he gave the injection and he pulled out my tooth easily"
            </p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john paul d. baris</h3>
            <span>satisfied client</span>
         </div>

         <div class="box">
            <img src="images/name2.png" alt="">
            <p>"The Assistant here at the Clinic is very attentive and each of their extraction tools is also clean"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>may b. malapo</h3>
            <span>satisfied client</span>
         </div>

         <div class="box">
            <img src="images/name3.png" alt="">
            <p>"Assisting is okay and Doc is very approachable, he is a recommended clinic for me"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>luis c. quarto</h3>
            <span>satisfied client</span>
         </div>

      </div>

   </section>

   <!-- reviews section ends -->

   <section class="contact" id="contact">
      <h1 class="heading">make appointment</h1>
      <div class="box-container container">
         <main>
            <div class="console-log">
               <div class="log-content">
                  <div class="--noshadow" id="calendar"></div>
               </div>
            </div>
         </main>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
      <script src="./admin/calendar/evo-calendar/js/evo-calendar.min.js"></script>
      <script src="./admin/calendar/demo/demo.js"></script>

      <script>
         $(document).ready(function () {
            $('#calendar').evoCalendar({
               theme: 'Royal Navy',
               calendarEvents: [
                  <?php
                  $sqlCalendar = mysqli_query($conn, "SELECT r.*, s.service_name FROM requests_tb r INNER JOIN services_tb s ON r.service_id = s.service_id ORDER BY r.appointment_date ASC");
                  while ($row = mysqli_fetch_array($sqlCalendar)) {
                     echo "{";
                     echo "id: '" . $row['request_id'] . "',";
                     echo "badge: '" . date('g:i a', strtotime($row['appointment_date'])) . "', ";
                     echo "name: '" . (strlen($row['firstName'] . " " . $row['lastName']) > 13 ? substr($row['firstName'] . " " . $row['lastName'], 0, 10) . "..." : $row['firstName'] . " " . $row['lastName']) . "',";
                     echo "description: '" . $row['service_name'] . "<br>" . "',";
                     echo "date: '" . $row['appointment_date'] . "',";
                     echo "type: 'event',";
                     echo "color: ";

                     $status = $row['status'];
                     if ($status === "Approve") {
                        echo "'#198754'";
                     } elseif ($status === "Reject") {
                        echo "'#dc3545'";
                     } elseif ($status === "Done") {
                        echo "'lightseagreen'";
                     } else {
                        echo "'#fd7e14'";
                     }
                     echo "},";
                  }
                  ?>
               ]
            });
            var eventHeader = document.querySelector('.event-header');
            var dateText = eventHeader.querySelector('p').textContent;
            var dateObj = new Date(dateText);

            var month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
            var day = dateObj.getDate().toString().padStart(2, '0');
            var year = dateObj.getFullYear();

            var formattedDate = year + '-' + month + '-' + day;

            var formData = document.querySelector('#formData');
            var calendarEventsContainer = document.querySelector('.calendar-events');

            var formDiv = document.createElement('div');
            formDiv.className = 'form';
            formDiv.id = 'formData';

            var form = document.createElement('form');
            form.action = 'save_appointment.php';
            form.method = 'Post';

            var title = document.createElement('div');
            title.className = 'title';
            title.innerHTML = '<strong>Appointment Form</strong>';

            var inputid = document.createElement('input');
            inputid.type = 'hidden';
            inputid.name = 'patient_id';
            inputid.value = '<?php echo $patient_id; ?>';

            form.appendChild(inputid);

            var labelfname = document.createElement('label');
            labelfname.textContent = 'First Name:';
            <?php if (!empty($firstName)): ?>
               labelfname.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labelfname);
            var inputfname = document.createElement('input');
            inputfname.type = '<?php echo (!empty($firstName)) ? "hidden" : "text"; ?>';
            inputfname.name = 'fname';
            inputfname.value = '<?php echo $firstName; ?>';
            inputfname.placeholder = 'Enter your first name';
            form.appendChild(inputfname);

            var labelmname = document.createElement('label');
            labelmname.textContent = 'Middle Name:';
            <?php if (!empty($middleName)): ?>
               labelmname.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labelmname);

            var inputmname = document.createElement('input');
            inputmname.type = '<?php echo (!empty($middleName)) ? "hidden" : "text"; ?>';
            inputmname.name = 'mname';
            inputmname.value = '<?php echo $middleName; ?>';
            inputmname.placeholder = 'Enter your middle name';
            form.appendChild(inputmname);


            var labellname = document.createElement('label');
            labellname.textContent = 'Last Name:';
            <?php if (!empty($lastName)): ?>
               labellname.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labellname);

            var inputlname = document.createElement('input');
            inputlname.type = '<?php echo (!empty($lastName)) ? "hidden" : "text"; ?>';
            inputlname.name = 'lname';
            inputlname.value = '<?php echo $lastName; ?>';
            inputlname.placeholder = 'Enter your last name';
            form.appendChild(inputlname);


            var labelbirthdate = document.createElement('label');
            labelbirthdate.textContent = 'Birth Date:';
            <?php if (!empty($birthdate) && $birthdate !== '0000-00-00'): ?>
               labelbirthdate.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labelbirthdate);

            var inputbirthdate = document.createElement('input');
            inputbirthdate.type = '<?php echo (!empty($birthdate) && $birthdate !== '0000-00-00') ? "hidden" : "date"; ?>';
            inputbirthdate.name = 'birthdate';
            inputbirthdate.value = '<?php echo ($birthdate !== '0000-00-00') ? $birthdate : ''; ?>';
            inputbirthdate.placeholder = 'Enter your birthdate';
            form.appendChild(inputbirthdate);


            var labeladdress = document.createElement('label');
            labeladdress.textContent = 'Address:';
            <?php if (!empty($address)): ?>
               labeladdress.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labeladdress);

            var inputaddress = document.createElement('input');
            inputaddress.type = '<?php echo (!empty($address)) ? "hidden" : "text"; ?>';
            inputaddress.name = 'address';
            inputaddress.value = '<?php echo $address; ?>';
            inputaddress.placeholder = 'Enter your address';
            form.appendChild(inputaddress);


            var labelemail = document.createElement('label');
            labelemail.textContent = 'Email:';
            <?php if (!empty($email)): ?>
               labelemail.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labelemail);

            var inputemail = document.createElement('input');
            inputemail.type = '<?php echo (!empty($email)) ? "hidden" : "email"; ?>';
            inputemail.name = 'email';
            inputemail.value = '<?php echo $email; ?>';
            inputemail.placeholder = 'Enter your email';
            form.appendChild(inputemail);


            var labelnumber = document.createElement('label');
            labelnumber.textContent = 'Your Number:';
            <?php if (!empty($phone)): ?>
               labelnumber.style.display = 'none';
            <?php endif; ?>
               form.appendChild(labelnumber);

            var inputnumber = document.createElement('input');
            inputnumber.type = '<?php echo (!empty($phone)) ? "hidden" : "text"; ?>';
            inputnumber.name = 'number';
            inputnumber.value = '<?php echo $phone; ?>';
            inputnumber.placeholder = 'Enter your phone number';
            form.appendChild(inputnumber);


            var label1 = document.createElement('label');
            label1.textContent = 'Appointment Date:';
            var input1 = document.createElement('input');
            input1.className = 'Adate';
            input1.type = 'date';
            input1.name = 'date';
            input1.value = formattedDate;
            form.appendChild(label1);
            form.appendChild(input1);

            var label2 = document.createElement('label');
            label2.textContent = 'Select Time:';
            var input2 = document.createElement('select');
            input2.className = 'time';
            input2.name = 'time';
            var option1 = document.createElement('option');
            option1.value = '';
            option1.text = 'Available Time';
            input2.appendChild(option1);

            form.appendChild(label2);
            form.appendChild(input2);

            var label3 = document.createElement('label');
            label3.textContent = 'Service:';
            var input3 = document.createElement('select');
            input3.name = 'service';
            input3.id = 'service';
            input3.required = true;
            var option3 = document.createElement('option');
            option3.value = '';
            option3.text = 'Select Services';
            input3.appendChild(option3);

            var serviceOptions = [];

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
               if (xhr.readyState === 4 && xhr.status === 200) {
                  serviceOptions = JSON.parse(xhr.responseText);

                  for (var i = 0; i < serviceOptions.length; i++) {
                     var option = document.createElement('option');
                     option.value = serviceOptions[i].value;
                     option.text = serviceOptions[i].text;
                     input3.appendChild(option);
                  }
               }
            };

            xhr.open('GET', 'get_service_options.php');
            xhr.send();

            form.appendChild(label3);
            form.appendChild(input3);


            var submitBtn = document.createElement('input');
            submitBtn.type = 'submit';
            submitBtn.name = 'submit';
            submitBtn.value = 'Submit';
            submitBtn.className = 'addEventBtn bottom';
            form.appendChild(submitBtn);

            var inputs = form.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
               inputs[i].required = true;
            }

            var selects = form.getElementsByTagName('select');
            for (var i = 0; i < selects.length; i++) {
               selects[i].required = true;
            }

            formDiv.appendChild(title);
            formDiv.appendChild(form);
            calendarEventsContainer.appendChild(formDiv);

            var bottomBtn = document.createElement('button');
            bottomBtn.type = 'button';
            bottomBtn.className = 'addEventBtn';
            bottomBtn.innerText = 'Add Appointment';

            var addEventContainer = document.createElement('div');
            addEventContainer.className = 'addEventContainer';
            addEventContainer.appendChild(bottomBtn);
            calendarEventsContainer.appendChild(addEventContainer);

            bottomBtn.addEventListener('click', function () {
               formDiv.style.display = 'block';
               setTimeout(function () {
                  formDiv.classList.add('show-form');
               }, 300);
            });

            var today = new Date();
            today.setHours(0, 0, 0, 0);

            var tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            if (dateObj >= tomorrow) {
               bottomBtn.style.display = 'block';
            } else {
               bottomBtn.style.display = 'none';
            }


            $('#calendar').on('selectDate', function () {
               var selectedDate = $('#calendar').evoCalendar('getActiveDate');
               var newDateObj = new Date(selectedDate);
               newDateObj.setHours(0, 0, 0, 0);
               dateObj = newDateObj;

               month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
               day = dateObj.getDate().toString().padStart(2, '0');
               year = dateObj.getFullYear();
               formattedDate = year + '-' + month + '-' + day;

               input1.value = formattedDate;

               var currentDay = dateObj.getDay();
               if (currentDay === 0) {
                  bottomBtn.style.display = 'none';
                  textContents = 'We kindly inform you that there is no scheduling on Sundays. Our clinic operates from Monday to Saturday. We apologize for any inconvenience and appreciate your understanding.';
               } else if (dateObj >= tomorrow) {
                  bottomBtn.style.display = 'block';
                  textContents = 'Add Appointment';
               } else {
                  bottomBtn.style.display = 'none';
               }

               var calendarEventsContainer = document.querySelector('.calendar-events');
               var eventEmpty = document.querySelector('.event-empty');
               var pElement = eventEmpty ? eventEmpty.querySelector('p') : null;

               if (pElement) {
                  pElement.textContent = textContents;
               }

               var today = new Date();
               today.setHours(0, 0, 0, 0);

               if (dateObj <= today || currentDay === 0) {
                  formDiv.style.display = 'none';
                  formDiv.classList.remove('show-form');
               }

               var xhr = new XMLHttpRequest();
               xhr.open('GET', 'get_time_options.php?date=' + formattedDate, true);
               xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                     if (xhr.status === 200) {

                        var reservedTimeSlotsServer = JSON.parse(xhr.responseText);
                        console.log(reservedTimeSlotsServer);

                        var reservedTimeSlotsCombined = reservedTimeSlots.concat(reservedTimeSlotsServer);
                        console.log('Combined Reserved Time Slots:', reservedTimeSlotsCombined);

                        var timeOptions = [{
                           value: '',
                           text: 'Available Time'
                        }, {
                           value: '08:00:00',
                           text: '8:00 AM'
                        },
                        {
                           value: '09:00:00',
                           text: '9:00 AM'
                        },
                        {
                           value: '10:00:00',
                           text: '10:00 AM'
                        },
                        {
                           value: '11:00:00',
                           text: '11:00 AM'
                        },
                        {
                           value: '13:00:00',
                           text: '1:00 PM'
                        },
                        {
                           value: '14:00:00',
                           text: '2:00 PM'
                        },
                        {
                           value: '15:00:00',
                           text: '3:00 PM'
                        },
                        {
                           value: '16:00:00',
                           text: '4:00 PM'
                        },
                        {
                           value: '17:00:00',
                           text: '5:00 PM'
                        }
                        ];
                        input2.innerHTML = '';
                        for (var i = 0; i < timeOptions.length; i++) {
                           var option = document.createElement('option');
                           option.value = timeOptions[i].value;
                           option.text = timeOptions[i].text;

                           if (!reservedTimeSlotsCombined.includes(timeOptions[i].value)) {
                              input2.appendChild(option);
                           }
                        }
                     } else {
                        window.location.href = 'https://www.google.com';
                     }
                  }
               };
               xhr.send();

               var responseDataDate = false;
               var xhr2 = new XMLHttpRequest();
               xhr2.open('GET', 'get_date.php?date=' + formattedDate, true);
               xhr2.onreadystatechange = function () {
                  if (xhr2.readyState === XMLHttpRequest.DONE) {
                     if (xhr2.status === 200) {
                        console.log("Second XHR request completed");
                        responseDataDate = JSON.parse(xhr2.responseText); // Update responseDataDate

                        if (responseDataDate === true) {
                           bottomBtn.style.display = 'none';
                           textContents = 'Doctor is not available';
                           pElement.textContent = textContents;
                        }
                        if (dateObj <= today || currentDay === 0 || responseDataDate === true) {
                           formDiv.style.display = 'none';
                           formDiv.classList.remove('show-form');
                        }
                     } else {
                        window.location.href = 'https://www.google.com';
                     }
                  }
               };
               xhr2.send();
            });

            var reservedTimeSlots = [];

            // for (var i = 0; i < timeOptions.length; i++) {
            //    var option = document.createElement('option');
            //    option.value = timeOptions[i].value;
            //    option.text = timeOptions[i].text;

            //    if (!reservedTimeSlots.includes(timeOptions[i].value)) {
            //       input2.appendChild(option);
            //    }
            // }

         });
         var loader = document.getElementById("preloader");
         window.addEventListener("DOMContentLoaded", function () {
            loader.style.display = "flex";
         });

         window.addEventListener("load", function () {
            loader.style.display = "none";
         });
      </script>
   </section>



   <!-- footer section starts  -->

   <section class="footer">

      <div class="box-container container">

         <div class="box">
            <i class="fas fa-phone"></i>
            <h3>phone number</h3>
            <p>+639706557001</p>
         </div>

         <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <h3>our address</h3>
            <p>868R+R7C, Balatan Camarines Sur</p>
         </div>

         <div class="box">
            <i class="fas fa-clock"></i>
            <h3>opening day & hours</h3>
            <p>Saturday-8:00am to 5:00pm</p>
         </div>

         <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>email address</h3>
            <p>rhubalatan@yahoo.com</p>
            <p></p>
         </div>

      </div>

   </section>


   <?php include('./modal.php'); ?>
   <!-- footer section ends -->
   <script src="js/script.js"></script>
</body>
<style>
   .form {
      overflow: auto;
      width: 90%;
      /* background-color: pink; */
      background-color: rgb(33, 101, 131);
      top: 5%;
      /* padding-top: 5%; */
      height: 90%;
      position: absolute;
      z-index: 10;
      left: 5%;
      display: none;
      transition: transform 0.3s ease;
      transform: translateY(100%);
   }

   .form .title {
      position: sticky;
      top: 0;
      background-color: rgb(33, 101, 131);
      color: white;
      padding: 10px;
      font-weight: bold;
   }

   .form .content {
      padding-top: 30px;
   }

   .addEventContainer {
      flex: 10%;
      /* background-color: orange; */
      padding: 10px;
      width: 100%;
      display: flex;
      justify-content: center;
   }

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