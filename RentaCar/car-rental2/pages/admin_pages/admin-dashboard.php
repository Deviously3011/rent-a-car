<?php
// Include the necessary classes and start the session
require_once('../../classes/Database.php');
require_once('../../classes/Admin.php');
require_once('../../classes/Car.php');

session_start();

// Initialize the Database, Admin, and Car classes
$database = new Database();
$admin = new Admin($database);
$car = new Car($database);

// Check if the admin is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin-specific information
$adminInfo = $_SESSION['admin'];

// Handle car deletion
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_car_id'])) {
    $deleteCarID = $_GET['delete_car_id'];

    // Perform the deletion here using your deleteCar method
    $deleteResult = $admin->deleteCar($deleteCarID);

    // Redirect to the admin dashboard or any other desired page after deletion
    if ($deleteResult) {
        header("Location: admin-dashboard.php");
        exit();
    } else {
        echo '<p>Failed to delete car. Please try again.</p>';
    }
}

// Handle car addition form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCar'])) {
    // Process the form data and add the car to the database
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $licensePlate = $_POST['licensePlate'];
    $availability = isset($_POST['availability']) ? 1 : 0; // Assuming a checkbox for availability
    $carImage = $_FILES['carImage'];

    // Call the addCar function in the Admin class
    $addCarResult = $admin->addCar($brand, $model, $year, $licensePlate, $availability, $carImage);

    // Redirect or display a success message as needed
    if ($addCarResult) {
        header("Location: admin-dashboard.php");
        exit();
    } else {
        echo '<p>Failed to add car. Please try again.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Car Rental</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

<?php include('../../includes/header.php'); ?>

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
    <input type="file" id="carImage" name="carImage" accept="image/*" required>

    <button type="submit" name="addCar">Add Car</button>
</form>




    <!-- Display List of Cars in Admin Dashboard -->
<h3>Car Data:</h3>
<table border="1">
    <tr>
        <th>Car ID</th>
        <th>Brand</th>
        <th>Model</th>
       
        <th>Actions</th>
    </tr>
    <?php
    // Fetch all cars
    $cars = $car->getAllCars();

    foreach ($cars as $car):
    ?>
        <tr>
            <td><?php echo $car['CarID']; ?></td>
            <td><?php echo $car['Brand']; ?></td>
            <td><?php echo $car['Model']; ?></td>
            
            <!-- Edit and Delete buttons -->
            <td>
                <a href="edit-car.php?id=<?php echo $car['CarID']; ?>">Edit</a>
                |
                <a href="?delete_car_id=<?php echo $car['CarID']; ?>" onclick="return confirm('Are you sure you want to delete this car?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


    
</div>

<?php include('../../includes/footer.php'); ?>

<!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
