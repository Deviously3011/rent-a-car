<?php
// Start the session
session_start();

// Retrieve variables from the session
$carID = isset($_SESSION['carID']) ? $_SESSION['carID'] : '';
$startDate = isset($_SESSION['startDate']) ? $_SESSION['startDate'] : '';
$endDate = isset($_SESSION['endDate']) ? $_SESSION['endDate'] : '';
$calculatedPrice = isset($_SESSION['calculatedPrice']) ? $_SESSION['calculatedPrice'] : '';

// Display the invoice
echo '<div class="container">';
echo '<h1>Factuur</h1>';
echo '<p>Car Rental Details:</p>';
echo '<p>Car ID: ' . $carID . '</p>';

// Check if $startDate, $endDate, and $calculatedPrice are set before using them
if (!empty($startDate)) {
    echo '<p>Start Date: ' . $startDate . '</p>';
} else {
    echo '<p>Start Date: N/A</p>';
}

if (!empty($endDate)) {
    echo '<p>End Date: ' . $endDate . '</p>';
} else {
    echo '<p>End Date: N/A</p>';
}

if (!empty($calculatedPrice)) {
    echo '<p>Total Cost: €' . number_format($calculatedPrice, 2) . '</p>';
} else {
    echo '<p>Total Cost: N/A</p>';
}

echo '</div>';

// Generate an associative array with invoice details
$invoiceDetails = array(
    'Car ID' => $carID,
    'Start Date' => !empty($startDate) ? $startDate : 'N/A',
    'End Date' => !empty($endDate) ? $endDate : 'N/A',
    'Total Cost' => !empty($calculatedPrice) ? number_format($calculatedPrice, 2) : 'N/A',
);

// Clear the session variables
session_destroy();

// Create a Word document and download it
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=factuur.doc");

echo '<html>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<body>';
echo '<div class="container">';
echo '<h1>Factuur</h1>';
echo '<p>Car Rental Details:</p>';
echo '<p>Car ID: ' . $carID . '</p>';
echo '<p>Start Date: ' . (!empty($startDate) ? $startDate : 'N/A') . '</p>';
echo '<p>End Date: ' . (!empty($endDate) ? $endDate : 'N/A') . '</p>';
echo '<p>Total Cost: €' . (!empty($calculatedPrice) ? number_format($calculatedPrice, 2) : 'N/A') . '</p>';
echo '</div>';
echo '</body>';
echo '</html>';
?>
