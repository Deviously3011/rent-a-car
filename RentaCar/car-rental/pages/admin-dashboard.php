<?php
// Include the necessary classes and start the session
require_once('../classes/Admin.php');
session_start();

// Initialize the Admin class
$admin = new Admin();

// Check if the admin is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin-specific information
$adminInfo = $_SESSION['admin'];

// Handle car addition form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCar'])) {
    // Process the form data and add the car to the database
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $licensePlate = $_POST['licensePlate'];
    $availability = isset($_POST['availability']) ? 1 : 0; // Assuming a checkbox for availability

    // Add your logic to insert the car into the database using the Admin class
    // Example: $admin->addCar($brand, $model, $year, $licensePlate, $availability);
    // Don't forget to implement the 'addCar' method in your Admin class
    // Redirect or display a success message as needed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Car Rental</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h2>Admin Dashboard</h2>

    <p>Welcome, <?php echo $adminInfo['username']; ?>!</p>

    <h3>Manage Cars:</h3>

    <!-- Car Addition Form -->
    <form method="post" action="" enctype="multipart/form-data">
        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" required>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required>

        <label for="licensePlate">License Plate:</label>
        <input type="text" id="licensePlate" name="licensePlate" required>

        <label for="availability">Availability:</label>
        <input type="checkbox" id="availability" name="availability">

        <label for="carImage">Car Image:</label>
    <input type="file" id="carImage" name="carImage" accept="image/*">

    <button type="submit" name="addCar">Add Car</button>
    </form>

    <!-- Display List of Cars -->
    <?php
    // Add PHP code to fetch and display list of cars
    ?>

</div>

<?php include('../includes/footer.php'); ?>

<!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
