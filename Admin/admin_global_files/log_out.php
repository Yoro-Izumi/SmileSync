<?php
session_start();
if (isset($_SESSION['userAdminID'])){
         session_destroy();
        unset($_SESSION['userAdminID']);
        header('location:../Login-page/Login_Register-Page.php');
        die();
}
     else if(isset($_SESSION['userSuperAdminID'])){
      session_destroy();
        unset($_SESSION['userSuperAdmin']);
        header('location:../Login-page/Login_Register-Page.php');
        die();
     }


