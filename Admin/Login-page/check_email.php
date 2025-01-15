<?php
header('Content-Type: application/json');

// Include your decryption function file
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";

$conn = connect_accounts($servername,$username,$password);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Get email from POST request
$email = isset($_POST['email']) ? $_POST['email'] : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
    exit;
}

// Query to fetch all encrypted emails
$sql = "SELECT admin_account_id, admin_email FROM smilesync_admin_accounts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $email_found = false;

    while ($row = $result->fetch_assoc()) {
        $decrypted_email = decryptData($row['admin_email'],$key); // Decrypt stored email

        if ($decrypted_email === $email) {
            $email_found = true;
            break;
        }
    }

    if ($email_found) {
        echo json_encode(['status' => 'success', 'message' => 'Email exists']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No users found in the database']);
}

$conn->close();
?>