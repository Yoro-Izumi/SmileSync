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
    <div class="logo">MyWebsite</div>
    <nav class="nav-links">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </nav>
    <div class="hamburger" onclick="toggleMenu()">☰</div>
  </header>

  <script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        const hamburger = document.querySelector('.hamburger');

        // Toggle menu visibility
        navLinks.classList.toggle('active');  

        // Toggle hamburger icon between open and close styles
        hamburger.textContent = hamburger.textContent === "☰" ? "✖" : "☰";
    }
  </script>


  
  <div class="container">
    <h1>Mountain Star Zlatibor</h1>
    <p>Zlatibor is a mountain of exceptional beauty whose special geographical properties have made this mountain a real gem of western Serbia.</p>
    <a href="#">Learn more</a>
  </div>

  <div class="blank"></div>

  <div class="container">
    <h1>Mountain Star Zlatibor</h1>
    <p>Zlatibor is a mountain of exceptional beauty whose special geographical properties have made this mountain a real gem of western Serbia.</p>
    <a href="#">Learn more</a>
  </div>

  <div class="blank"></div>

  <div class="container second">
      <div class="card-container">
    <div class="item">
      <div class="img img-first"></div>
      <div class="card">
        <h3>Rock climbing</h3>
        <p>The goal is to reach the summit of a formation or the endpoint of a usually pre-defined route without falling</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    <div class="item">
      <div class="img img-second"></div>
      <div class="card">
        <h3>Caving</h3>
        <p>Exploring underground through networks of tunnels and passageways, which can be natural or artificial.</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    <div class="item">
      <div class="img img-third"></div>
      <div class="card">
        <h3>Parachuting</h3>
        <p>Jumping from an aeroplane and falling through the air before opening your parachute.</p>
        <a href="#">Learn more</a>
      </div>
    </div>
      </div>
      
    <div class="card-container">
    <div class="item">
      <div class="img img-first"></div>
      <div class="card">
        <h3>Rock climbing</h3>
        <p>The goal is to reach the summit of a formation or the endpoint of a usually pre-defined route without falling</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    <div class="item">
      <div class="img img-second"></div>
      <div class="card">
        <h3>Caving</h3>
        <p>Exploring underground through networks of tunnels and passageways, which can be natural or artificial.</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    <div class="item">
      <div class="img img-third"></div>
      <div class="card">
        <h3>Parachuting</h3>
        <p>Jumping from an aeroplane and falling through the air before opening your parachute.</p>
        <a href="#">Learn more</a>
      </div>
    </div>
  </div>

    <div class="card-container">
    <div class="item">
      <div class="img img-first"></div>
      <div class="card">
        <h3>Rock climbing</h3>
        <p>The goal is to reach the summit of a formation or the endpoint of a usually pre-defined route without falling</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    <div class="item">
      <div class="img img-second"></div>
      <div class="card">
        <h3>Caving</h3>
        <p>Exploring underground through networks of tunnels and passageways, which can be natural or artificial.</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    <div class="item">
      <div class="img img-third"></div>
      <div class="card">
        <h3>Parachuting</h3>
        <p>Jumping from an aeroplane and falling through the air before opening your parachute.</p>
        <a href="#">Learn more</a>
      </div>
    </div>
    </div>
    
  </div>

  <div class="blank"></div>
</body>
</html>
