<?php
// Include the Admin class and connect to the database
require_once('../classes/Admin.php');
$admin = new Admin();

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $editUserID = $_GET['id'];

    // Check if the form is submitted for updating user details
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
        // Get form data for updating
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password']; // You may want to add password confirmation and validation here

        // Update user details in the database
        $updateResult = $admin->updateUser($editUserID, $name, $lastName, $email, $password);

        // Redirect to the home page or any other desired page after updating
        if ($updateResult) {
            header("Location: home.php");
            exit();
        } else {
            echo '<p>Failed to update user. Please try again.</p>';
        }
    }

    // Check if the form is submitted for deleting
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
        // Delete user from the database
        $deleteResult = $admin->deleteUser($editUserID);

        // Redirect to the home page or any other desired page after deletion
        if ($deleteResult) {
            header("Location: home.php");
            exit();
        } else {
            echo '<p>Failed to delete user. Please try again.</p>';
        }
    }

    // Fetch the user data based on the ID
$user = $admin->getUserById($editUserID);

// Check if the user exists
if ($user !== null) {
    // Pre-fill the form fields with the existing data
    $name = $user['name'];
    $lastName = $user['LastName'];
    $email = $user['email'];
    // You may want to exclude password pre-filling for security reasons
} else {
    // Handle the case where the user ID is not valid
    echo 'Invalid user ID';
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS or any other styling -->
    <!-- Add any additional CSS or JavaScript dependencies here -->
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">User Management</a>
    <!-- Add navigation links if needed -->
</nav>

<div class="container">
    <h1 class="mt-4">Edit User</h1>
    <form action="edit-user.php?id=<?php echo $editUserID; ?>" method="post">
        <!-- Add a hidden input field to store the user ID -->
        <input type="hidden" name="userID" value="<?php echo $editUserID; ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Use different names for the submit buttons -->
        <button type="submit" name="updateUser" class="btn btn-primary">Save Changes</button>

        <!-- Add a Delete button -->
        <button type="submit" name="deleteUser" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
    </form>
</div>

<!-- Add any additional JavaScript at the end of the body if needed -->

</body>
</html>
