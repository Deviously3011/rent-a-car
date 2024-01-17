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
        echo '<p class="text-danger">Failed to delete car. Please try again.</p>';
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
        echo '<p class="text-danger">Failed to add car. Please try again.</p>';
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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <?php include('../../includes/header.php'); ?>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <p>Welcome, <?php echo $adminInfo['username']; ?>!</p>

        <h3>Manage Cars:</h3>

       <!-- Car Addition Form -->
<div class="card mt-4">
    <div class="card-body">
        <h3 class="card-title">Add New Car</h3>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>

            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>

            <div class="form-group">
                <label for="licensePlate">License Plate:</label>
                <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="availability" name="availability">
                <label class="form-check-label" for="availability">Available</label>
            </div>

            <div class="form-group">
                <label for="carImage">Car Image:</label>
                <input type="file" class="form-control-file" id="carImage" name="carImage" accept="image/*" required>
            </div>

            <button type="submit" name="addCar" class="btn btn-primary">Add Car</button>
        </form>
    </div>
</div>

        <!-- Display List of Cars in Admin Dashboard -->
        <h3>Car Data:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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
                            <a href="edit-car.php?id=<?php echo $car['CarID']; ?>" class="btn btn-info">Edit</a>
                            <a href="?delete_car_id=<?php echo $car['CarID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('../../includes/footer.php'); ?>

    <!-- Add any additional JavaScript at the end of the body if needed -->

</body>

</html>
