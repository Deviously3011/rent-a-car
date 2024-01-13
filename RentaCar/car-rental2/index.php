<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <script src="assets/js/main.js" defer></script>
</head>

<body>

    <?php include('includes/header.php'); ?>
    <!-- Include the header file -->

    <div class="container">
        <h1>Welcome to Car Rental</h1>

        <?php
        try {
            // Include the Car class
            require_once('classes/Car.php');

            // Instantiate the Car class
            $car = new Car($database);

            // Get all cars from the database
            $cars = $car->getAllCars();

            // Debugging: Check the content of $cars
            if ($cars) {
                echo '<div class="row">';
                foreach ($cars as $car) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card shadow-sm">';
                    echo '<img class="card-img-top" src="assets/img/' . basename($car['Image']) . '" alt="' . $car['Brand'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $car['Brand'] . ' ' . $car['Model'] . '</h5>';

                    // "Details" button
                    echo '<button class="btn btn-primary details-btn">';
                    echo '<a href="pages/car_pages/car_details.php?carID=' . $car['CarID'] . '">Details</a>';
                    echo '</button>';

                    // Form for "Rent" button
                    echo '<form action="pages/renting/checkout.php" method="get">';
                    echo '<input type="hidden" name="carID" value="' . $car['CarID'] . '">';
                    echo '<button type="submit" class="btn btn-success rent-btn">Rent</button>';
                    echo '</form>';

                    echo '<div class="collapse" id="carDetails' . $car['CarID'] . '">';
                    echo '<p class="card-text">Year: ' . $car['Year'] . '</p>';
                    echo '<p class="card-text">License Plate: ' . $car['LicensePlate'] . '</p>';
                    echo '<p class="card-text">Availability: ' . ($car['Availability'] ? 'Available' : 'Not Available') . '</p>';
                    echo '</div>'; // Close collapse
                    echo '</div>'; // Close card-body
                    echo '</div>'; // Close card
                    echo '</div>'; // Close col-md-4
                }
                echo '</div>';
            } else {
                echo '<p>No cars available.</p>';
            }
        } catch (Exception $e) {
            // Handle exceptions if any
            echo '<p>Error: ' . $e->getMessage() . '</p>';
        }
        ?>

    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
