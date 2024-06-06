<?php
require_once('./database/connection.php');
session_start();

$emailErr = $passErr = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Validate email
    if (empty($email)) {
        $emailErr = "Email is required";
    }

    // Validate password
    if (empty($pass)) {
        $passErr = "Password is required";
    }

      // If both email and password are provided

    if (!empty($email) && !empty($pass)) {
          echo  $email;
          $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email' && user_password='$pass'");
          $row = mysqli_fetch_array($query);
          echo $row;

          if (mysqli_num_rows($query) > 0) {
              $_SESSION['email']=$email;
              ?>
                 <meta http-equiv="refresh" content="0;url=http://localhost/Projects/Register/Home.php"><?php
          } else {
              echo "<script>alert('Login Details Invalid | Try Again !')</script>";
          }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- <link rel="stylesheet" rel="./assets/css/styles.css"> -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">


        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Student <br />
                        <span style="color: hsl(218, 81%, 75%)">Management System</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Temporibus, expedita iusto veniam atque, magni tempora mollitia
                        dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                        ab ipsum nisi dolorem modi. Quos?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <form method="post">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                    </div>

                                </div>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="form3Example3" class="form-control" name="email" />
                                    <label class="form-label" for="form3Example3">Email address</label>
                                    <span class="error"><?php echo $emailErr;?></span>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form3Example4" class="form-control" name="pass" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <span class="error"><?php echo $passErr;?></span>
                                </div>


                                <!-- Submit button -->
                                <input type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-block mb-4" name="login" value="Sign In">

                                <a href="./index.php" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-success btn-block mb-4">
                                    Go to Sign Up
                                </a>

                                <!-- Register buttons -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

</body>

</html>