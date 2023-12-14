<?php
// Add any necessary includes and validations
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

    <?php include('includes/header.php'); ?>
    <!-- Include the header file -->

    <div class="container">
        <h1>Welcome to Car Rental</h1>

        <?php
            // Include the Car class
            require_once(__DIR__ . '/classes/Car.php');

            // Instantiate the Car class
            $car = new Car();

            // Get all cars from the database
            $cars = $car->getAllCars();

            if ($cars) {
                echo '<ul>';
                foreach ($cars as $car) {
                    echo '<li>';
                    echo 'Brand: ' . $car['Brand'] . '<br>';
                    echo 'Model: ' . $car['Model'] . '<br>';
                    echo 'Year: ' . $car['Year'] . '<br>';
                    echo 'License Plate: ' . $car['LicensePlate'] . '<br>';
                    echo 'Availability: ' . ($car['Availability'] ? 'Available' : 'Not Available') . '<br>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No cars available.</p>';
            }
        ?>

    </div>

    <?php include('includes/footer.php'); ?>
    <!-- Include the footer file -->

    <!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
