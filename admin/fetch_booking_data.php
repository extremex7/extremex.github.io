<?php
require_once '../val/db_connect.php';

// Query to get booking counts for each month based on date_created
$sql = "SELECT 
            MONTH(date_created) AS month,
            COUNT(*) AS count,
            status
        FROM booking
        WHERE YEAR(date_created) = YEAR(CURRENT_DATE)
        GROUP BY MONTH(date_created), status";

$result = $conn->query($sql);

$monthlyStatistics = [
    'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    'datasets' => [
        [
            'label' => 'Bookings Confirmed',
            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            'borderColor' => 'rgba(54, 162, 235, 1)',
            'borderWidth' => 1,
            'data' => array_fill(0, 12, 0) // Initialize with zeros for all months
        ],
        [
            'label' => 'Bookings Cancelled',
            'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
            'borderColor' => 'rgba(255, 99, 132, 1)',
            'borderWidth' => 1,
            'data' => array_fill(0, 12, 0) // Initialize with zeros for all months
        ],
        [
            'label' => 'Bookings Pending',
            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'borderWidth' => 1,
            'data' => array_fill(0, 12, 0) // Initialize with zeros for all months
        ]
    ]
];

while ($row = $result->fetch_assoc()) {
    $month = $row['month'] - 1; // Month index is 0-based
    $count = $row['count'];
    $status = $row['status'];

    switch ($status) {
        case 'Confirmed':
            $monthlyStatistics['datasets'][0]['data'][$month] = $count;
            break;
        case 'Cancelled':
            $monthlyStatistics['datasets'][1]['data'][$month] = $count;
            break;
        case 'Pending':
            $monthlyStatistics['datasets'][2]['data'][$month] = $count;
            break;
        default:
            break;
    }
}

// Set the content type to JSON
header('Content-Type: application/json');

// Echo the JSON data
echo json_encode($monthlyStatistics);
?>
