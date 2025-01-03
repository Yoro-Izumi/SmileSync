<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to SmileSync</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png">
  <link rel="stylesheet" href="landing.css">
</head>
<body>

<header class="topbar">
<div class="logo">
             <img src="img/logo.png" alt="SmileSync">
             SmileSync
           </div>
  <nav class="nav-links" id="navLinks">
    <a onclick="Welcome">Home</a>
    <a onclick="Services">Services</a>
    <a onclick="About">About Us</a>
  </nav>
  <a href="../LogIn-Page/Login-Page.php" class="login-link">Login</a>
  <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
</header>

<script>
  function toggleMenu() {
    const menu = document.getElementById('navLinks');
    menu.classList.toggle('active');
  }
</script>

<div id="Welcome" class="container">
<!--div class="dust-container dust-container-1"></div>
<div class="dust-container dust-container-2">   </div-->
      <div class="first-box">
       <figure></figure>
      <h1>Welcome to SmileSync!</h1>
      <p>
        Discover a brighter, healthier smile with SmileSync. We are dedicated to providing exceptional dental care services tailored to your needs.
      </p>
      <p>For our new patients, get an appointment now by going to our appointment page below.</p>
      <a href="../Register/Register-Page.php">Get an Appointment</a>
</div>
 
</div>
  <div class="blank"></div><!---->


  <div id="Services" class="container split">
  <h1>Services</h1>
    <p>
    We provide the best choiches for you.
    Adjust services to your health needs and make sure you undergo treatment with our highly qualified doctors.
    You can consult with us with which type of service is suitable for your health!
  </p>

  <div class="card-container">
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Oral Prophylaxis</h3>
        <p>
        Comprehensive teeth cleaning to maintain oral hygiene and prevent gum disease.
        </p>
      </div>
    </div>
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Restoration LC/TF</h3>
        <p>
        Repair damaged or decayed teeth with durable and aesthetic restorative materials
        </p>
      </div>
    </div>
      </div>

      <div class="card-container">
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Extraction</h3>
        <p>
        Safe and painless removal of problematic or decayed teeth.
        </p>
      </div>
    </div>
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Prosthodontic </h3>
        <p>
        Custom-made dental prosthetics to restore missing teeth and enhance your smile.
        </p>
      </div>
    </div>
      </div>

    <div class="card-container">
      <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Surgery</h3>
        <p>
        Advanced surgical procedures for complex dental issues.
        </p>
      </div>
    </div>
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Endodontics</h3>
        <p>
        Root canal treatments to save infected or damaged teeth
        </p>
      </div>
    </div>
      </div>

  <div class="card-container">
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>Orthodontics</h3>
        <p>
        Align and straighten your teeth for a healthy, beautiful smile
        </p>
      </div>
    </div>
    <div class="item">
      <div class="img"></div>
      <div class="card">
        <h3>X-Ray</h3>
        <p>
        Accurate dental imaging for diagnosis and treatment planning
        </p>
      </div>
    </div>
      </div>
    
  </div>

  <div class="blank"></div><!---->

  
  <div id="About" class="container">
  <h1>About Us</h1>
    <p>
    You can find us in the location pinned below or contact us with the phone number below for more inquiries.
  </p>


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
  </div>

  <footer>
    <h4>&copy; 2024 SmileSync. All rights reserved.</h4>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.12.8/jarallax.min.js"></script>

    <script>
        const dustContainer1 = document.querySelector('.dust-container-1');
        const dustContainer2 = document.querySelector('.dust-container-2');
        const numDustParticles = 100; // Number of dust particles

        // Function to create a single dust particle
        function createDust(container) {
            const dust = document.createElement('div');
            dust.classList.add('dust');
            dust.style.left = `${Math.random() * 100}%`;
            dust.style.top = `${Math.random() * 100}%`;
            container.appendChild(dust);
        }

        // Create multiple dust particles for each container
        for (let i = 0; i < numDustParticles; i++) {
            createDust(dustContainer1);
            createDust(dustContainer2);
        }

        // Parallax effect on scroll
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            dustContainer1.style.transform = `translate(0, ${scrollY * 0.05}px)`; // Dust moves slower
            dustContainer2.style.transform = `translate(0, ${scrollY * 0.1}px)`; // Dust moves faster
        });
    </script>
</body>
</html>
