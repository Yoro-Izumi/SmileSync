<div class="patient-volume-header">
  <h2 class="chart-title">Inventory Forecast</h2>
  <?php include "dropdownWeek.php"; ?>
</div>
<?php

// Step 1: Connect to the database and retrieve the data
$connect_inventory = connect_inventory($servername, $username, $password);

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

// Step 2: Initialize current stock calculation
$current_stock = [];

// Fetch all rows and calculate current stock levels for each item
while ($row = mysqli_fetch_assoc($queryData)) {
    $item_id = $row['item_id'];
    
    // If this item is not in the current_stock array, initialize it
    if (!isset($current_stock[$item_id])) {
        $current_stock[$item_id] = $row['item_quantity'];
    }
    
    // Subtract the used quantity from the current stock
    $current_stock[$item_id] -= $row['quantity_used'];
}

// Step 3: Save data to a CSV file for Python
$csv_file = 'stock_usage.csv';
$fp = fopen($csv_file, 'w');
fputcsv($fp, ['item_id', 'item_name', 'item_quantity', 'current_stock', 'quantity_used', 'date_of_usage']); // Header row
foreach ($queryData as $row) {
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
$python_script = 'inventory_prediction/inventory_forecast2.py'; // Replace with your Python script
exec("python3 $python_script $csv_file stock_forecast.csv"); // Replace with your Python path

// Step 5: Load the forecast data
$forecast_file = 'stock_forecast.csv';
if (file_exists($forecast_file)) {
    $forecast_data = array_map('str_getcsv', file($forecast_file));
    $forecast_header = array_shift($forecast_data); // Remove header
} else {
    die("Forecast file not found.");
}

?>
<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date 1</th>
        <th>Date 2</th>
        <th>Date 3</th>
        <th>Date 4</th>
        <th>Date 5</th>
        <th>Date 6</th>
      </tr>
    </thead>
    <tbody>
<?php
foreach ($forecast_data as $index => $row) {
    // Start a new row for every item
    if ($index % 6 == 0) {
        echo "<tr>";
    }
    
    // Output item ID and name in the first two columns for each row
    if ($index % 6 == 0) {
        echo "<td>" . htmlspecialchars($row[0]) . "</td>";
        echo "<td>" . htmlspecialchars($row[1]) . "</td>";
    }
    
    // Output the forecast values for the next 6 days
    echo "<td>" . htmlspecialchars($row[3]) . "</td>";

    // If we have outputted all 6 days, close the row and start a new one
    if ($index % 6 == 5) {
        echo "</tr>";
    }
}
?>
    </tbody>
  </table>
</div>
