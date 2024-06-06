<?php
require_once('./database/connection.php');

$user_name = $_POST['Uname'];
$user_email = $_POST['Uemail'];
$user_password = $_POST['Upassword']

$sql = "INSERT INTO users (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
