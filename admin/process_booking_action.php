<?php
session_start();
require_once '../val/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the booking ID and action from the AJAX request
    $bookingId = $_POST['bookingId'];
    $action = $_POST['action'];

    // Check if the booking exists
    $bookingCheckSql = "SELECT * FROM booking WHERE id = $bookingId";
    $bookingCheckResult = $conn->query($bookingCheckSql);

    if ($bookingCheckResult->num_rows > 0) {
        // Booking exists, update the status based on the action
        if ($action === 'cancel') {
            // Update the status to "Cancelled"
            $cancelBookingSql = "UPDATE booking SET status = 'Cancelled' WHERE id = $bookingId";
            if ($conn->query($cancelBookingSql) === TRUE) {
                echo 'success';
            } else {
                echo 'Error cancelling the booking: ' . $conn->error;
            }
        } elseif ($action === 'confirm') {
            // Update the status to "Confirmed"
            $confirmBookingSql = "UPDATE booking SET status = 'Confirmed' WHERE id = $bookingId";
            if ($conn->query($confirmBookingSql) === TRUE) {
                echo 'success';
            } else {
                echo 'Error confirming the booking: ' . $conn->error;
            }
        } else {
            echo 'Invalid action';
        }
    } else {
        echo 'Booking with ID ' . $bookingId . ' does not exist.';
    }
} else {
    echo 'Invalid request';
}
?>
