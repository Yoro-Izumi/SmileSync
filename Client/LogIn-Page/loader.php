<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen</title>
    <style>
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffff;
            z-index: 1000; /* Ensure it overlays on top */
            opacity: 1; /* Initial opacity */
            transition: opacity 0.5s ease; /* Smooth fade-out transition */
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .spinner {
            animation: rotate 1s linear infinite;
            background: #03253A; /* Spinner color */
            border-radius: 50%; /* Ensure it's round */
            height: 120px; /* Increased size for roundness */
            width: 120px; /* Increased size for roundness */
            position: relative;
        }

        .spinner::before,
        .spinner::after {
            content: '';
            position: absolute;
        }

        .spinner::before {
            border-radius: 50%;
            background:
                linear-gradient(0deg,   hsla(0, 0%, 100%, 1) 50%, hsla(0, 0%, 100%, 0.9) 100%)   0%   0%,
                linear-gradient(90deg,  hsla(0, 0%, 100%, 0.9)  0%, hsla(0, 0%, 100%, 0.6) 100%) 100%   0%,
                linear-gradient(180deg, hsla(0, 0%, 100%, 0.6)  0%, hsla(0, 0%, 100%, 0.3) 100%) 100% 100%,
                linear-gradient(360deg, hsla(0, 0%, 100%, 0.3)  0%, hsla(0, 0%, 100%, 0) 100%)   0% 100%;
            background-repeat: no-repeat;
            background-size: 50% 50%;
            top: -1px;
            bottom: -1px;
            left: -1px;
            right: -1px;
        }

        .spinner::after {
            background: white;
            border-radius: 50%;
            top: 10%; /* Adjusted for smaller size */
            bottom: 10%; /* Adjusted for smaller size */
            left: 10%; /* Adjusted for smaller size */
            right: 10%; /* Adjusted for smaller size */
        }

        .spinner img {
            text-align: center;
            position: absolute;
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust position to center */
            width: 40px; /* Size of the image */
            height: 40px; /* Size of the image */
        }
    </style>
</head>
<body>
    <div class="loading-screen" id="loading-screen">
        <div class="spinner">
            <img src="img/logo.png" alt="Loading..."> <!-- Replace with your image URL -->
        </div>
    </div>

    <script>
        // Function to hide the loading screen with fade-out effect after 3 seconds
        setTimeout(() => {
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0'; // Start fade-out
            // Wait for the transition to complete before setting display to none
            setTimeout(() => {
                loadingScreen.style.display = 'none'; // Hide loading screen
            }, 500); // Match this duration with the CSS transition duration
        }, 500); 
    </script>
</body>
</html>
