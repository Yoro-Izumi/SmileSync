<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Generate a CSRF token if it's not already set
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if user is already logged in
if (isset($_SESSION['userSuperAdminID']) && $_SESSION['userType'] == 'superAdmin') {
    header('location: ../../Super%20Admin/Dashboard');
    exit();
}
else if (isset($_SESSION['userAdminID']) && $_SESSION['userType'] == 'admin') {
    header('location: ../Dashboard/Dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SmileSync-ADMIN</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!--style.css-->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- AJAX -->
    <script src="../admin_global_files/js/jquery-3.6.0.min.js"></script>
    

</head>


<body>
     <?php include "modal.php"; ?>
     <?php include "loader.php"; ?>

     <main>
   
   <div class="box">
     <div class="inner-box">
       <div class="forms-wrap">
        <form id="register_form" name="register_form" autocomplete="off" class="sign-up-form" method="POST">
        <div class="logo">
             <img src="img/logo.png" alt="SmileSync" />
             SmileSync
           </div>   
        <div class="heading">
             <h2>To get started, please register.</h2>
             <h4>Already have an account?
             <a href="#" class="toggle">Log In</a></h4>
           </div>

           <div class="actual-form">

         <div class="wrap-2rows">

           <div class="input-wrap">
               <input
                 type="text"
                 maxlength="24"
                 class="input-field"
                 autocomplete="off"
                 name="firstName"
                 required
               />
               <label>First Name<indicator>*</indicator></label>
             </div>

             <div class="input-wrap">
               <input
                 type="text"
                 minlength="1"
                 maxlength="24"
                 class="input-field"
                 autocomplete="off"
                 name="lastName"
                 required
               />
               <label>Last Name<indicator>*</indicator></label>
             </div>
           </div>


           <div class="wrap-3rows">

           <div class="input-wrap">
               <input
                 type="text"
                 minlength="1"    
                 maxlength="24"
                 class="input-field"
                 autocomplete="off"
                 name="middleName"
               />
               <label>Middle Name</label>
             </div>

             <div class="input-wrap">
               <input
                 type="text"
                 minlength="1"
                 maxlength="5"
                 class="input-field"
                 name="suffix"
                 autocomplete="off"
               />
               <label>Suffix</label>
             </div>

             <div class="input-wrap">
             <input
                 type="text"
                 id="birthdate-picker"
                 class="input-field"
                 name="birthday"
                 autocomplete="off"
                 required
               />
               <label>Select Birthdate<indicator>*</indicator></label>
             </div>

           </div>


             <div class="input-wrap">
               <input
                 type="text"
                 minlength="11"
                 maxlength="13"
                 class="input-field"
                 name="phoneNumber"
                 autocomplete="off"
                 required
               />
               <label>Phone Number<indicator>*</indicator></label>
             </div>

             <div class="input-wrap">
               <input
                 type="email"
                 minlength="1"
                 maxlength="24"
                 class="input-field"
                 name="emailRegister"
                 autocomplete="off"
                 required
               />
               <label>Email Address<indicator>*</indicator></label>
             </div>

             <div class="input-wrap">
               <input
                 type="password"
                 minlength="1"
                 maxlength="24"
                 class="input-field"
                 name="passwordRegister"
                 autocomplete="off"
                 required
               />
               <label>Password<indicator>*</indicator></label>
             </div>

             <div class="input-wrap">
             <input type="password" 
               class="input-field"
               name="confirmPasswordRegister"
               autocomplete="off"
             required>
         <label>Confirm Password<indicator>*</indicator></label>
     </div>

             <input type="submit" value="Sign Up" class="sign-btn" id="registerBtn" name="registerBtn"/>
      <!-- #region -->

      <div class="text-wrap">
             <p class="text">
               By signing up, I agree to the
               <a href="#" id="termServices">Terms of Services</a> |
               <a href="#" id="privacyPolicy">Privacy Policy</a>
             </p>
           </div>
         </div>

         </form>

         
       <form name="login_form" id="login_form" autocomplete="off" class="sign-in-form" method="POST">
       <input type="hidden" value="<?php echo "$_SESSION[csrf_token]";?>" name="csrf_token" id="csrf_token">
       <div class="logo">
             <img src="img/logo.png" alt="SmileSync" />
             SmileSync
           </div>
 
       <div class="heading">
             <h2>Welcome,</h2>
             <h2>Log in to your account.</h2>
             <h4>Don't have an account?
             <a href="#" class="toggle">Sign up</a></h4>
           </div>

           <div class="actual-form">
             <div class="input-wrap">
               <input
                 type="text"
                 maxlength="24"
                 class="input-field"
                 name="email"
                 autocomplete="off"
                 required
               />
               <label>Email<indicator>*</indicator></label>
             </div>

             <div class="input-wrap">
               <input
                 type="password"
                 maxlength="24"
                 class="input-field"
                 id="signup-password"
                 name="password"
                 autocomplete="off"
                 required
               />
               <label>Password<indicator>*</indicator></label>
               <div class="fa fa-eye icon" id="signup-show-password"></div>
               
             </div>


          <div class="text-wrap">
             <div class="remember-me-wrap">
                 <input type="checkbox" id="rememberMe" class="remember-me-checkbox">
                 <p for="rememberMe">Remember Me</p>
             </div>

               <p class="text">
               <a href="#" id="forgotLink"> Forgotten your password?</a>
             </p>
             </div >

             <input type="submit" value="Sign In" class="sign-btn" id="loginBtn"/>

             
           </div>
         </form>
       </div>

       <div class="carousel">
         <div class="images-wrapper">
           <img src="img/it.png" alt="image">
       </div></div>

     </div>
   </div>

 </main>

    <!-- Javascript file -->
    <script src="js/app.js"></script>
    <script src="js/submit_form.js"></script>
    <script src="js/validations.js"></script>
</body>
</html>