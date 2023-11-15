<?php
require_once '../val/db_connect.php';

function checkAvailabilityInDatabase($facility, $time_from, $time_to)
{
    global $conn;

    // Fetch bookings for the specified facility and overlapping time range
    $sql = "SELECT * FROM booking 
            WHERE facility_id = ? 
            AND (
                (date_from = CURDATE() AND ((time_from BETWEEN ? AND ?) OR (time_to BETWEEN ? AND ?)))
                OR
                (date_from < CURDATE() AND date_to >= CURDATE())
            )";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $facility, $time_from, $time_to, $time_from, $time_to);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if there are any overlapping bookings
    if ($result->num_rows > 0) {
        return "Time Unavailable";
    } else {
        return "Time Available";
    }
}


// Check for availability when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facility = $_POST['facility'];
    $time_from = $_POST['time_from'];
    $time_to = $_POST['time_to'];

    // Check availability in the database
    $availabilityStatus = checkAvailabilityInDatabase($facility, $time_from, $time_to);

    // Return the availability status
    echo $availabilityStatus;
}
?>
