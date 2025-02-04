<?php
session_start();
if (isset($_SESSION['userID'])){
        unset($_SESSION['userID']);
        session_destroy();
        header('location: ../Login-page/Login-Page.php');

        die();
}
else{
        session_destroy();
        header('location: ../Login-page/Login-Page.php');
}


