<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/smartChart.css">
  <link rel="stylesheet" href="css/table.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
<div class="chart-group">
  <div class="chart-container">
    <div class="patient-volume-header">
      <h2 class="chart-title">Patient Volume per Day</h2>
      <?php include "dropdownWeek.php"; ?>
    </div>

    <div id="patientVolumeChart"></div>
  </div>
  </div>


  <script src="js/smartChart.js"></script>
</body>

</html>