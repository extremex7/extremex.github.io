<?php
// Retrieve form data
$facility = $_POST['facility'];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$time_from = $_POST['time_from'];
$time_to = $_POST['time_to'];
$clientName = ""; // Retrieve client name from the logged-in session

// Retrieve client ID from the logged-in session or database
$clientId = ""; // Initialize the variable
session_start(); // Start the session

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

// Store the booking in the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "futsal";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate the reference code (using a combination of values)
$refCode = generateReferenceCode($clientId, $facility);

// Set the booking status as "Pending" (you can change this to "Accepted" or "Cancelled" based on your requirements)
$status = "Pending";

// Get the current date and time from the user's machine
$dateCreated = date('Y-m-d H:i:s');

// Insert the booking into the database
$sql = "INSERT INTO booking (ref_code, client_id, facility_id, date_from, date_to, time_from, time_to, status, date_created)
        VALUES ('$refCode', '$clientId', (SELECT ID FROM facilities WHERE facility_code = '$facility'), '$date_from', '$date_to', '$time_from', '$time_to', '$status', '$dateCreated')";

if ($conn->query($sql) === TRUE) {
    header('Location: book_success.php');
    exit(); 
} else {
    header('Location: book_fail.php');
    exit();
}

// Close the database connection
$conn->close();

// Function to generate a unique reference code
function generateReferenceCode($clientId, $facility) {
    $timestamp = time(); // Get the current timestamp
    $refCode = $clientId . '_' . $facility . '_' . $timestamp; // Generate the reference code using client ID, facility code, and timestamp (you can modify this as per your requirements)
    return $refCode;
}
?>
