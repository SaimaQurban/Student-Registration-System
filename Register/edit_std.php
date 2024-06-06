<?php
require_once('./database/connection.php');
session_start();
$email=$_SESSION['email'];

$qry=mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
$data=mysqli_fetch_assoc($qry);


//Get student id
$id = $_GET['id'];
//fetch student records
$querry=mysqli_query($conn, "SELECT * FROM students WHERE student_id = '$id'");
$rec=mysqli_fetch_assoc($querry);


$sql = "SELECT * FROM `students`";
$result = $conn->query($sql);
$res1 = $result->fetch_all(MYSQLI_ASSOC);
// print_r($res);exit;


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

    $status = $_POST['status'];

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
        $sql = "UPDATE students SET student_name='$user_name', student_email='$user_email', student_password='$user_password', status='$status' WHERE student_id='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record Updated successfully')</script>";
            ?><meta http-equiv="refresh" content="0;url=http://localhost/Projects/Register/student.php"><?php
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <!-- Bootstrap JS (Optional, if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('./partials/sidebar.php')?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <?php include_once('./partials/top_bar.php')?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="col text-left">Edit Student Info</h3>
                                </div>
                                <div class="col-6 text-right">
                                    
                                </div>
                            </div>
                            <div class="container">

<div class="card bg-glass">
<div class="card-body px-4 py-5 px-md-5">
    <form method="post">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="col-md-12 mb-4">
        <div data-mdb-input-init class="form-outline">
            <label class="form-label" for="first_name">Student Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" pattern="[a-zA-Z]{3,15}" value="<?php echo $rec['student_name'] ?>" />
            <?php if (!empty($errors['first_name'])): ?>
                <div class="text-danger"><?php echo $errors['first_name']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="email_address">Email address</label>
        <input type="email" id="email_address" name="email_address" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $rec['student_email'] ?>" />
         <?php if (!empty($errors['email_address'])): ?>
            <div class="text-danger"><?php echo $errors['email_address']; ?></div>
        <?php endif; ?>
    </div>
    <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="text" id="password" name="password" value="<?php echo $rec['student_password'] ?>" class="form-control" minlength="8" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" />
            
            <small style="color: orange;"> must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small>

            <?php if (!empty($errors['password'])): ?>
                <div class="text-danger"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>

            <div data-mdb-input-init class="form-outline mb-4">
                 <label class="form-label" for="c_password">Confirm Password</label>
                <input type="text" id="c_password" name="c_password" value="<?php echo $rec['student_password'] ?>" class="form-control" />
               
                <?php if (!empty($errors['c_password'])): ?>
                    <div class="text-danger"><?php echo $errors['c_password']; ?></div>
                <?php endif; ?>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="status">Student Status</label>
                <select class="form-control" name="status">
                    <option value="<?php echo $rec['status'];?>"><?php echo $rec['status'];?></option>
                <?php
                if ($rec['status']=='0') {
                ?><option value="1">1</option><?php
                } if ($rec['status']=='1') {
                ?><option value="0">0</option><?php
                }
                ?>
                </select>
            </div>
 
              
            
              <!-- Submit button -->
              <input type="submit" class="btn btn-primary mb-4" name="login" value="Update">
              <input type="reset" class="btn btn-danger mb-4" name="reset" value="Reset">
                
             

              <!-- Register buttons -->
              
            </form>
          </div>
        </div>


                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include_once('./partials/foter.php')?>


                    <!-- Edit Student Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addStudentForm">
                                        <div class="mb-3">
                                            <label for="eidit_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Edit Name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="edit_email"
                                                placeholder="Enter Email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input type="text" class="form-control" id="edit_contact"
                                                placeholder="Enter Contact">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                onclick="addStudent()">Save</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Modal -->
                <div class="modal fade" id="student_modal" tabindex="-1" aria-labelledby="student-modal-label"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="student-modal-label">Add Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="student-form">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="student-name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="student-name" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="student-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="student-email" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="student-contact" class="form-label">Contact</label>
                                        <input type="text" class="form-control" id="student-contact" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="save-changes-btn">Save
                                        Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <!-- Script FOr Forms Starts -->
    <script>
    $('#student-form').on('submit', function(e) {
                e.preventDefault();

                var std_name = $('#student-name').val();
                console.log(std_name);
                var std_email = $('#student-email').val();
                console.log(std_email);
                var std_contact = $('#student-contact').val();
                console.log(std_contact);


                if (name == "") {
                    alert("Required field");
                } else if (email == "") {
                    alert("Required field");

                } else if (contact == "") {
                    alert("Required field");

                }else {
                    $(document).ready(function() {
    $('#submitBtn').click(function() {
        // Get form data
        var formData = $('#myForm').serialize();
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("your_controller/save_form_data"); ?>',
            data: formData,
            success: function(response) {
                // Handle success response
                console.log(response);
                // You can show a success message or redirect the user after successful submission
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });
});

ajax Submission!

                    }


                })
    </script>

    <!-- Scrip for FOrms Ended -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->


</body>

</html>