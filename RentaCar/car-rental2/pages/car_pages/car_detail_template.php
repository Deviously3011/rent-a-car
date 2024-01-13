<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css"> <!-- Update the path -->
</head>

<body>

<?php include('../../includes/header.php'); ?>
<?php require_once('../../classes/Car.php'); ?>

    <div class="container">
        <?php
        // Include the Car class and instantiate it with the Database
        require_once('../../classes/Car.php'); // Update the path
        $car = new Car($database);

        // Retrieve car ID from the query parameter
        $carID = isset($_GET['carID']) ? htmlspecialchars($_GET['carID']) : '';

        // Fetch car details by ID
        $carDetails = $car->getCarById($carID);

        if ($carDetails) {
            // Display car image largely in the upper middle
            echo '<div class="text-center my-4">';
            echo '<img src="../../assets/img/' . basename($carDetails['Image']) . '" alt="' . $carDetails['Brand'] . '">';
            echo '</div>';

            // Buttons for reserve and rent
            echo '<div class="text-center mb-4">';
            echo '<button class="btn bt n-primary">Reserve</button>';
            echo '<button class="btn btn-success">Rent</button>';
            echo '</div>';

            // Basic car details
            echo '<div>';
            echo '<h2>' . $carDetails['Brand'] . ' ' . $carDetails['Model'] . '</h2>';
            echo '<p>Year: ' . $carDetails['Year'] . '</p>';
            echo '<p>License Plate: ' . $carDetails['LicensePlate'] . '</p>';
            echo '<p>Availability: ' . ($carDetails['Availability'] ? 'Available' : 'Not Available') . '</p>';
            // Add more basic details as needed
            echo '</div>';

            // Additional details and fun facts
            echo '<div class="mt-4">';
            echo '<h3>Special Details</h3>';
            echo '<p>This car comes with...</p>';
            // Add more special details as needed

            echo '<h3>Fun Facts</h3>';
            echo '<p>Did you know...</p>';
            // Add more fun facts as needed
            echo '</div>';
        } else {
            // Handle the case where the car details are not found
            echo '<p>Car details not found.</p>';
        }
        ?>
    </div>

    <?php include('../../includes/footer.php'); ?> <!-- Update the path -->

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
