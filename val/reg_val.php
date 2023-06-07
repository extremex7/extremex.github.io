<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "futsal";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Prepare and bind the input values
  $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $gender, $password);

  // Set the input values from the form
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

  // Check if the email already exists in the database
  $check_stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
  $check_stmt->bind_param("s", $email);
  $check_stmt->execute();
  $check_result = $check_stmt->get_result();

  if ($check_result->num_rows > 0) {
    // Email already exists, show error message and redirect to registration form
    header("Location: ../user/user_registration.php?status=error");
    exit();
  } else {
    // Email does not exist, insert the new user into the database
    if ($stmt->execute()) {
      // Registration successful, redirect to login form
      header("Location: ../user/user_login.php?status=success");
      exit();
    } else {
      // Error occurred while inserting the new user, show error message and redirect to registration form
      header("Location: ../user/user_registration.php?status=error");
      exit();
    }
  }

  // Close statement and database connection
  $stmt->close();
  $check_stmt->close();
  mysqli_close($conn);
}
?>
