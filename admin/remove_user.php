<?php
session_start();
require_once '../val/db_connect.php';

// Check if the form is submitted to remove the user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_user'])) {
    $userId = $_POST['userId'];

    // Remove the user from the database
    $deleteUserSql = "DELETE FROM users WHERE ID = ?";
    $stmt = $conn->prepare($deleteUserSql);
    $stmt->bind_param("i", $userId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // User deleted successfully
        echo '<script>';
        echo 'alert("User deleted successfully.");';
        echo 'window.location.href = "manage_users.php";'; // Redirect to the manage_users.php page
        echo '</script>';
    } else {
        // Error deleting user
        echo '<script>';
        echo 'alert("Error deleting user.");';
        echo 'window.location.href = "manage_users.php";'; // Redirect to the manage_users.php page
        echo '</script>';
    }

    // Close the statement
    $stmt->close();
}
?>
