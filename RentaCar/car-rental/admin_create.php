<?php

require_once('classes/Database.php');   

// Initialize the Database class
$database = new Database();

// Admin credentials
$username = 'admin@2';
$password = 'admin';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Add the admin to the database
$sql = "INSERT INTO admins (username, hashed_password) VALUES (?, ?)";
$params = [$username, $hashedPassword];

$result = $database->query($sql, $params);

if ($result) {
    echo "Admin added successfully.";
} else {
    
}

// Close the database connection
$database->closeConnection();

?>
