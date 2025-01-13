<?php
include "../client_global_files/set_sesssion_dir.php";

session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";
include "../client_global_files/input_sanitizing.php";
if (isset($_SESSION['userID']) && !empty($_SESSION['csrf_token'])) {
  $connect_accounts = connect_accounts($servername,$username,$password);
  $userID = $_SESSION['userID'];
  $qryGetPatientInfo = "SELECT * FROM smilesync_patient_accounts 
                        LEFT JOIN smilesync_patient_management.smilesync_patient_information 
                        ON smilesync_patient_accounts.patient_info_id = smilesync_patient_management.smilesync_patient_information.patient_info_id
                        WHERE smilesync_patient_accounts.patient_account_id = ? ";
  $stmtGetPatientInfo = $connect_accounts->prepare($qryGetPatientInfo);
  $stmtGetPatientInfo->bind_param('i',$userID);
  $stmtGetPatientInfo->execute();
  $resultGetPatientInfo = $stmtGetPatientInfo->get_result();
  $rowGetPatientInfo = $resultGetPatientInfo->fetch_assoc();
  $patientFirstName = decryptData($rowGetPatientInfo['patient_first_name'],$key);
  $patientLastName = decryptData($rowGetPatientInfo['patient_last_name'],$key);
  $patientMiddleName = decryptData($rowGetPatientInfo['patient_middle_name'],$key);
  $patientSuffix = decryptData($rowGetPatientInfo['patient_suffix'],$key);
  $patientBirthdate = decryptData($rowGetPatientInfo['patient_birthday'],$key);
  $patientBirthdate = date('Y-m-d',strtotime($patientBirthdate));
  $patientPhoneNumber = decryptData($rowGetPatientInfo['patient_phone_number'],$key);
  $patientEmail = decryptData($rowGetPatientInfo['patient_account_email'],$key);
  $stmtGetPatientInfo->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/toggles.css" />
    <link rel="stylesheet" href="css/table.css" />
    <link rel="stylesheet" href="css/modal.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
  </head>
<body>

<?php include "loader.php"; ?>
  
<div class="body-container"  id="body-container">
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "top-navbar.php"; ?>

<div class="Container">
  
  <div class="appointment-details">
  <div class="toggle-tabs">
          <div class="tab active" data-content="appointments">Appointment Details</div>
          <div class="tab" data-content="invoices">Invoice</div>
      </div>
  <div class="content-area">
          <div class="content active" id="appointments"><?php include "appointment-table.php"; ?></div>
          <div class="content" id="invoices" style="display: none;"><?php include "invoice-table.php"; ?></div>
      </div>
  </div>
</div>

</div>



 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/toggles.js"></script>
</body>
</html>
<?php
}
else{
  header('location: ../LogIn-Page/Login-Page.php');
  die();
}
?>