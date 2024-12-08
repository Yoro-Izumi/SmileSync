<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Pager</title>
  <link rel="stylesheet" href="landing.css">
</head>
<body>
  
<header class="topbar">
    <div class="logo">SmileSync</div>
    <nav class="nav-links" id="navLinks">
        <a href="#">Home</a>
        <a href="#">Services</a>
        <a href="#">About Us</a>
    </nav>
    <a href="../LogIn-Page/Login-Page.php" class="login-link">Login</a>
    <div class="hamburger" onclick="toggleMenu()">
      &#9776;
    </div>
</header>


  <script>
function toggleMenu() {
  const menu = document.querySelector('navLinks');
  menu.classList.toggle('active');
}
  </script>


  
  <div class="container">
    <h1>Welcome!</h1>
    <p>Shcema</p>
    <a href="#">Get Started</a>
  </div>

  <!--div class="blank"></div-->


  <div class="containers">
  <h1>Services</h1>
    <p>
    We provide to you the best choiches for you.
    Adjust it to your health needs and make sure your undergo treatment with our highly qualified doctors you can consult with us which type of service is suitable for your health.
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

  <!--div class="blank"></div-->

  
  <div class="container">
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
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Reprehenderit maxime quas quisquam harum ab, nostrum sequi
                        ducimus dicta accusamus sint dolorum similique.
                    </p>
                    <ul>
                        <li>Professional dental care services.</li>
                        <li>Advanced teeth whitening treatments.</li>
                        <li>Customized braces and aligners.</li>
                        <li>Painless tooth extraction methods.</li>
                    </ul>

                    <a href="https://maps.app.goo.gl/uELgbafYaUNUAJn59">See Location</a>
                </div>
            </div>
        </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.12.8/jarallax.min.js"></script>

</body>
</html>
