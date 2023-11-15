<?php
session_start();

// Retrieve form data
$facility = $_POST['facility'];
$date_from = $_POST['date_from'];
$time_from = $_POST['time_from'];
$time_to = $_POST['time_to'];

// Retrieve client ID from the logged-in session
$clientId = ""; // Initialize the variable

if (isset($_SESSION['user_id'])) {
    // If the user is logged in and their ID is stored in the session
    $clientId = $_SESSION['user_id'];
} else {
    // If the user is not logged in or their ID is not stored in the session, handle the situation accordingly
    // You can redirect the user to the login page or display an error message
    // For simplicity, let's assume the client ID is required, and if it's not available, we terminate the script
    die("Client ID not found. Please log in before making a booking.");
}

// Perform necessary validations on the form data

// Create a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "futsal";

// Check for connection errors
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check availability
$availabilityCheckSql = "SELECT * FROM booking 
                         WHERE facility_id = (SELECT ID FROM facilities WHERE facility_code = ?) 
                         AND date_from = ? 
                         AND (
                            (time_from <= ? AND time_to >= ?) 
                            OR (time_from <= ? AND time_to >= ?)
                            OR (time_from >= ? AND time_to <= ?)
                         )";

$stmt = $conn->prepare($availabilityCheckSql);
$stmt->bind_param('ssssssss', $facility, $date_from, $time_from, $time_from, $time_to, $time_to, $time_from, $time_to);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die('<script>alert("The selected date and time are not available. Please choose a different time."); window.history.back();</script>');
}

$stmt->close();

// Generate the reference code
$refCode = generateReferenceCode($clientId, $facility);

// Set the booking status as "Pending"
$status = "Pending";

// Get the current date and time from the user's machine
$dateCreated = date('Y-m-d H:i:s');

// Insert the booking into the database
$sql = "INSERT INTO booking (ref_code, client_id, facility_id, date_from, time_from, time_to, status, date_created)
        VALUES (?, ?, (SELECT ID FROM facilities WHERE facility_code = ?), ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssss', $refCode, $clientId, $facility, $date_from, $time_from, $time_to, $status, $dateCreated);

if ($stmt->execute()) {
    die('<script>alert("Booking successful."); window.history.back();</script>');
} else {
    die('<script>alert("Failed to book. Please try again."); window.history.back();</script>');
}

// Close the database connection
$stmt->close();
$conn->close();

// Function to generate a unique reference code
function generateReferenceCode($clientId, $facility) {
    $timestamp = time(); // Get the current timestamp
    $refCode = $clientId . '_' . $facility . '_' . $timestamp; // Generate the reference code using client ID, facility code, and timestamp (you can modify this as per your requirements)
    return $refCode;
}
?>
