<?php
session_start();
include('./db-connect.php');

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

      <!-- <h1 class="heading">make appointment</h1>

      <form action="save_appointment.php" method="post">
         <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" class="box" required>
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
      </form> -->
   </section>
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
         $(document).ready(function() {
            $('#calendar').evoCalendar({
               theme: 'Royal Navy',
               calendarEvents: [
                  <?php
                  $sqlCalendar = mysqli_query($conn, "SELECT r.*, s.service_name FROM requests_tb r INNER JOIN services_tb s ON r.service_id = s.service_id ORDER BY r.appointment_date ASC");
                  while ($row = mysqli_fetch_array($sqlCalendar)) {
                     echo "{";
                     echo "id: '" . $row['request_id'] . "',";
                     echo "badge: '" . date('g:i a', strtotime($row['appointment_date'])) . "', ";
                     echo "name: '" . $row['firstName'] . " " . $row['lastName'] . "',";
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
            <?php if (!empty($firstName)) : ?>
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
            <?php if (!empty($middleName)) : ?>
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
            <?php if (!empty($lastName)) : ?>
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
            <?php if (!empty($birthdate) && $birthdate !== '0000-00-00') : ?>
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
            <?php if (!empty($address)) : ?>
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
            <?php if (!empty($email)) : ?>
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
            <?php if (!empty($phone)) : ?>
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

            var timeOptions = [{
                  value: '08:00',
                  text: '8:00 AM'
               },
               {
                  value: '09:00',
                  text: '9:00 AM'
               },
               {
                  value: '10:00',
                  text: '10:00 AM'
               },
               {
                  value: '11:00',
                  text: '11:00 AM'
               },
               {
                  value: '13:00',
                  text: '1:00 PM'
               },
               {
                  value: '14:00',
                  text: '2:00 PM'
               },
               {
                  value: '15:00',
                  text: '3:00 PM'
               },
               {
                  value: '16:00',
                  text: '4:00 PM'
               },
               {
                  value: '17:00',
                  text: '5:00 PM'
               }
            ];

            var reservedTimeSlots = ['08:00', '10:00', '13:00'];

            for (var i = 0; i < timeOptions.length; i++) {
               var option = document.createElement('option');
               option.value = timeOptions[i].value;
               option.text = timeOptions[i].text;

               if (!reservedTimeSlots.includes(timeOptions[i].value)) {
                  input2.appendChild(option);
               }
            }
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
            xhr.onreadystatechange = function() {
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
            submitBtn.className = 'addEventBtn';
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
            bottomBtn.innerText = 'Add Event';

            var addEventContainer = document.createElement('div');
            addEventContainer.className = 'addEventContainer';
            addEventContainer.appendChild(bottomBtn);
            calendarEventsContainer.appendChild(addEventContainer);

            bottomBtn.addEventListener('click', function() {
               formDiv.style.display = 'block';
               setTimeout(function() {
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

            $('#calendar').on('selectDate', function() {
               var selectedDate = $('#calendar').evoCalendar('getActiveDate');

               var newDateObj = new Date(selectedDate);
               newDateObj.setHours(0, 0, 0, 0);
               dateObj = newDateObj;

               month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
               day = dateObj.getDate().toString().padStart(2, '0');
               year = dateObj.getFullYear();
               formattedDate = year + '-' + month + '-' + day;

               input1.value = formattedDate;

               if (dateObj >= tomorrow) {
                  bottomBtn.style.display = 'block';
               } else {
                  bottomBtn.style.display = 'none';
               }

               var today = new Date();
               today.setHours(0, 0, 0, 0);

               if (dateObj <= today) {
                  formDiv.style.display = 'none';
                  formDiv.classList.remove('show-form');
               }
            });

         });
      </script>
   </section>
   <script src="js/script.js"></script>
</body>

</html>