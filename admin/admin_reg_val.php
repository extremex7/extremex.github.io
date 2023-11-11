<?php
session_start();
require_once('../val/db_connect.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Prepare and bind the input values
  $stmt = $conn->prepare("INSERT INTO admin (name, email, phone, gender, password) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $adminName, $email, $phone, $gender, $password);

  // Set the input values from the form
  $adminName = $_POST["admin_name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

  // Check if the email already exists in the database
  $check_stmt = $conn->prepare("SELECT email FROM admin WHERE email = ?");
  $check_stmt->bind_param("s", $email);
  $check_stmt->execute();
  $check_result = $check_stmt->get_result();

  if ($check_result->num_rows > 0) {
    // Email already exists, show error message and redirect to registration form
    header("Location: admin_reg.php?status=error");
    exit();
  } else {
    // Email does not exist, insert the new user into the database
    if ($stmt->execute()) {
      // Registration successful, redirect to login form
      header("Location: admin_login.php?status=success");
      exit();
    } else {
      // Error occurred while inserting the new user, show error message and redirect to registration form
      header("Location: admin_reg.php?status=error");
      exit();
    }
  }

  // Close statement and database connection
  $stmt->close();
  $check_stmt->close();
  mysqli_close($conn);
}
?>
