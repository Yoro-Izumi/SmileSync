<?php
session_start();
include "../admin_global_files/connect_db.php";
$connect_appointment = connect_appointment($servername,$username,$password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $joined_date = mysqli_real_escape_string($conn, $_POST['joined_date']);

    $query = "INSERT INTO members (name, email, joined_date) VALUES ('$name', '$email', '$joined_date')";

    if (mysqli_query($conn, $query)) {
        echo "Member added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
