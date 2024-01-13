<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
    <script src="../assets/js/main.js" defer></script>
    
</head>
<body>

    <?php include('../../includes/header.php'); ?>
    <!-- Include the header file -->

    <div class="container">
        <h1>Welcome to Car Rental</h1>

        <?php
        // Include the Car class
        require_once('../../classes/Car.php');

        // Get car ID from the URL parameter
        $carID = isset($_GET['carID']) ? htmlspecialchars($_GET['carID']) : '';

        // Instantiate the Car class
        $car = new Car($database);

       // Retrieve and display the car details
$carDetails = $car->getCarById($carID);

if ($carDetails) {
// Display car image
echo '<div style="text-align: center;">';
if (!empty($carDetails['Image'])) {
    
  echo '<img src="../../assets/img/' . basename($carDetails['Image']) . '" alt="' . $carDetails['Brand'] . '">';
} else {
    echo '<p>No image available</p>';
}
echo '</div>';




          // Display basic details
echo '<h1>' . $carDetails['Brand'] . ' ' . $carDetails['Model'] . '</h1>';
echo '<p>Year: ' . $carDetails['Year'] . '</p>';
echo '<p>License Plate: ' . $carDetails['LicensePlate'] . '</p>';
echo '<p>Price per Month: €' . number_format($carDetails['PricePerMonth'], 2) . '</p>';
echo '<p>Vehicle Type: ' . ($carDetails['VehicleType'] ? $carDetails['VehicleType'] : 'Not specified') . '</p>';
echo '<p>Availability: ' . ($carDetails['Availability'] ? 'Available' : 'Not Available') . '</p>';

// Reservation form
echo '<form action="" method="post">';
echo '<input type="hidden" name="carID" value="' . $carDetails['CarID'] . '">';
echo '<label for="startDate">Start Date:</label>';
echo '<input type="date" name="startDate" required>';
echo '<label for="endDate">End Date:</label>';
echo '<input type="date" name="endDate" required>';
echo '<button type="submit">Reserve</button>';
echo '</form>';

// Rent button
echo '<form action="../renting/checkout.php" method="get">';
echo '<input type="hidden" name="carID" value="' . $carDetails['CarID'] . '">';
echo '<button type="submit">Rent</button>';
echo '</form>';

// Handle reservation submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Check for overlapping rentals and reservations
    $overlappingRentals = $car->getOverlappingRentals($carDetails['CarID'], $startDate, $endDate);
    
    if (empty($overlappingRentals)) {
        // No overlapping rentals, proceed with reservation
        $success = $car->reserveCar($carDetails['CarID'], $startDate, $endDate);

        if ($success) {
            echo '<p style="color: green; text-align: center;">Reservation successful!</p>';
        } else {
            echo '<p style="color: red; text-align: center;">Reservation failed. Please try again.</p>';
        }
    } else {
        // Overlapping rentals found, display error message
        echo '<p style="color: red; text-align: center;">Reservation failed. The car is not available for the selected dates.</p>';
    }
}

// Display description
echo '<div style="text-align: center; margin-top: 20px;">';
echo '<h2>Description</h2>';
echo '<p>' . ($carDetails['description'] ? $carDetails['description'] : 'No description available') . '</p>';
echo '</div>';

} else {
    echo '<p style="text-align: center;">Car not found.</p>';
}
        ?>

    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include('../../includes/footer.php'); ?>
</body>
</html>
