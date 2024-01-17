<?php
// Include the necessary classes and start the session
require_once('../../classes/Admin.php');
session_start();

// Initialize the Admin class
$admin = new Admin($database);

// Check if the admin is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin-specific information
$adminInfo = $_SESSION['admin'];

// Handle Delete Action
if (isset($_GET['delete_id'])) {
    $deleteUserID = $_GET['delete_id'];
    $deleteResult = $admin->deleteUser($deleteUserID);

    if ($deleteResult) {
        echo '<p class="success-message">User deleted successfully.</p>';
        // You may choose to refresh the page or redirect after deletion
    } else {
        echo '<p class="error-message">Failed to delete user. Please try again.</p>';
    }
}

// Fetch all users
$users = $admin->getAllUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Users</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Add any additional CSS or JavaScript dependencies here -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            text-decoration: none;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<?php include('../../includes/header.php'); ?>

<div class="container">
    <h2>Admin Dashboard - Manage Users</h2>

    <p>Welcome, <?php echo $adminInfo['username']; ?>!</p>

    <!-- Display User Data -->
    <h3>User Data:</h3>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['CustomerID']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['LastName']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="edit-user.php?id=<?php echo $user['CustomerID']; ?>">Edit</a>
                    |
                    <a href="?delete_id=<?php echo $user['CustomerID']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include('../../includes/footer.php'); ?>



</body>
</html>
