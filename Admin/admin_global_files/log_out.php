<?php
session_start();
if (isset($_SESSION['userAdminID'])){
        unset($_SESSION['userAdminID']);
        session_destroy();
        header('location: ../Login-page/Login_Register-Page.php');

        die();
}
     else if(isset($_SESSION['userSuperAdminID'])){
        unset($_SESSION['userSuperAdmin']);
        session_destroy();
        header('location: ../../Admin/Login-page/Login_Register-Page.php');
        die();
     }
     else{
        session_destroy();
        header('location: ../Login-page/Login_Register-Page.php');
}


