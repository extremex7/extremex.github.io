<?php
require_once '../val/db_connect.php';  // Ensure the database connection is included

// Function to cancel a booking
function cancelBooking($conn, $bookingId) {
    // Check if the booking exists
    $bookingCheckSql = "SELECT * FROM booking WHERE id = $bookingId";
    $bookingCheckResult = $conn->query($bookingCheckSql);

    if ($bookingCheckResult->num_rows > 0) {
        // Booking exists, update the status to "Cancelled"
        $cancelBookingSql = "UPDATE booking SET status = 'Cancelled' WHERE id = $bookingId";

        if ($conn->query($cancelBookingSql) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'not_found';
    }
}

// Check if the request is a POST request and bookingId is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingId'])) {
    $bookingId = $_POST['bookingId'];

    // Call the cancelBooking function
    cancelBooking($conn, $bookingId);
} else {
    echo 'invalid_request';
}

// Close the database connection
$conn->close();
?>
