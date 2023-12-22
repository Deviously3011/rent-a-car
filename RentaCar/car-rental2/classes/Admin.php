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
    public function addCar($brand, $model, $year, $licensePlate, $availability, $carImage) {
        $sql = "INSERT INTO cars (Brand, Model, Year, LicensePlate, Availability, Image) VALUES (?, ?, ?, ?, ?, ?)";
        
        // Use try-catch block for error handling
        try {
            // Assuming $carImage is an array from $_FILES
            $imagePath = $this->uploadImage($carImage); // Implement the image upload function
    
            $stmt = $this->db->query($sql, [$brand, $model, $year, $licensePlate, $availability, $imagePath]);
            // Check if the query was successful
            if ($stmt) {
                return true; // Success
            } else {
                throw new Exception("Error executing query: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Failed
        }
    }
    public function uploadImage($carImage) {
        $targetDirectory = "../assets/img/";
    
        // Ensure the target directory exists; create it if not
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
    
        // Get the original name of the uploaded file
        $originalFileName = $carImage["name"];
    
        // Generate a unique filename to prevent conflicts
        $uniqueFileName = uniqid() . '_' . $originalFileName;
    
        // Construct the full path to the target file
        $targetFile = $targetDirectory . $uniqueFileName;
    
        // Move the uploaded file to the target directory
        if (move_uploaded_file($carImage["tmp_name"], $targetFile)) {
            return $targetFile; // Return the path to the uploaded file
        } else {
            throw new Exception("Error uploading image.");
        }
    }
    
    
    
    
}

$admin = new Admin();

?>
