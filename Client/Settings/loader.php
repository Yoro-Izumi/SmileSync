<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General Styling */
    .loader {
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #fff;
      font-family: Arial, sans-serif;
      overflow: hidden;
    }

    /* Loading Container */
    .loading-container {
      background-color: #fff;
      text-align: center;
    }

    .loading-container.hidden {
      display: none;
    }

    /* Main Content */
    #body-container {
      display: none;
    }

    #body-container.visible {
      display: block;
    }

    /* Error Page Styling */
    .error-page {
      background-color: #fff;
      display: none;
      text-align: center;
    }

    .error-page.visible {
      display: block;
    }

    .error-page h1 {
      color: #03253A;
      font-size: 24px;
      font-weight: bold;
    }

    .error-page p {
      color: #03253A;
      font-size: 18px;
    }

    .error-image {
      width: 25vw;
      height: 50vh;
      margin: 20px auto;
    }

    .reload-button {
      margin-top: 20px;
      padding: 10px 20px;
      font-size: 16px;
      color: white;
      background-color: #03253A;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    .reload-button:hover {
      background-color: #021F2B;
    }

    .loading-logo {
      width: 5vw;
      height: 10vh;
      margin: 0 auto;
      animation: bounce 1.5s infinite ease-in-out;
    }

    .loading-text {
      margin-top: 20px;
      font-size: 18px;
      color: #03253A;
      font-weight: bold;
      animation: fade 5s infinite;
    }

    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-20px);
      }
    }

    @keyframes fade {
      0%, 100% {
        opacity: 0;
      }
      50% {
        opacity: 1;
      }
    }
  </style>
</head>
<div class="loader" id="loader">
  <!-- Loading Container -->
  <div class="loading-container" id="loading-container">
    <img src="img/logo.png" alt="Logo" class="loading-logo">
    <div class="loading-text" id="loading-text">Loading...</div>
  </div>

  <!-- Error Page -->
  <div class="error-page" id="error-page">
    <img src="img/404.png" alt="Error" class="error-image">
    <h1>Error: Something went wrong!</h1>
    <p>We couldn't load the page. Please try again later.</p>
    <button class="reload-button" onclick="reloadPage()">Try Again</button>
  </div>

  <script>
    // Randomized Teeth Facts
    const teethFacts = [
      "Your teeth are as unique as your fingerprints!",
      "The enamel on your teeth is the hardest substance in your body.",
      "Adults typically have 32 teeth, including wisdom teeth.",
      "Smiling can actually boost your immune system!",
      "Brushing too hard can damage your enamel.",
      "Flossing helps remove plaque where your toothbrush can't reach.",
      "Your teeth start forming before you're born.",
      "Saliva helps protect your teeth from decay.",
      "Did you know? Teeth are not bones—they don't regenerate.",
      "Chewing sugar-free gum can help keep your teeth clean."
    ];

    // Function to Randomize Text
    function randomizeText() {
      const textElement = document.getElementById("loading-text");
      const randomFact = teethFacts[Math.floor(Math.random() * teethFacts.length)];
      textElement.textContent = randomFact;
    }

    // Change Text Every 5 Seconds
    setInterval(randomizeText, 5000);
    randomizeText();

// Function to show the main content and hide the loading container
function showMainContent() {
  const loader = document.getElementById("loader");
  // Hide the loading container
  loader.style.display = "none";

  document.getElementById("loading-container").classList.add("hidden");
  document.getElementById("body-container").classList.add("visible");
}

// Set a timer for the loading screen (e.g., 5 seconds)
setTimeout(showMainContent, 5000); // 5000 ms = 5 seconds


    // Show Error Page
    function showErrorPage() {
      document.getElementById("loading-container").classList.add("hidden");
      document.getElementById("error-page").classList.add("visible");
    }

    // Function to reload the page
    function reloadPage() {
      location.reload();
    }

  /*   // Simulate a delay for loading
    try {
      setTimeout(() => {
        // Simulate success
        if (Math.random() < 0.7) {
          showMainContent();
        } else {
          throw new Error("Simulated network error");
        }
      }, 10000); // Delay of 10 seconds
    } catch (error) {
      console.error(error);
      showErrorPage();
    }

    // Global error handling
   window.onerror = function () {
      showErrorPage();
    }; */
  </script>
</div>
</html>
