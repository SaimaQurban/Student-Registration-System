<?php
error_reporting(0);
require_once('./database/connection.php');
session_start();

$id = $_GET['id'];
$dattta = mysqli_query($conn, "DELETE From students Where student_id = '$id'");
	if($dattta)
	{?><meta http-equiv="refresh" content="0; URL=http://localhost/Projects/Register/student.php" /><?php
	}
	else
	{
		echo "<script>alert('ERROR !')</script>";
	}
?>
