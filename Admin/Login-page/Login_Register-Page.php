<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SmileSync-ADMIN</title>

    <!--style.css-->
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    
   <!-- <header>
        <div class="logo">smileSync
            <img src="img/login.png" alt="Logo">
        </div>
        <nav class="nav-tabs">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </header>-->

    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
           <form action="Login_Register-Page.php" autocomplete="off" class="sign-up-form">
           <div class="logo">
                <img src="img/login.png" alt="SmileSync" />
                <h4>SmileSync-ADMIN</h4>
              </div>   
           <div class="heading">
                <h2>To get started,</h2>
                <h2>Please signup.</h2>
                <h5>Already have an account?
                <a href="#" class="toggle">Log In</a></h5>
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
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>

                <div class="input-wrap">
            <input type="password" class="input-field"
                autocomplete="off"
                required></>
            <label>Confirm Password</label>
        </div>

                <input type="submit" value="Sign Up" class="sign-btn" />

                <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p>
              </div>


            </form>

            
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
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
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
    <script src="app.js"></script>
</body>
</html>
