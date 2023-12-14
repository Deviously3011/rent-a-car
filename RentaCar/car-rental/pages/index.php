<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
    <script src="assets/js/main.js" defer></script>
</head>

<body>

    <?php include('../includes/header.php'); ?>
    <!-- Include the header file -->

    <div class="container">
        <h1>Welcome to Car Rental</h1>

        <?php
        // Include the Car class
        require_once('../classes/Car.php');

        // Instantiate the Car class
        $car = new Car();

        // Get all cars from the database
        $cars = $car->getAllCars();

        if ($cars) {
            echo '<div class="row">';
            foreach ($cars as $car) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card shadow-sm">';
                echo '<img class="card-img-top" src="/car-rental/assets/img/' . basename($car['Image']) . '" alt="' . $car['Brand'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $car['Brand'] . ' ' . $car['Model'] . '</h5>';
                echo '<button class="btn btn-primary details-btn" data-toggle="collapse" data-target="#carDetails' . $car['CarID'] . '">Details</button>';
                echo '<button class="btn btn-success" data-toggle="modal" data-target="#rentModal">Rent</button>';
                echo '<div class="collapse" id="carDetails' . $car['CarID'] . '">';
                echo '<p class="card-text">Year: ' . $car['Year'] . '</p>';
                echo '<p class="card-text">License Plate: ' . $car['LicensePlate'] . '</p>';
                echo '<p class="card-text">Availability: ' . ($car['Availability'] ? 'Available' : 'Not Available') . '</p>';
                echo '</div>'; // Close collapse
                echo '</div>'; // Close card-body
                echo '</div>'; // Close card
                echo '</div>'; // Close col-md-4
            }
            echo '</div>'; // Close row
        } else {
            echo '<p>No cars available.</p>';
        }
        ?>

    </div>

   <!-- ... -->
<!-- Rent Modal -->
<div class="modal" id="rentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rent Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Rent form -->
                <form action="checkout.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Enter your first name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pickupAddress">Pickup Address</label>
                        <input type="text" class="form-control" id="pickupAddress" placeholder="Enter pickup address">
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                    <!-- Placeholder for price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Calculated Price" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ... -->

    <?php include('../includes/footer.php'); ?>
    <!-- Include the footer file -->

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add any additional JavaScript at the end of the body if needed -->

</body>

</html>
