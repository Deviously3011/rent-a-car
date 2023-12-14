<?php
session_start();

require_once('../classes/Car.php');

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Instantiate the Car class
$car = new Car();

// Check if the carID is set in the query string
if (isset($_GET['carID'])) {
    $carID = $_GET['carID'];

    // Fetch the details of the selected car
    $selectedCar = $car->getCarById($carID);

    if ($selectedCar) {
        // Display the details of the selected car
        echo '<h2>Selected Car Details:</h2>';
        echo 'Brand: ' . $selectedCar['Brand'] . '<br>';
        echo 'Model: ' . $selectedCar['Model'] . '<br>';
        echo 'Year: ' . $selectedCar['Year'] . '<br>';
        echo 'License Plate: ' . $selectedCar['LicensePlate'] . '<br>';
        // Add other details as needed

        // Rent form
        echo '<h3>Rent This Car:</h3>';
        echo '<form method="post" action="rent-process.php">';
        echo '<input type="hidden" name="carID" value="' . $carID . '">';
        // Add other form fields like start date, end date, etc.
        echo '<button type="submit" class="btn btn-success">Rent</button>';
        echo '</form>';
    } else {
        echo 'Car not found.';
    }
} else {
    echo 'Car ID not provided.';
}
?>
