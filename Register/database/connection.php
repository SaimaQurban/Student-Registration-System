<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "registeration";

$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "students";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  }
?>