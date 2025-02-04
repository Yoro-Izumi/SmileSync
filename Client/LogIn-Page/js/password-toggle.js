        // JavaScript to toggle password visibility
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('signup-password');

        togglePassword.addEventListener('click', function () {
            // Toggle the input type
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Change icon based on visibility
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });