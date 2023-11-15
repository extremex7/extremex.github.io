<?php
session_start();
require_once '../val/db_connect.php';

// Check if the form is submitted to save the edited user information
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_edit'])) {
    $userId = $_POST['userId'];
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newGender = $_POST['new_gender'];
    $newPhoneNumber = $_POST['new_phone_number'];

    // Update user information in the database
    $updateUserSql = "UPDATE users SET First_Name = ?, Last_Name = ?, Gender = ?, Phone = ? WHERE ID = ?";
    $stmt = $conn->prepare($updateUserSql);
    $stmt->bind_param("ssssi", $newFirstName, $newLastName, $newGender, $newPhoneNumber, $userId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // User information updated successfully
        echo '<script>';
        echo 'alert("User information updated successfully.");';
        echo 'window.location.href = "edit_user.php?id=' . $userId . '";'; // Reload the same edit_user.php page
        echo '</script>';
    } else {
        // Error updating user information
        echo '<script>';
        echo 'alert("Error updating user information.");';
        echo 'window.location.href = "edit_user.php?id=' . $userId . '";'; // Reload the same edit_user.php page
        echo '</script>';
    }

    // Close the statement
    $stmt->close();
}
?>
