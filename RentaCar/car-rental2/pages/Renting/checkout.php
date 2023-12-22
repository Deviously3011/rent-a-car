<?php
// Include the RentalCalculator class
require_once('../../classes/RentalCalculator.php');
require_once('../../classes/Database.php'); // Assuming you have a Database class
require_once('../../classes/Car.php'); // Assuming you have a Car class
require_once('../../classes/User.php'); // Assuming you have a User class

// Create instances of the necessary classes
$car = new Car();
$user = new User();

// Retrieve car ID from the query parameter
$carID = isset($_GET['carID']) ? htmlspecialchars($_GET['carID']) : '';

// Display Car ID
echo '<h2>Car ID:</h2>';
echo '<p>' . $carID . '</p>';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $email = $_POST['email'];

    // Retrieve customer ID based on email
    $customerID = $user->getCustomerIdByEmail($email);

    // Get the car's price from the database
  
// Get the car's price from the database
$carPrice = $car->getCarPrice($carID);

// Debugging: Print the car price
echo "Car Price: €" . $carPrice . "<br>";

// Calculate the rental cost using the RentalCalculator class
$rentalCost = RentalCalculator::calculateRentalCost($carPrice, $startDate, $endDate);

// Debugging: Print the parameters and calculated rental cost
echo "Car Price Per Month: €" . $carPrice . "<br>";
echo "Start Date: " . $startDate . "<br>";
echo "End Date: " . $endDate . "<br>";
echo "Calculated Rental Cost: €" . number_format($rentalCost, 2) . "<br>";

// Rent the car and generate invoice
$rentalSuccess = $car->rentCarAndGenerateInvoice($carID, $customerID, $startDate, $endDate, $rentalCost);

   // Calculate the rental cost using the RentalCalculator class
$rentalCost = RentalCalculator::calculateRentalCost($carPrice, $startDate, $endDate);

// Debugging: Print the calculated rental cost
echo "Calculated Rental Cost: €" . number_format($rentalCost, 2) . "<br>";

// Rent the car and generate invoice
$rentalSuccess = $car->rentCarAndGenerateInvoice($carID, $customerID, $startDate, $endDate, $rentalCost);
    // Rent the car and generate invoice
    $rentalSuccess = $car->rentCarAndGenerateInvoice($carID, $customerID, $startDate, $endDate, $rentalCost);

    if ($rentalSuccess) {
        // Display the invoice to the user
        echo '<div class="container">';
        echo '<h1>Factuur</h1>';
        echo '<p>Car Rental Details:</p>';
        echo '<p>Car ID: ' . $carID . '</p>';
        echo '<p>Start Date: ' . $startDate . '</p>';
        echo '<p>End Date: ' . $endDate . '</p>';
        echo '<p>Total Cost: €' . number_format($rentalCost, 2) . '</p>';
        echo '</div>';
    } else {
        echo '<p>Failed to process the rental. Please try again.</p>';
    }
} else {
    // Default value if form is not yet submitted
    $rentalCost = 0;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/custom/style.css"> <!-- Add your custom styles if needed -->
</head>

<body>

    <?php include('../../includes/header.php'); ?>
    <!-- Include the header file -->

    <div class="container">
        <h1>Checkout</h1>

        <?php
        // Retrieve car ID from the query parameter
        $carID = htmlspecialchars($_GET['carID'] ?? '');

        // Display Car ID
        echo '<h2>Car ID:</h2>';
        echo '<p>' . $carID . '</p>';
        ?>

        <form action="" method="post">
            <h2>Your Details</h2>

            <!-- User details form -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter your postcode" required>
                </div>
            </div>

            <!-- Renting details form -->
            <h2>Renting Details</h2>
            <div class="form-group">
                <label for="startDate">Start Date</label>
                <input type="date" class="form-control" id="startDate" name="startDate" required>
            </div>
            <div class="form-group">
                <label for="endDate">End Date</label>
                <input type="date" class="form-control" id="endDate" name="endDate" required>
            </div>
            
            <!-- Placeholder for price -->
            <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Calculated Price" value="<?php echo isset($rentalCost) ? $rentalCost : ''; ?>" readonly>
            </div>


            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Add event listeners for date change
                const startDateInput = document.getElementById('startDate');
                const endDateInput = document.getElementById('endDate');
                const priceInput = document.getElementById('price');

                startDateInput.addEventListener('change', updatePrice);
                endDateInput.addEventListener('change', updatePrice);

                function updatePrice() {
                    // Get selected dates
                    const startDate = startDateInput.value;
                    const endDate = endDateInput.value;

                    // Calculate the price using PHP values
                    <?php
                    // Get the car price per month (adjust this based on your actual pricing)
                    $carPricePerMonth = 1000; // Replace with your actual value
                    echo "const pricePerDay = " . ($carPricePerMonth * 12 / 365) . ";";
                    ?>

                    const rentalPeriod = (new Date(endDate) - new Date(startDate)) / (24 * 60 * 60 * 1000); // Calculate days
                    const calculatedPrice = pricePerDay * rentalPeriod;

                    // Update the price field
                    priceInput.value = calculatedPrice.toFixed(2); // Format to two decimal places
                }
            });
        </script>
    </div>

    <?php include('../../includes/footer.php'); ?>
    <!-- Include the footer file -->

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
