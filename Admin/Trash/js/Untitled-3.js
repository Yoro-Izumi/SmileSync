 <script>
    // For password toggle
    document.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.querySelector(".toggle-password");
        const passwordInput = document.querySelector("#floatingPassword");
        const eyeIcon = togglePassword.querySelector("i");

        // Function to show password
        function showPassword() {
            passwordInput.setAttribute("type", "text");
            eyeIcon.classList.add("fa-eye-slash");
            eyeIcon.classList.remove("fa-eye");
        }

        // Function to hide password
        function hidePassword() {
            passwordInput.setAttribute("type", "password");
            eyeIcon.classList.add("fa-eye");
            eyeIcon.classList.remove("fa-eye-slash");
        }

        // Event listeners for mouse and touch events
        togglePassword.addEventListener("mousedown", showPassword);
        togglePassword.addEventListener("mouseup", hidePassword);
        togglePassword.addEventListener("mouseleave", hidePassword);
        togglePassword.addEventListener("touchstart", showPassword);
        togglePassword.addEventListener("touchend", hidePassword);

        // Prevent touchend from triggering mouseup
        togglePassword.addEventListener("touchcancel", hidePassword);
    });
