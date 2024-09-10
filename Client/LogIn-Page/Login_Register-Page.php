<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SmileSync-ADMIN</title>

    <!--style.css-->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    

    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
  
            
          <form action="Login_Register-Page.php" autocomplete="off" class="sign-in-form">
          <div class="logo">
                <img src="img/login.png" alt="SmileSync" />
                <h4>SmileSync-ADMIN</h4>
              </div>
    
          <div class="heading">
                <h2>Welcome Admin,</h2>
                <h2>Log in to your account.</h2>
                <h5>Don't have an account?
                <a href="#" class="toggle">Sign up</a></h5>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    id="signup-password"
                    autocomplete="off"
                    required
                  />
                  <label>Password<indicator>*</indicator></label>
                  <div class="fa fa-eye icon" id="signup-show-password"></div>
                  
                </div>


<!--password example-->
              <div class="input-wrap">
                <input 
                      type="password" 
                      name="password"
                      class="input-field" 
                      id="floatingPassword"
                      autocomplete="off" 
                      required oninput="validatePassword(event)"
                />
              <label for="floatingPassword">Password<indicator>*</indicator></label>
              <button class="btn btn-secondary toggle-password position-absolute end-0 top-50 translate-middle-y " type="button">
                <i class="fa fa-eye icon"></i>
              </button>
                </div>



                <div class="remember-me-wrap">
                    <input type="checkbox" id="rememberMe" class="remember-me-checkbox">
                    <h5 for="rememberMe">Remember Me</h5>
                </div>

                <input type="submit" value="Sign In" class="sign-btn" />

                <p class="text">
                  Forgotten your password or you login datails?
                  <a href="#">Get help</a> signing in
                </p>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="img/login.png" alt="image">
          </div></div>

        </div>
      </div>

    </main>

    <!-- Javascript file -->
    <script src="js/app.js"></script>
    <script src="js/password-toggle.js"></script>

</body>
</html>
