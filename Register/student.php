<?php
require_once('./database/connection.php');
session_start();
$email=$_SESSION['email'];

$qry=mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
$data=mysqli_fetch_assoc($qry);


$sql = "SELECT * FROM `students`";
$result = $conn->query($sql);
$res1 = $result->fetch_all(MYSQLI_ASSOC);
// print_r($res);exit;
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
                                    <h3 class="col text-left">Student</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="add_student.php">
                                    <button type="button" class="btn btn-primary btn-custom">Add New Student</button>
                                </a>
                                </div>
                            </div>
                            <div class="container">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          foreach ($res1 as $key => $res) {  ?>
                                        <tr>
                                            <td><?php echo $res['student_id'];?></td>
                                            <td><?php echo $res['student_name'];?></td>
                                            <td><?php echo $res['student_email'];?></td>
                                            <td><?php echo $res['student_contact'];?></td>

                                            <td>
                                                <?php echo "<a class='btn btn-primary' href='edit_std.php.?id=$res[student_id]'>EDIT</a>"; ?>
                                            </td>
                                            <td>
                                            <?php echo "<a class='btn btn-outline-danger' href='delete_std.php.?id=$res[student_id]' onclick='return checkdelete()'>DELETE</a>"; ?>
                                            </td>

                                        </tr>

                                        <?php  }?>
                                    </tbody>
                                </table>
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
<script> 
function checkdelete()
{
    return confirm('Are you sure you want to Delete this Student');
}
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