<?php
// Start session and set timezone
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";

$current_date = date("Y-m-d");

// Step 1: Connect to the database
$connect_inventory = connect_inventory($servername, $username, $password);
$connect_accounts = connect_accounts($servername, $username, $password);

if (!$connect_inventory || !$connect_accounts) {
    die("Database connection failed: " . mysqli_connect_error());
}

$default = 0;

// Query the usage and inventory data
$query = "
    SELECT 
        i.item_id, 
        i.item_name, 
        i.item_quantity, 
        u.quantity_used, 
        u.date_of_usage
    FROM smilesync_inventory_usage u
    JOIN smilesync_inventory_items i ON u.item_id = i.item_id
    ORDER BY i.item_id
";

$queryData = mysqli_query($connect_inventory, $query);
if (!$queryData) {
    die("Query failed: " . mysqli_error($connect_inventory));
}

// Step 2: Initialize current stock calculation
$current_stock = [];
$queryDataArray = [];
while ($row = mysqli_fetch_assoc($queryData)) {
    $queryDataArray[] = $row;
    $item_id = $row['item_id'];

    if (!isset($current_stock[$item_id])) {
        $current_stock[$item_id] = $row['item_quantity'];
    }

    $current_stock[$item_id] -= $row['quantity_used'];
}

// Step 3: Save data to a CSV file for Python
$python_filepath = "python3";//"C:/Users/YORO/AppData/Local/Programs/Python/Python312/python.exe";
$csv_file = 'stock_usage.csv';
$fp = fopen($csv_file, 'w');
if (!$fp) {
    die("Failed to open file: $csv_file");
}

fputcsv($fp, ['item_id', 'item_name', 'item_quantity', 'current_stock', 'quantity_used', 'date_of_usage']); // Header row
foreach ($queryDataArray as $row) {
    $item_id = $row['item_id'];
    fputcsv($fp, [
        $item_id,
        $row['item_name'],
        $row['item_quantity'],
        $current_stock[$item_id],
        $row['quantity_used'],
        $row['date_of_usage']
    ]);
}
fclose($fp);

// Step 4: Call Python script to forecast stock levels
$python_script = 'inventory_forecast2.py'; // Replace with your Python script
$output = [];
$return_var = 0;
exec("$python_filepath $python_script $csv_file stock_forecast.csv", $output, $return_var);
if ($return_var !== 0) {
    die("Python script failed to execute: " . implode("\n", $output));
}

// Step 5: Load the forecast data
$forecast_file = 'stock_forecast.csv';
if (!file_exists($forecast_file) || filesize($forecast_file) === 0) {
    die("Forecast file is empty or missing.");
}
$forecast_data = array_map('str_getcsv', file($forecast_file));
$forecast_header = array_shift($forecast_data); // Remove header

// Step 6: Consolidate notifications
$threshold = 10; // Example threshold
$low_stock_notifications = [];
$out_of_stock_notifications = [];

foreach ($forecast_data as $forecast) {
    $item_id = $forecast[0];
    $item_name = mysqli_real_escape_string($connect_accounts, $forecast[1]);
    $forecasted_stock = array_slice($forecast, 3); // Assuming forecast starts at the 4th column

    foreach ($forecasted_stock as $day => $stock) {
        $date = date('Y-m-d', strtotime("+$day days", strtotime($current_date)));
        if ($stock <= $threshold && $stock > 0) {
            $low_stock_notifications[$date][] = [
                'item_id' => $item_id,
                'item_name' => $item_name
            ];
        }
        if ($stock <= 0) {
            $out_of_stock_notifications[$date][] = [
                'item_id' => $item_id,
                'item_name' => $item_name
            ];
        }
    }
}

// Step 7: Insert consolidated notifications into the database
function insert_notification($connect, $message, $date, $table_name) {
    $query = "
        SELECT COUNT(*) FROM $table_name
        WHERE notification = '$message' AND notification_date = '$date'
    ";
    $result = mysqli_query($connect, $query);
    $count = mysqli_fetch_row($result)[0];

    if ($count == 0) {
        $insert_query = "
            INSERT INTO $table_name 
            (`notification_id`, `notification`, `admin_id`, `notification_date`)
            VALUES (NULL, '$message', NULL, '$date')
        ";
        mysqli_query($connect, $insert_query);
    }
}

foreach ($low_stock_notifications as $date => $items) {
    $item_names = implode(", ", array_column($items, 'item_name'));
    $notification_message = "Warning: Stock for the following items is forecasted to drop below the threshold ($threshold) on $date:\n$item_names";

    insert_notification($connect_accounts, $notification_message, $current_date, 'smilesync_admin_notifications');
    insert_notification($connect_accounts, $notification_message, $current_date, 'smilesync_super_admin_notifications');
}

foreach ($out_of_stock_notifications as $date => $items) {
    $item_names = implode(", ", array_column($items, 'item_name'));
    $notification_message = "Alert: Stock for the following items is forecasted to run out on $date:\n$item_names";

    insert_notification($connect_accounts, $notification_message, $current_date, 'smilesync_admin_notifications');
    insert_notification($connect_accounts, $notification_message, $current_date, 'smilesync_super_admin_notifications');
}
?>
