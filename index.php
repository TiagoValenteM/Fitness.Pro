<?php
// Start the session
session_start();

// if the user is already logged in then redirect user to home
if (isset($_SESSION['user'])) {
    header('location: home');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0" />
    <link rel="stylesheet" href="sign/style.css" />
    <link rel="icon" type="imagem/png" href="img/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Sign In - Fitness.Pro</title>
  </head>
  <body class="background post flex-column">
    <nav>
      <h3 class="logo-style flex side-padding top-padding margin-top-left">
       Fitness.Pro
      </h3>
    </nav>
    <div class="container-fluid d-flex flex-column center ">
      <div class="row center"> 
        <div class="col translate" id="welcome">
          <div class="side-padding vertical-align margin-right-left">
            <img class="logo-size flex rotate" src="sign/img/logo.png" />
            <h1 class="title-phrase flex top-padding bottom-padding">
              Walk. Run. <br />
              Be inspired.
            </h1>
            <h3 class="flex text-phrase">
              Add stories to your workouts. Explore iconic routes on your runs
              or hike somewhere else in your area. More than just monitoring
              your health, with Fitness.Pro, you can track your activity, share
              it with your friends, and stay active.
            </h3>
          </div>
        </div>
        <div class="col justify-center vertical-align-center">
          <div
            class=" white container-look show center-signin"
          >
            <div class="login-form-container" id="signin">
              <h1 class="heading">Sign In <br /></h1>
              <div class="flex">
                <h3 class="heading-2 padding-right">New user?</h3>
                <button class="link-pink" id="new-user">Create an account</button>
              </div>
              <div>
              <form action="sign/authenticate.php" method="POST" class="width">
                <div class="form-group margin-top">
                  <label for="exampleInputUser1">Username</label>
                  <input
                    type="text"
                    class="input-field"
                    id="exampleInputUser1"
                    aria-describedby="userHelp"
                    name="user"
                    maxlength="255"
                    required
                  />
                  <small id="emailHelp" class="form-text text-muted"
                    >Please enter your username.</small
                  >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input
                    type="password"
                    class="input-field"
                    id="exampleInputPassword1"
                    name="pass"
                    maxlength="50"
                    required
                  />
                </div>
                <div class="justify-right">
                  <button
                  type="submit"
                  class="button-green button-text margin-top-sm"
                >
                  Sign In
                </button>
                </div>
                </div>
                <div class="align-left">
                  <?php if (isset($_SESSION['errorMessage'])) {
                      // if session has error message, then it should print an error message
                      unset($_SESSION['errorMessage']);
                      echo "<span class='error-text'>Invalid username or password.</span>";
                  } ?>
                </div>
              </form>
            </div>
            <div class="login-form-container" id="signup">
              <h1 class="heading">Sign Up <br /></h1>
                <div class="flex">
                  <h3 class="heading-2 padding-right">Already a member?</h3>
                  <button class="link-pink" id="old-user">Sign In</button>
                </div>
                <form action="sign/register.php" method="POST">
                  <div class="form-group margin-top-sm">
                      <label for="exampleInputName1">Name</label>
                      <input
                        type="text"
                        class="input-field-signup"
                        id="exampleInputname"
                        name="name"
                        maxlength="100"
                        placeholder="Please enter your full name."
                        required
                      />
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input
                      type="text"
                      class="input-field-signup"
                      id="exampleInputusername"
                      name="user"
                      maxlength="20"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input
                      type="email"
                      class="input-field-signup"
                      id="exampleInputEmail1"
                      aria-describedby="emailHelp"
                      name="email"
                      maxlength="255"
                      placeholder="Please enter an email address."
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input
                      type="password"
                      class="input-field-signup"
                      id="exampleInputPassword1"
                      name="pass"
                      maxlength="50"
                      required
                    />
                  </div>
                  <div style="display: flex; gap: 14px;">
                    <div class="form-group">
                    <label for="exampleInputWeight">Weight</label>
                    <input
                      type="number"
                      class="input-field-signup-sm"
                      id="exampleInputweight"
                      name="initial_weight"
                      placeholder="e.g. 75"
                      max="999"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputHeight">Height</label>
                    <input
                      type="number"
                      class="input-field-signup-sm"
                      id="exampleInputheight"
                      name="height"
                      placeholder="e.g. 180"
                      max="999"
                      required
                    />
                  </div>
                      <div class="form-group">
                          <label for="exampleInputGender">Gender</label>
                          <input
                                  type="text"
                                  class="input-field-signup-sm"
                                  id="exampleInputGender"
                                  name="gender"
                                  placeholder="M/F"
                                  maxlength="1"
                                  required
                          />
                      </div>
              </div>
              <div class="justify-right">
                <button
                    type="submit"
                    class="button-green button-text margin-top-sm"
                  >
                    Sign Up
                  </button>
              </div>
                  
                  <div class="align-left">
                  <?php if (isset($_SESSION['registerError'])) {
                      // if session has error message, then it should print an error message
                      echo "<span class='error-text'>" .
                          $_SESSION['registerError'] .
                          '</span>';
                      unset($_SESSION['registerError']);
                  } elseif (isset($_SESSION['successMessage'])) {
                      echo "<span class='success-text'>" .
                          $_SESSION['successMessage'] .
                          '</span>';
                      unset($_SESSION['successMessage']);
                  } ?>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="sign/js/script.js"></script>
</html>
