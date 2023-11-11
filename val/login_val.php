<?php
session_start();
require_once('db_connect.php');

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to retrieve the user with matching email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) { // If there is a user with matching email
        $user = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $user['Password']; // Fetch the hashed password from the database

        // Use password_verify() function to check if entered password matches the hashed password
        if(password_verify($password, $hashedPasswordFromDatabase)) {
            // Store user data in session variables
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_name'] = $user['First_Name'] . ' ' . $user['Last_Name'];
            $_SESSION['user_email'] = $user['Email'];

            // Redirect to home page
            header("Location: ../index.php?status=success");
            exit();
        }
    }

    // If login is unsuccessful
    header("Location: ../user/user_login.php?status=error");
    exit();
} 
$conn->close();
?>
