<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'your_database';
$username = 'your_username';
$password = 'your_password';

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch appointment datetime and service duration
$query = "
    SELECT 
        a.appointment_date AS appointment_datetime, 
        i.service_duration AS service_duration
    FROM 
        invoice_services i
    INNER JOIN 
        appointments a ON i.appointment_id = a.id
";

// Execute the query
$result = mysqli_query($conn, $query);

// Initialize an array to store the reservations
$reservations = [];

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the results
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = [
            'start_time' => $row['appointment_datetime'],
            'duration' => $row['service_duration'],
        ];
    }
}

// Close the database connection
mysqli_close($conn);

// Output the reservations in JSON format for use in Python
echo json_encode($reservations);
?>
