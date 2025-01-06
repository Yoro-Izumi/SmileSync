<?php
include "../../admin_global_files/set_sesssion_dir.php";

session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";

// Database connections
$connect_appointment = connect_appointment($servername, $username, $password);
$connect_inventory = connect_inventory($servername, $username, $password);

$appointmentID = isset($_SESSION['session_appointment_id']) ? $_SESSION['session_appointment_id'] : 2;

// Fetch all products
$query = "SELECT item_id, item_name, item_description, item_quantity, item_unit_price, expiry_date, item_status 
          FROM smilesync_inventory_items";

$result = $connect_inventory->query($query);

$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['item_id'],
            'item_name' => htmlspecialchars($row['item_name']), // Escape HTML entities
            'item_quantity' => htmlspecialchars($row['item_quantity']), // Escape HTML entities
        ];
    }
}

// Generate HTML
foreach ($products as $product) {
    $id = $product['id'];
    $item_name = $product['item_name'];
    $consumed = getConsumedProducts($connect_appointment, $appointmentID, $id);
    $item_quantity = $product['item_quantity'] - $consumed;

    echo '<div class="dropDownItem">
        <input type="checkbox" class="checkBoxItems" value="' . $id . '" data-name="' . $item_name . '" name="itemCheck[]">
        ' . $item_name . '
        <input type="number" value="' . $consumed . '" min="1" max="'.$item_quantity.'" class="number-input" data-id="' . $id . '" aria-label="Quantity for ' . $item_name . '" name="itemQuantity[]">
    </div>';
}

// Close connections
$connect_appointment->close();
$connect_inventory->close();

// Fetch consumed products for a specific appointment
function getConsumedProducts($connect_appointment, $appointmentID, $itemID) {
    $query = "
                SELECT sii.item_id, SUM(sii.number_of_used_items) AS total_used_items
                FROM smilesync_invoice_items sii
                INNER JOIN smilesync_invoice_services sis ON sii.invoice_services_id = sis.invoice_services_id
                WHERE sis.appointment_id = ? AND sii.item_id = ?
                GROUP BY sii.item_id";


    $stmt = $connect_appointment->prepare($query);
    if (!$stmt) {
        return 0; // Return 0 if statement preparation fails
    }

    $stmt->bind_param("ii", $appointmentID, $itemID);
    $stmt->execute();
    $result = $stmt->get_result();

    $quantity = 0;
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quantity = $row['total_used_items'];
        }
    }

    $stmt->close(); // Close the statement
    return $quantity;
}
?>

