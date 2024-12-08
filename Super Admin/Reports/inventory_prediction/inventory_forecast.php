<div class="patient-volume-header">
  <h2 class="chart-title">Inventory Forecast</h2>
  <?php include "dropdownWeek.php"; ?>
</div>

<?php
// Example inventory data to send to Python (IDs and stock levels)
$inventory_data = [
    ['item_name' => 'Dental Cement', 'stock_level' => 34],
    ['item_name' => 'Disinfectant and Wipes', 'stock_level' => 500]
];

// Convert PHP array to JSON for Python
$input_json = json_encode($inventory_data);

// Call the Python script and pass the data
$command = escapeshellcmd("python3 inventory_forecast.py '$input_json'");
$python_output = shell_exec($command);

// Decode the JSON output from Python
$forecast_data = json_decode($python_output, true);
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
      // Iterate over the forecast data and populate the table
      foreach ($forecast_data as $item) {
          $name = $item['item_name'];
          $forecast = $item['forecast'];

          echo "<tr>";
          echo "<td data-label='ID'>12345</td>"; // Replace with actual ID if needed
          echo "<td data-label='Name'>$name</td>";

          // Display forecast values for each date
          for ($i = 0; $i < 6; $i++) {
              echo "<td data-label='Date " . ($i + 1) . "'>" . $forecast[$i] . "</td>";
          }
          echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
