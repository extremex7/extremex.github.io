<?php
require_once '../val/db_connect.php';

// Get the facility value from the GET parameters
$facility = $_GET['facility'];

// Query the database to get the price based on the facility
$sql = "SELECT price FROM facilities WHERE facility_code = '$facility'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
  // Fetch the price from the result
  $row = $result->fetch_assoc();
  $price = $row['price'];

  // Return the price
  echo $price;
} else {
  // Return an error message if the query fails
  echo 'Error fetching price';
}

// Close the database connection
$conn->close();
?>
