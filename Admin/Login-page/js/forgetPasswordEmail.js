/*const nodemailer = require("nodemailer");

// Configure the transporter
const transporter = nodemailer.createTransport({
    service: "gmail",
    auth: {
        user: "smilesyncco@gmail.com", // Your email
        pass: "nyks nagm psxp abzv", // App password from Google
    },
});

// Function to send reset password email
function sendResetPasswordEmail(toEmail) {
    const resetLink = `http://localhost/SmileSync/Admin/Forgot%20Password/forgotPassword-page.php?email=${encodeURIComponent(toEmail)}`;

    const mailOptions = {
        from: "smilesyncco@gmail.com",
        to: toEmail,
        subject: "Reset Your SmileSync Password",
    html: `

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center;">
    <!-- Landing Page Background -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #6A5ACD, #4682B4); text-align: center; color: white; padding: 20px;">
        <tr>
            <td>
                <h1 style="font-size: 24px; margin: 0;">Reset Your Password</h1>
                <p style="font-size: 16px; margin: 10px 0;">We received a request to reset your SmileSync password. Click the button below to set a new password:</p>
            </td>
        </tr>
    </table>
    <!-- Floating Email Container -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 10px; margin: -40px auto 20px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td align="center" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
                            <!-- Reset Icon -->
                            <table width="100" height="100" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 50%; margin: 0 auto; border: 2px solid #6A5ACD;">
                                <tr>
                                    <td align="center" style="font-size: 24px; color: #6A5ACD; line-height: 100px;">🔒</td>
                                </tr>
                            </table>
                            <h2 style="font-size: 20px; color: #4682B4; margin: 20px 0 10px;">Set a New Password</h2>
                            <p style="font-size: 14px; color: #333333; margin: 0 0 20px;">Click the button below to reset your password. If you didn't request this, please ignore this email.</p>
                            <a href="${resetLink}" style="display: inline-block; padding: 12px 20px; background-color: #4682B4; color: #ffffff; text-decoration: none; border-radius: 25px; font-size: 16px; font-weight: bold;">Reset Password</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- Footer Section -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="text-align: center; padding: 20px; background-color: #f0f8ff; color: #777777;">
        <tr>
            <td>
                <p style="font-size: 12px; margin: 0;">&copy; 2024 SmileSync. All rights reserved.</p>
                <p style="font-size: 12px; margin: 0;"><a href="#" style="color: #4682B4; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: #4682B4; text-decoration: none;">Terms of Service</a></p>
            </td>
        </tr>
    </table>
</body>
</html>


        `,
};


        transporter.sendMail(mailOptions, (error, info) => {
            if (error) {
                return console.error("Error:", error);
            }
            console.log(`Email sent to ${toEmail}:`, info.response);
        });
    }

    // Example usage
    sendResetPasswordEmail("kazumiyoro29@gmail.com");


*/





    const express = require('express');
    const bodyParser = require('body-parser');
    const nodemailer = require('nodemailer');
    
    const app = express();
    const PORT = 80;
    
    // Middleware
    app.use(bodyParser.json());
    app.use(bodyParser.urlencoded({ extended: true }));
    
    // Endpoint to send email
    app.post('/send-email', (req, res) => {
      const { to } = req.body;
    
// Configure the transporter
const transporter = nodemailer.createTransport({
    service: "gmail",
    auth: {
        user: "smilesyncco@gmail.com", // Your email
        pass: "nyks nagm psxp abzv", // App password from Google
    },
});
    
      // Email options
      const mailOptions = {
        from: 'smilesyncco@gmail.com',
        to : 'kazumiyoro29@gmail.com',
        subject: "Reset Your SmileSync Password",
        html: `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center;">
            <!-- Landing Page Background -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #6A5ACD, #4682B4); text-align: center; color: white; padding: 20px;">
                <tr>
                    <td>
                        <h1 style="font-size: 24px; margin: 0;">Reset Your Password</h1>
                        <p style="font-size: 16px; margin: 10px 0;">We received a request to reset your SmileSync password. Click the button below to set a new password:</p>
                    </td>
                </tr>
            </table>
            <!-- Floating Email Container -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; padding: 20px;">
                <tr>
                    <td align="center">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 10px; margin: -40px auto 20px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                            <tr>
                                <td align="center" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
                                    <!-- Reset Icon -->
                                    <table width="100" height="100" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 50%; margin: 0 auto; border: 2px solid #6A5ACD;">
                                        <tr>
                                            <td align="center" style="font-size: 24px; color: #6A5ACD; line-height: 100px;">🔒</td>
                                        </tr>
                                    </table>
                                    <h2 style="font-size: 20px; color: #4682B4; margin: 20px 0 10px;">Set a New Password</h2>
                                    <p style="font-size: 14px; color: #333333; margin: 0 0 20px;">Click the button below to reset your password. If you didn't request this, please ignore this email.</p>
                                    <a href="${resetLink}" style="display: inline-block; padding: 12px 20px; background-color: #4682B4; color: #ffffff; text-decoration: none; border-radius: 25px; font-size: 16px; font-weight: bold;">Reset Password</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- Footer Section -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="text-align: center; padding: 20px; background-color: #f0f8ff; color: #777777;">
                <tr>
                    <td>
                        <p style="font-size: 12px; margin: 0;">&copy; 2024 SmileSync. All rights reserved.</p>
                        <p style="font-size: 12px; margin: 0;"><a href="#" style="color: #4682B4; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: #4682B4; text-decoration: none;">Terms of Service</a></p>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        
        
                `,
        };

      
    
      // Send the email
      transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
          console.log(error);
          res.status(500).json({ status: 'error', message: error.message });
        } else {
          console.log('Email sent:', info.response);
          res.status(200).json({ status: 'success', message: 'Email sent successfully!' });
        }
      });
    });
    
    app.listen(PORT, () => console.log(`Server running on http://localhost:${PORT}`));
    