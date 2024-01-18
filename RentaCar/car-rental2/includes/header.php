<?php
// Use __DIR__ to get the absolute directory path
require_once(__DIR__ . '/../classes/User.php');
require_once(__DIR__ . '/../classes/Admin.php');

// Initialize the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/car-rental2/index.php">AlwaysRentable</a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <?php
                        // Initialize the User and Admin classes
                        $user = new User();
                        $admin = new Admin($database);

                        // Check if the user is logged in
                        if (isset($_SESSION['user'])) {
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/login_pages/logout.php">Logout</a></li>';
                        } elseif (isset($_SESSION['admin'])) {
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/admin_pages/admin-dashboard.php">Admin Dashboard</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/admin_pages/manage-users.php">User Management</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/admin_pages/view-rentals.php">view-rentals</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/login_pages/logout.php">Logout</a></li>';
                            
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/login_pages/login.php">Login</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/car-rental2/pages/login_pages/signup.php">Signup</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
