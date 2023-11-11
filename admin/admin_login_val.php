<?php
session_start();
require_once('../val/db_connect.php');

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to retrieve the admin with matching email
    $stmt = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) { // If there is a admin with matching email
        $admin = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $admin['password']; // Fetch the hashed password from the database

        // Use password_verify() function to check if entered password matches the hashed password
        if(password_verify($password, $hashedPasswordFromDatabase)) {
            // Store user data in session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_email'] = $admin['email'];

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php?status=success");
            exit();
        }
    }

    // If login is unsuccessful
    header("Location: admin_login.php?status=error");
    exit();
} 
$conn->close();
?>
