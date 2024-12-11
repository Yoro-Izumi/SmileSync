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
    </div>

    <div id="patientVolumeChart"></div>
  </div>
  </div>

  <div class="chart-group">
    <div class="chart-item">
      <h3 class="chart-title">Peak Days</h3>
      <div id="peakDaysChart"></div>
    </div>
    <div class="chart-item">
      <h3 class="chart-title">Peak Hours</h3>
      <div id="peakHoursChart"></div>
    </div>
  </div>



  <div class="chart-group">
      <div class="container">
      
      <div class="patient-volume-header">
      <h2 class="chart-title">Stock Report</h2>
      <?php include "dropdownWeek.php"; ?>
    </div>


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
          <?php include "inventory_report.php";?>
        </tbody>
      </table>
    </div>
  </div>
    </div>




    <div class="chart-group">
      <div class="container">
      
<div class="patient-volume-header">
    </div>
      <?php include "inventory_prediction/inventory_forecast2.php";?>
  </div>
</div>

<!--Data for total number of customer per day-->
<?php $peakDayData = [10, 20, 40, 36, 25, 28]; ?>
<script> var peakDayData = <?php echo json_encode($peakDayData);?>; </script>

  <script src="js/smartChart.js"></script>
</body>

</html>