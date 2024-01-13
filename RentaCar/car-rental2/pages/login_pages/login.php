<?php
// Include the Admin and User classes
require_once('../../classes/Admin.php');
require_once('../../classes/User.php');

// Initialize the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize the Admin and User classes
$admin = new Admin($database);
$user = new User();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Attempt to log in the admin
    $loggedInAdmin = $admin->login($email, $password);

    if ($loggedInAdmin) {
        // Set admin session
        $_SESSION['admin'] = $loggedInAdmin;

        // Redirect to admin dashboard upon successful login
        header("Location: ../admin_pages/admin-dashboard.php");
        exit();
    } else {
        // Attempt to log in the regular user
        $loggedInUser = $user->login($email, $password);

        if ($loggedInUser) {
            // Set user session
            $_SESSION['user'] = $loggedInUser;

            // Redirect regular users to the home page or their dashboard
            header("Location: /car-rental2/index.php");
            exit();
        } else {
            // Handle login failure
            $loginError = "Login failed. Please check your email and password.";
        }
    }
}

// Close the database connections
$admin->closeConnection();
$user->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Car Rental</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

    <?php include('../../includes/header.php'); ?>

    <div class="container">
        <h2>Login</h2>

        <?php
        if (isset($loginError)) {
            echo '<p class="error-message">' . $loginError . '</p>';
        }
        ?>

        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

    <?php include('../../includes/footer.php'); ?>

    <!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
