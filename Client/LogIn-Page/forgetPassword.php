<?php
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/SmileSync';
require_once $root_dir . '/vendor/autoload.php';

use GuzzleHttp\Client;

// Get email from POST data, default to "yoroizumi@gmail.com"
$email = isset($_POST['email']) ? $_POST['email'] : "kazumiyoro29@gmail.com";

// Debugging - Check if email is captured correctly
echo "Email to be sent: " . $email;  // This will help you see the email value

// Reset link
$resetLink = "http://localhost/SmileSync/Client/Forgot%20Password/forgotPassword-page.php?email=" . urlencode($email);

// Prepare email content
$client = new Client();
$data = [
    'to' => $email,
    'subject' => 'Forget Password Link',
    'html' => "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reset Password</title>
    </head>
    <body style='margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center;'>
        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background: linear-gradient(135deg, #6A5ACD, #4682B4); text-align: center; color: white; padding: 20px;'>
            <tr>
                <td>
                    <h1 style='font-size: 24px; margin: 0;'>Reset Your Password</h1>
                    <p style='font-size: 16px; margin: 10px 0;'>We received a request to reset your SmileSync password. Click the button below to set a new password:</p>
                </td>
            </tr>
        </table>
        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin: 0 auto; padding: 20px;'>
            <tr>
                <td align='center'>
                    <table width='600' cellpadding='0' cellspacing='0' border='0' style='background-color: #ffffff; border-radius: 10px; margin: -40px auto 20px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);'>
                        <tr>
                            <td align='center' style='background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);'>
                                <table width='100' height='100' cellpadding='0' cellspacing='0' border='0' style='background-color: #ffffff; border-radius: 50%; margin: 0 auto; border: 2px solid #6A5ACD;'>
                                    <tr>
                                        <td align='center' style='font-size: 24px; color: #6A5ACD; line-height: 100px;'>🔒</td>
                                    </tr>
                                </table>
                                <h2 style='font-size: 20px; color: #4682B4; margin: 20px 0 10px;'>Set a New Password</h2>
                                <p style='font-size: 14px; color: #333333; margin: 0 0 20px;'>Click the button below to reset your password. If you didn't request this, please ignore this email.</p>
                                <a href='$resetLink' style='display: inline-block; padding: 12px 20px; background-color: #4682B4; color: #ffffff; text-decoration: none; border-radius: 25px; font-size: 16px; font-weight: bold;'>Reset Password</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='text-align: center; padding: 20px; background-color: #f0f8ff; color: #777777;'>
            <tr>
                <td>
                    <p style='font-size: 12px; margin: 0;'>&copy; 2024 SmileSync. All rights reserved.</p>
                    <p style='font-size: 12px; margin: 0;'><a href='#' style='color: #4682B4; text-decoration: none;'>Privacy Policy</a> | <a href='#' style='color: #4682B4; text-decoration: none;'>Terms of Service</a></p>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ",
];

try {
    // Log the data to verify the payload
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    // Send email using Guzzle HTTP client
    $response = $client->post('http://localhost:3000/send-email', [
        'json' => $data,
    ]);

    // Check if the request was successful
    if ($response->getStatusCode() === 200) {
        echo "success: Email sent successfully!";
    } else {
        echo "error: Failed to send email. Status: " . $response->getStatusCode();
    }
} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo "Request Error: " . $e->getMessage();
    if ($e->hasResponse()) {
        echo "<br>Response: " . $e->getResponse()->getBody();
    }
}
?>
