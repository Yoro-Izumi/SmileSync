<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - SmileSync</title>
    <script>
        function getEmailFromUrl() {
            const params = new URLSearchParams(window.location.search);
            return params.get("email");
        }

        document.addEventListener("DOMContentLoaded", () => {
            const email = getEmailFromUrl();
            if (email) {
                document.getElementById("user-email").textContent = email;
            }
        });
    </script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6A5ACD, #4682B4);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            color: #333333;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #6A5ACD;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
            color: #6A5ACD;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            outline: none;
            border-color: #6A5ACD;
        }
        .form-group .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6A5ACD, #4682B4);
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background: linear-gradient(135deg, #7B68EE, #5A9BD4);
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777777;
        }
        #success-message {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container" id="password-form">
        <h1>Change Your Password</h1>
        <p>Reset password for</p>
        <p id="user-email" style="font-weight: bold; color: #4682B4;"></p>
        <form id="change-password-form">
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new-password" placeholder="Enter your new password" required>
                <div id="new-password-error" class="error"></div>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your new password" required>
                <div id="confirm-password-error" class="error"></div>
            </div>
            <button type="submit" class="submit-btn">Reset Password</button>
        </form>
    </div>

    <div class="container" id="success-message">
        <h1>Congratulations!</h1>
        <p>Your password has been successfully changed.</p>
        <button onclick="window.location.href='http://localhost/SmileSync/Admin/Login-page/Login_Register-page.php'" class="submit-btn">
            Go Back to Login
        </button>
    </div>

    <script>
        document.getElementById('change-password-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const newPassword = document.getElementById('new-password').value.trim();
            const confirmPassword = document.getElementById('confirm-password').value.trim();
            const newPasswordError = document.getElementById('new-password-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');

            newPasswordError.textContent = '';
            confirmPasswordError.textContent = '';

            let hasError = false;

            if (newPassword.length < 8) {
                newPasswordError.textContent = 'Password must be at least 8 characters long.';
                hasError = true;
            }

            if (newPassword !== confirmPassword) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                hasError = true;
            }

            if (!hasError) {
                // Show success message
                document.getElementById('password-form').style.display = 'none';
                document.getElementById('success-message').style.display = 'block';
            }
        });
    </script>
</body>
</html>
