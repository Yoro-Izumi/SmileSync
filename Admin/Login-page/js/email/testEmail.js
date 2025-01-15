const axios = require("axios");
const nodemailer = require("nodemailer");

const email = process.env.EMAIL || "yoroizumi@gmail.com"; // Default email

console.log("Email to be sent:", email); // Debugging

const resetLink = `http://smilesync.site/SmileSync/Client/Forgot%20Password/forgotPassword-page.php?email=${encodeURIComponent(email)}`;

// Email content
const emailContent = `
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #6A5ACD, #4682B4); text-align: center; color: white; padding: 20px;">
        <tr>
            <td>
                <h1 style="font-size: 24px; margin: 0;">Reset Your Password</h1>
                <p style="font-size: 16px; margin: 10px 0;">We received a request to reset your SmileSync password. Click the button below to set a new password:</p>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 10px; margin: -40px auto 20px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td align="center" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
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
`;

// Configure nodemailer
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'smilesyncco@gmail.com', // Your email
        pass: 'nyks nagm psxp abzv', // App password from Google
    },
});

// Send the email
async function sendEmail() {
    try {
        const info = await transporter.sendMail({
            from: '"SmileSync.site" smilesyncco@gmail.com', // Replace with your sender email
            to: email,
            subject: "Forget Password Link",
            html: emailContent,
        });

        console.log("Email sent successfully:", info.messageId);
    } catch (error) {
        console.error("Error sending email:", error.message);
    }
}

// Send API call
async function sendApiRequest() {
    try {
        const response = await axios.post("http://localhost:3000/send-email", {
            to: email,
            subject: "Forget Password Link",
            html: emailContent,
        });

        if (response.status === 200) {
            console.log("API call success: Email sent successfully!");
        } else {
            console.error("API call failed. Status:", response.status);
        }
    } catch (error) {
        console.error("API call error:", error.message);
    }
}

// Uncomment one of these to use
 sendEmail();
 //sendApiRequest();
