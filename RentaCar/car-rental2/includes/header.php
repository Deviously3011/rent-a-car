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
</head>
<body>

    <header>
        <nav>
            <div class="upper-navbar">
                <div class="logo">
                    <a href="/car-rental2/index.php">Car Rental</a>
                </div>
                <div class="auth-buttons">
                    <?php
                    // Initialize the User and Admin classes
                    $user = new User();
                    $admin = new Admin();

                    // Check if the user is logged in
                    if (isset($_SESSION['user'])) {
                        echo '<a href="/car-rental2/pages/login_pages/logout.php">Logout</a>';
                    } elseif (isset($_SESSION['admin'])) {
                        echo '<a href="/car-rental2/pages/login_pages/logout.php">Logout</a>';
                        echo '<a href="/car-rental2/pages/admin-dashboard.php">Admin Dashboard</a>';
                    } else {
                        echo '<a href="/car-rental2/pages/login_pages/login.php">Login</a>';
                        echo '<a href="/car-rental2/pages/login_pages/signup.php">Signup</a>';
                    }
                    ?>
                </div>
            </div>
            <div class="bottom-navbar">
                <!-- Add any additional navigation links here -->
            </div>
        </nav>
    </header>

</body>
</html>
