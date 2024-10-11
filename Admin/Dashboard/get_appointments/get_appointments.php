<?php
if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'username', 'password', 'smilesync_appointments');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to fetch appointments for the specific date (match only the date part from the datetime column)
    $sql = "SELECT id, name, TIME_FORMAT(time, '%h:%i %p') as time FROM appointments WHERE DATE(date) = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $date);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }

        // Return the appointments in JSON format
        echo json_encode($appointments);

        // Close statement and connection
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
