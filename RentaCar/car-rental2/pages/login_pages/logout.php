<?php
// Include the User class
require_once('../../classes/User.php');

// Initialize the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize the User class
$user = new User();

// Log out the user
$user->logout();

// Redirect to the homepage after logout
header("Location: /car-rental2/index.php");
exit();

