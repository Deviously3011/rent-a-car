<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Add any additional styles for a consumer-friendly layout */
        body {
            font-family: 'Arial', sans-serif;
        }

        .welcome-section {
            background-color: #f8f9fa;
            padding: 50px 0;
        }

        .welcome-section h1,
        .welcome-section p {
            color: #333;
        }

        .car-list .card {
            transition: transform 0.2s;
        }

        .car-list .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container-fluid">
        <div class="welcome-section text-center">
            <h1>Welcome to Car Rental</h1>
            <p>Discover our diverse selection of rental cars and find the perfect one for your journey!</p>
            <a href="#carSection" class="btn btn-primary">Explore Cars</a>
        </div>

        <div id="carSection" class="container car-list">
            <div class="container">
                <h2>Our Featured Cars</h2>

                <?php
                try {
                    require_once('classes/Car.php');
                    $car = new Car($database);
                    $cars = $car->getAllCars();

                    if ($cars) {
                        echo '<div class="row">';
                        foreach ($cars as $car) {
                            echo '<div class="col-md-4 mb-4">';
                            echo '<div class="card shadow-sm">';
                            echo '<img class="card-img-top" src="assets/img/' . basename($car['Image']) . '" alt="' . $car['Brand'] . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $car['Brand'] . ' ' . $car['Model'] . '</h5>';

                            echo '<div class="d-flex justify-content-between align-items-center">';
                            echo '<a href="pages/car_pages/car_details.php?carID=' . $car['CarID'] . '" class="btn btn-primary">Details</a>';

                            echo '<form action="pages/renting/checkout.php" method="get" class="ml-2">';
                            echo '<input type="hidden" name="carID" value="' . $car['CarID'] . '">';
                            $loggedIn = isset($_SESSION['user']) || isset($_SESSION['admin']);
                            $buttonText = $loggedIn ? 'Rent' : 'Login to Rent';
                            echo $loggedIn ? '<button type="submit" class="btn btn-success">Rent</button>' : '<a href="/car-rental2/pages/login_pages/login.php" class="btn btn-success">Login to Rent</a>';
                            echo '</form>';

                            echo '<div class="collapse" id="carDetails' . $car['CarID'] . '">';
                            echo '<p class="card-text">Year: ' . $car['Year'] . '</p>';
                            echo '<p class="card-text">License Plate: ' . $car['LicensePlate'] . '</p>';
                            echo '<p class="card-text">Availability: ' . ($car['Availability'] ? 'Available' : 'Not Available') . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No cars available.</p>';
                    }
                } catch (Exception $e) {
                    echo '<p>Error: ' . $e->getMessage() . '</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include('includes/footer.php'); ?>
</body>

</html>

<?php
require_once('classes/Admin.php');
require_once('classes/User.php');

session_start();

$admin = new Admin($database);
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $loggedInAdmin = $admin->login($email, $password);

    if ($loggedInAdmin) {
        $_SESSION['admin'] = $loggedInAdmin;
        header("Location: ../admin_pages/admin-dashboard.php");
        exit();
    } else {
        $loggedInUser = $user->login($email, $password);

        if ($loggedInUser) {
            $_SESSION['user'] = $loggedInUser;
            header("Location: /car-rental2/index.php");
            exit();
        } else {
            $loginError = "Login failed. Please check your email and password.";
        }
    }
}

$admin->closeConnection();
$user->closeConnection();
?>
