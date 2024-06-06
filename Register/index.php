<?php
require_once('./database/connection.php'); 

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Set the default timezone to Karachi, Pakistan
    date_default_timezone_set('Asia/Karachi');

    // Get the current date and time
    $currentDateTime = date('Y-m-d H:i:s');

    // Validate first name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = "Name is required";
    } else {
        $user_name = $_POST['first_name'];
    }

    // Validate email
    if (empty($_POST['email_address'])) {
        $errors['email_address'] = "Email is required";
    } elseif (!filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_address'] = "Invalid email format";
    } else {
        $user_email = $_POST['email_address'];
    }

    // Validate password
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required";
    } elseif (strlen($_POST['password']) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    } else {
        $user_password = $_POST['password'];
    }

    // Validate confirm password
    if (empty($_POST['c_password'])) {
        $errors['c_password'] = "Confirm Password is required";
    } elseif ($_POST['password'] !== $_POST['c_password']) {
        $errors['c_password'] = "Passwords do not match";
    } else {
        $user_c_password = $_POST['c_password'];
    }

    if (empty($errors)) {
        $sql = "INSERT INTO students (student_name, student_email, student_password, student_contact, status, created_at) 
                VALUES ('$user_name', '$user_email', '$user_password', '','0','$currentDateTime')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New record created successfully')</script>";
            ?><meta http-equiv="refresh" content="0;url=http://localhost/Projects/Register/login.php"><?php
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="./assets/css/styles.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>
    <!-- Your HTML content -->
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
              <div class="col-md-12 mb-4">
        <div data-mdb-input-init class="form-outline">
            <input type="text" name="first_name" id="first_name" class="form-control" pattern="[a-zA-Z]{3,15}" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name']: ""?>" />
            <label class="form-label" for="first_name">First name</label>
            <?php if (!empty($errors['first_name'])): ?>
                <div class="text-danger"><?php echo $errors['first_name']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="email_address" name="email_address" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
        <label class="form-label" for="email_address">Email address</label>
        <?php if (!empty($errors['email_address'])): ?>
            <div class="text-danger"><?php echo $errors['email_address']; ?></div>
        <?php endif; ?>
    </div>

    <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control" minlength="8"  />
            <label class="form-label" for="password">Password</label>
            <!-- <small> must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small> -->
            <?php if (!empty($errors['password'])): ?>
                <div class="text-danger"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="c_password" name="c_password" class="form-control" />
                <label class="form-label" for="c_password">Confirm Password</label>
                <?php if (!empty($errors['c_password'])): ?>
                    <div class="text-danger"><?php echo $errors['c_password']; ?></div>
                <?php endif; ?>
            </div>
 
              
            
              <!-- Submit button -->
              <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" name="login" value="Sign Up">
                
              <a  href="./login.php" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-4">
                Go to Log-in
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
