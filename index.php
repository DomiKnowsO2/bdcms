<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BDCMS</title>

   <!-- sample commit -->
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header section starts  -->

   <header class="header fixed-top">

      <div class="container">

         <div class="row align-items-center justify-content-between">

            <a href="login.php" class="logo">BDC<span>MS</span></a>

            <nav class="nav">
               <a href="#home">home</a>
               <a href="#about">about</a>
               <a href="#services">services</a>
               <a href="#reviews">reviews</a>
               <a href="#contact">contact</a>
               <a href="./admin/login.php">admin</a>
            </nav>

            <a href="#contact" class="link-btn">make appointment</a>

            <div id="menu-btn" class="fas fa-bars"></div>

         </div>

      </div>

   </header>

   <!-- header section ends -->

   <!-- home section starts  -->

   <section class="home" id="home">

      <div class="container">

         <div class="row min-vh-100 align-items-center">
            <div class="content text-center text-md-left">
               <h3>balatan dental clinic management system</h3>
               <p>Dr. Ricardo P. Enciso</p>
               <p>Assistant Felwin B. Barreda</p>

               <a href="#contact" class="link-btn">make appointment</a>
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
                  <a href="#contact" class="link-btn">make appointment</a>
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

   <!-- contact section starts  -->

   <section class="contact" id="contact">

      <h1 class="heading">make appointment</h1>

      <form action="save_appointment.php" method="post">
         <span>First name :</span>
         <input type="text" name="fname" placeholder="Enter your Firstname" class="box" required>
         <span>Last name :</span>
         <input type="text" name="lname" placeholder="Enter your Lastname" class="box" required>
         <span>Address :</span>
         <input type="text" name="address" placeholder="Enter your Address" class="box" required>
         <span>your email :</span>
         <input type="email" name="email" placeholder="Enter your Email" class="box" required>
         <span>your number :</span>
         <input type="text" name="number" placeholder="Enter your Phone Number" class="box" required>
         <span>appointment date :</span>
         <input type="datetime-local" name="date" class="box" required>
         <input type="submit" value="make appointment" name="submit" class="link-btn">
      </form>

   </section>

   <!-- contact section ends -->

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

   <!-- footer section ends -->

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>