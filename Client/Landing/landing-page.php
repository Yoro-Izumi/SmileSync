<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to SmileSync!</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include the Boxicons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!--Icon8's stylesheet -->
    <link href="https://cdn.icon8.com/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- landing page style -->
    <link rel="stylesheet" href="css/landing.css">

</head>
<body>
<?php include "modal.php" ?>
<?php include "chatbot.php"; ?>
<div class="container">
    <div class="logo">
        <img src="img/logo.png" alt="logo">
        <a href="landing-page.php">SmileSync</a>
    </div>
    <nav class="nav">
    <a href="#home"><i class='bx bx-home'></i>Home</a>
    <a href="#services"><i class='bx bx-briefcase-alt'></i>Services</a>
    <a href="#faq"><i class='bx bx-question-mark'></i>FAQ</a>
    <a href="#location"><i class='bx bx-map'></i>Location</a>
    <a href="../LogIn-Page/Login-Page.php" class="sign-up"><i class='bx bx-log-in'></i>Login</a>
</nav>
</div>

<div id="home" class="hero">
        <div class="text-content">
            <h1>Welcome<br>to<br>SmileSync!</h1>
            <p>
              We provide the best choiches for you.
              Adjust services to your health needs and make sure you undergo treatment with our highly qualified doctors.
              You can consult with us with which type of service is suitable for your health!
               </p>
            <button id="setAppointmentBtn" class="explore-button">Set Appointment</button>
        </div>
        <div class="illustration">
            <img src="img/dentist.png" alt="Delivery Illustration">
        </div>
    </div>

         
<section id="services" class="our-services">
  <div class="services-container">
    <div class="header">
      <h1>Services</h1>
      <p>
        We provide the best choices for you. Adjust services to your health needs and make sure you undergo treatment with our highly qualified doctors. 
        You can consult with us to determine which type of service is suitable for your health!
      </p>
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="icon"><i class="fa fa-tooth"></i></div> <!-- Example for Icon8 Tooth -->
        <h3>Oral Prophylaxis</h3>
        <p>Comprehensive teeth cleaning to maintain oral hygiene and prevent gum disease.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-cogs"></i></div> <!-- Example for Icon8 Tools (Restoration) -->
        <h3>Restoration LC/TF</h3>
        <p>Repair damaged or decayed teeth with durable and aesthetic restorative materials.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-cut"></i></div> <!-- Example for Icon8 Scissors (Extraction) -->
        <h3>Extraction</h3>
        <p>Safe and painless removal of problematic or decayed teeth.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-user-md"></i></div> <!-- Example for Icon8 Prosthodontics -->
        <h3>Prosthodontic</h3>
        <p>Custom-made dental prosthetics to restore missing teeth and enhance your smile.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-syringe"></i></div> <!-- Example for Surgery (Syringe) -->
        <h3>Surgery</h3>
        <p>Advanced surgical procedures for complex dental issues.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-heartbeat"></i></div> <!-- Example for Endodontics -->
        <h3>Endodontics</h3>
        <p>Root canal treatments to save infected or damaged teeth.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-braces"></i></div> <!-- Example for Orthodontics (Braces) -->
        <h3>Orthodontics</h3>
        <p>Align and straighten your teeth for a healthy, beautiful smile.</p>
      </div>
      <div class="service-card">
        <div class="icon"><i class="fa fa-x-ray"></i></div> <!-- Example for X-Ray -->
        <h3>X-Ray</h3>
        <p>Accurate dental imaging for diagnosis and treatment planning.</p>
      </div>
    </div>
  </div>
</section>

             
 
    <!-- FAQ Section -->
<section id="faq" class="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3>What is a SmileSync? <span>+</span></h3>
            <p>
              SmileSYnc is a Appointment System.
            </p>
        </div>
        <div class="faq-item">
            <h3>Is SmileSync part of iMeeToga Clinic?<span>+</span></h3>
            <p>
              SmileSync is the Appointment website of iMeeToga Clinic.
            </p>
        </div>
        <div class="faq-item">
            <h3>What is the use our chatbot? <span>+</span></h3>
            <p>
              Our Chatbot answers all the faq that you need to know from SmileSync!
            </p>
        </div>
    </section>
              
<section id="location" class="about-us">
      <div class="header">
     <h1>Location</h1>
    <p>
    You can find us in the location pinned below or contact us with the phone number below for more inquiries.
  </p>
    </div>
  <div class="box">
            <div class="location-container">
                <div class="imgBx jarallax">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1933.6529161045416!2d121.13307193878107!3d14.235373196402385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6244b8389b1f%3A0x359cbb8439a3f55!2sImee%20Toga%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1731916152676!5m2!1sen!2sph" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="content" data-jarallax-element="-200 0">
                    <p>
                       We offer professional dental care services,
                        including advanced teeth whitening treatments to brighten your smile. Our clinic specializes in customized braces and aligners for a perfect fit and alignment,
                         along with painless tooth extraction methods to ensure your comfort.
                    </p>
                    <ul> 
                        <li>Address: #53 Banlic, Cabuyao, Calabarzon, Philippines, Cabuyao, Philippines</li>
                        <li>Number: 0917 587 4263</li>
                        <li>Usual Time: 9:00 AM : 5:00 PM</li>
                    </ul>

                    <a href="https://maps.app.goo.gl/uELgbafYaUNUAJn59">See Location</a>
                </div>
            </div>
        </div>
              </section>     
     
              

<footer>
    <div style="margin: 20px 0;">
        <a href="#" style="margin: 0 10px; color: var(--color);"><i class="bx bxl-facebook-circle" alt="FB" style="font-size: 24px;"></i></a>
        <a href="#" style="margin: 0 10px; color: var(--color)"><i class="bx bxl-instagram" style="font-size: 24px;"></i></a>
        <a href="#" style="margin: 0 10px; color: var(--color)"><i class="bx bxl-twitter" style="font-size: 24px;"></i></a>
    </div>
    <p>&copy; 2024 SmileSync. All rights reserved.</p>
</footer>
              
    <script>
        // FAQ Toggle Functionality
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    </script>             
</body>
</html>