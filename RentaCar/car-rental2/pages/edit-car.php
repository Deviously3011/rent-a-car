<?php
require_once('../classes/Admin.php');
require_once('../classes/Car.php');

session_start();

$admin = new Admin();
$car = new Car();

// Check if the admin is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin-specific information
$adminInfo = $_SESSION['admin'];

// Check if the car ID is provided in the URL
if (isset($_GET['id'])) {
    $editCarID = $_GET['id'];

    // Check if the form is submitted for updating car details
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCar'])) {
        // Get form data for updating
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $licensePlate = $_POST['licensePlate'];
        $availability = isset($_POST['availability']) ? 1 : 0; // Assuming a checkbox for availability

        // Handle image upload
        if (isset($_FILES['carImage'])) {
            $carImage = $_FILES['carImage'];

            // Add your logic to update the car in the database using the Admin class
            // Example: $admin->editCar($editCarID, $brand, $model, $year, $licensePlate, $availability, $carImage);
            // Don't forget to implement the 'editCar' method in your Admin class
            // Redirect or display a success message as needed
            $admin->editCar($editCarID, $brand, $model, $year, $licensePlate, $availability, $carImage);
        } else {
            // Handle the case where no image is uploaded
            echo "Please upload an image.";
        }
    }

    // Fetch the car data based on the ID
    $carData = $admin->getCarById($editCarID);

    // Check if the car exists
    if ($carData !== null) {
        // Pre-fill the form fields with the existing data
        $brand = $carData['Brand'];
        $model = $carData['Model'];
        $year = $carData['Year'];
        $licensePlate = $carData['LicensePlate'];
        $availability = $carData['Availability'];
        // You may want to exclude image pre-filling for security reasons
    } else {
        // Handle the case where the car ID is not valid
        echo 'Invalid car ID';
        exit();
    }
} else {
    // Handle the case where the car ID is not provided in the URL
    echo 'Car ID not provided';
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <!-- Bootstrap CSS or any other styling -->
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Car Management</a>
    <!-- Add navigation links if needed -->
</nav>

<div class="container">
    <h1 class="mt-4">Edit Car</h1>
    <form action="edit-car.php?id=<?php echo $editCarID; ?>" method="post" enctype="multipart/form-data">
        <!-- Add a hidden input field to store the car ID -->
        <input type="hidden" name="carID" value="<?php echo $editCarID; ?>">

        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" name="brand" class="form-control" value="<?php echo $brand; ?>" required>
        </div>

        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" value="<?php echo $model; ?>" required>
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" name="year" class="form-control" value="<?php echo $year; ?>" required>
        </div>

        <div class="form-group">
            <label for="licensePlate">License Plate:</label>
            <input type="text" name="licensePlate" class="form-control" value="<?php echo $licensePlate; ?>" required>
        </div>

        <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability" <?php echo ($availability == 1) ? 'checked' : ''; ?>>
        </div>

        <div class="form-group">
            <label for="carImage">Car Image:</label>
            <input type="file" name="carImage" accept="image/*">
        </div>

        <!-- Use different names for the submit buttons -->
        <button type="submit" name="updateCar" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
