<?php
// Include the User class
require_once('../../classes/User.php');

// Initialize the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize the User class
$user = new User();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Attempt to signup the user
    if ($user->signup($name, $lastName, $email, $password)) {
        // Redirect to the login page or dashboard upon successful signup
        header("Location: login.php");
        exit();
    } else {
        // Handle signup failure (email already taken or other errors)
        $signupError = "Signup failed. Please try again.";
    }
}

// Close the database connection
$user->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Car Rental</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

    <?php include('../../includes/header.php'); ?>

    <div class="container">
        <h2>Signup</h2>

        <?php
        if (isset($signupError)) {
            echo '<p class="error-message">' . $signupError . '</p>';
        }
        ?>

        <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Signup</button>
        </form>
    </div>

 
    </div>

    <?php include('../../includes/footer.php'); ?>

    <!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
