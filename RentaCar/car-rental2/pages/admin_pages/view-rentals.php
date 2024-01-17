<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Show Reservations and Rentals</title>
</head>
<body>
    <?php include('../../includes/header.php'); ?>
    <div class="container">
        <h1>Show Reservations and Rentals</h1>

        <?php
        // Include the necessary classes and start the session
        require_once('../../classes/Car.php');

        // Instantiate the Car class
        $car = new Car($database);

        // Retrieve all reservations and rentals
        $reservations = $car->getAllReservations();
        // Assuming $carID is some valid value
        $rentals = $car->getAllRentals();

        // Check if a rental cancellation is requested
        if (isset($_POST['cancel_rental'])) {
            $rentalID = $_POST['cancel_rental'];
            $admin->cancelRent($rentalID);
        }

        // Check if a reservation cancellation is requested
        if (isset($_POST['cancel_reservation'])) {
            $reservationID = $_POST['cancel_reservation'];
            $admin->cancelReservation($reservationID);
        }

        // Display reservations in a table
        if (!empty($reservations)) {
            echo '<h2>Reservations</h2>';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th scope="col">Reservation ID</th>';
            echo '<th scope="col">Car ID</th>';
            echo '<th scope="col">Customer ID</th>';
            echo '<th scope="col">Start Date</th>';
            echo '<th scope="col">End Date</th>';
            echo '<th scope="col">Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($reservations as $reservation) {
                echo '<tr>';
                echo '<td>' . $reservation['ReservationID'] . '</td>';
                echo '<td>' . $reservation['CarID'] . '</td>';
                echo '<td>' . $reservation['CustomerID'] . '</td>';
                echo '<td>' . $reservation['StartDate'] . '</td>';
                echo '<td>' . $reservation['EndDate'] . '</td>';
                echo '<td><form method="post"><button type="submit" name="cancel_reservation" value="' . $reservation['ReservationID'] . '" class="btn btn-danger">Cancel</button></form></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No reservations found.</p>';
        }

        // Display rentals in a table
        if (!empty($rentals)) {
            echo '<h2>Rentals</h2>';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th scope="col">Rental ID</th>';
            echo '<th scope="col">Car ID</th>';
            echo '<th scope="col">Customer ID</th>';
            echo '<th scope="col">Start Date</th>';
            echo '<th scope="col">End Date</th>';
            echo '<th scope="col">Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($rentals as $rental) {
                echo '<tr>';
                echo '<td>' . $rental['RentalID'] . '</td>';
                echo '<td>' . $rental['CarID'] . '</td>';
                echo '<td>' . $rental['CustomerID'] . '</td>';
                echo '<td>' . $rental['StartDate'] . '</td>';
                echo '<td>' . $rental['EndDate'] . '</td>';
                echo '<td><form method="post"><button type="submit" name="cancel_rental" value="' . $rental['RentalID'] . '" class="btn btn-danger">Cancel</button></form></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No rentals found.</p>';
        }
        ?>

    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include('../../includes/footer.php'); ?>
</body>
</html>
