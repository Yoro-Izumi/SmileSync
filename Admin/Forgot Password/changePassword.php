<?php
// Include database connection and decryption function
include "../client_global_files/connect_database.php"; 
include "../client_global_files/encrypt_decrypt.php";  // Make sure this file contains the decryptData function

// Ensure the data is being sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $newPassword = isset($_POST['new-password']) ? trim($_POST['new-password']) : '';
    $inputEmail = isset($_POST['email']) ? trim($_POST['email']) : '';  // Get the email from the input

    // Validate the input (email and password)
    if (empty($newPassword) || strlen($newPassword) < 8) {
        echo "error:Password must be at least 8 characters long.";
        exit;
    }

    if (empty($inputEmail)) {
        echo "error:Email address is required.";
        exit;
    }

    // Query the database for the encrypted email
    $sql = "SELECT `admin_account_email` FROM `smilesync_admin_accounts`";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->store_result();

        // Check if any record is found
        if ($stmt->num_rows > 0) {
            // Fetch the encrypted email from the database
            $stmt->bind_result($encryptedEmail);
            $stmt->fetch();

            // Decrypt the email from the database
            $decryptedEmail = decryptData($encryptedEmail,$key);  // Assuming decryptData function is defined in encrypt_decrypt.php

            // Compare the decrypted email with the input email
            if ($decryptedEmail !== $inputEmail) {
                echo "error:Email does not match the stored record.";
                exit;
            }
        } else {
            echo "error:No account found with that email address.";
            exit;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "error:Failed to prepare the query.";
        exit;
    }

    // Password hashing with Argon2i
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2I, $options);

    // Prepare the SQL query to update the password
    $sql = "UPDATE `smilesync_admin_accounts` SET `patient_admin_password` = ? WHERE `patient_admin_email` = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the SQL query
        $stmt->bind_param("ss", $hashedPassword, $inputEmail);

        // Execute the query
        if ($stmt->execute()) {
            echo "success:Password updated successfully!";
        } else {
            echo "error:Failed to update password.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "error:Failed to prepare the query.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "error:Invalid request method.";
}
?>
