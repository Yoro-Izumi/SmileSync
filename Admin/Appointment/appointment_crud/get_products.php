<?php
include ".../../admin_global_files/set_sesssion_dir.php";

session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";
// Database connection

$connect_appointment = connect_appointment($servername, $username, $password);
$connect_inventory = connect_inventory($servername, $username, $password);

// Check connection
if ($connect_inventory->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch all products
function getProducts($connect_inventory) {
    $query = "SELECT item_id, item_name, item_description, item_quantity, item_unit_price, expiry_date, item_status 
              FROM smilesync_inventory_items";

    $result = $connect_inventory->query($query);

    if ($result && $result->num_rows > 0) {
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = [
                'id' => $row['item_id'],
                'name' => $row['item_name'],
                'description' => $row['item_description'],
                'quantity' => $row['item_quantity'],
                'price' => $row['item_unit_price'],
                'expiry_date' => $row['expiry_date'],
                'status' => $row['item_status']
            ];
        }
        echo json_encode($products);
    } else {
        echo json_encode([]);
    }
}

// Fetch consumed products for a specific appointment
function getConsumedProducts($connect_appointment, $appointmentID) {
    $query = "
        SELECT sii.item_id, sii.number_of_used_items 
        FROM smilesync_invoice_items sii
        INNER JOIN smilesync_invoice_services sis ON sii.invoice_services_id = sis.invoice_services_id
        WHERE sis.appointment_id = ?";

    $stmt = $connect_appointment->prepare($query);
    $stmt->bind_param("i", $appointmentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $consumedProducts = [];
        while ($row = $result->fetch_assoc()) {
            $consumedProducts[] = [
                'product_id' => $row['item_id'],
                'quantity' => $row['number_of_used_items']
            ];
        }
        echo json_encode($consumedProducts);
    } else {
        echo json_encode([]);
    }
}

/* Route to handle AJAX requests */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'getProducts') {
            getProducts($connect_inventory);
        } elseif ($_GET['action'] === 'getConsumedProducts' && isset($_GET['appointmentID'])) {
            $appointmentID = intval($_GET['appointmentID']);
            getConsumedProducts($connect_appointment, $appointmentID);
        } else {
            echo json_encode(['error' => 'Invalid action or missing parameters']);
        }
    } else {
        echo json_encode(['error' => 'No action specified']);
    }
}


// Close connection
$connect_appointment->close();
$connect_inventory->close();
?>
