<?php
session_start();
if (isset($_SESSION['userID'])){
        unset($_SESSION['userAdminID']);
        session_destroy();
        header('location: ../Login-page/Login_Register-Page.php');

        die();
}
else{
        session_destroy();
        header('location: ../Login-page/Login_Register-Page.php');
}


