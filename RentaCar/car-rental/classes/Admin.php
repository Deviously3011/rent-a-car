<?php

require_once('Database.php');

class Admin {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($username, $password): ?array {
        try {
            $sql = "SELECT * FROM admins WHERE username = ?";
            $stmt = $this->db->query($sql, [$username]);

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();

                // Verify hashed password
                if (password_verify($password, $admin['hashed_password'])) {
                    return $admin;
                } else {
                    throw new Exception('Password verification failed.');
                }
            } else {
                throw new Exception('No admin found with the provided username.');
            }
        } catch (Exception $e) {
            // Log or handle the exception as needed
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    public function closeConnection() {
        $this->db->closeConnection();
    }
    public function addCar($make, $model, $year, $price, $imagePath) {
        $sql = "INSERT INTO cars (make, model, year, price, image_path) VALUES (?, ?, ?, ?, ?)";
        
        // Use try-catch block for error handling
        try {
            // Check if the file exists before attempting to move it
            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found at: " . $imagePath);
            }
    
            $stmt = $this->db->query($sql, [$make, $model, $year, $price, $imagePath]);
    
            // Check if the query was successful
            if ($stmt) {
                return true; // Success
            } else {
                throw new Exception("Error executing query: " . $stmt->error);
            }
        } catch (Exception $e) {
            // Log the error or handle it as needed
            error_log("Error adding car: " . $e->getMessage());
            return false; // Failed
        }
    }
    
    
}

$admin = new Admin();

?>
