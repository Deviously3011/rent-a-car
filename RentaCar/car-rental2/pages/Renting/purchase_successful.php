<?php
include('../../includes/header.php');
// Include necessary classes
require_once('../../classes/Car.php');
require_once('../../classes/User.php');

// Retrieve car ID from the query parameter
$carID = isset($_GET['carID']) ? htmlspecialchars($_GET['carID']) : '';

// Your existing code for form processing and calculations

// Display purchase success message
echo '<div class="container">';
echo '<h1>Purchase Successful!</h1>';
echo '<p>Your purchase has been successfully processed.</p>';
echo '<p>Return to <a href="../../index.php">Home Page</a></p>';
echo '<p>Download your invoice: <a href="factuur.php?carID=' . $carID . '">Download Factuur</a></p>';
echo '</div>';
include('../../includes/footer.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    
</body>
</html>