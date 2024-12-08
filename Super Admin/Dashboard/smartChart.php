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
      <button class="dashboard_btn"><a href="../Reports/ReportAndAnalytics-page.php">View Reports</a></button>
    </div>

    <div id="patientVolumeChart"></div>
  </div>
  </div>


  <script src="js/smartChart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!--Data for total number of customer per day-->
<?php $peakDayData = [10, 20, 40, 36, 25, 28]; ?>
<script> var peakDayData = <?php echo json_encode($peakDayData);?>; </script>

</body>

</html>