<?php

require_once('Database.php');
require_once('Car.php');
$car = new Car();
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
        // Check if an image is uploaded
        if (!empty($carImage) && $carImage['error'] === 0) {
            // Generate a unique filename to prevent conflicts
            $uniqueFileName = uniqid() . '_' . $carImage['name'];
            // Construct the full path to the target file
            $targetFile = "../assets/img/" . $uniqueFileName;
    
            // Move the uploaded file to the target directory
            if (move_uploaded_file($carImage['tmp_name'], $targetFile)) {
                // File upload successful, proceed with database insertion
                $imagePath = $targetFile; // Store the path to the uploaded file
    
                // Insert the image path into the database along with other car details
                $sql = "INSERT INTO cars (Brand, Model, Year, LicensePlate, Availability, Image) VALUES (?, ?, ?, ?, ?, ?)";
    
                // Use try-catch block for error handling
                try {
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
            } else {
                // Handle the case where the file couldn't be moved
                echo "Error moving the uploaded file.";
                return false; // Failed
            }
        } else {
            // Handle the case where no image is uploaded
            echo "Please upload an image.";
            return false; // Failed
        }
    }
    
    
    public function getAllUsers() {
        $sql = "SELECT * FROM customers";
        $result = $this->db->executeQuery($sql);
    
        $users = array();
    
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    
        return $users;
    }
    

    public function getUserById($userID) {
        $sql = "SELECT * FROM customers WHERE CustomerID = ?";
        $result = $this->db->query($sql, [$userID]);
    
        if ($result instanceof mysqli_result) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $result->close(); // Close the result set
                return $user;
            } else {
                // User not found
                return null;
            }
        } else {
            // Error in executing the query
            return null;
        }
    }
    
public function updateUser($userID, $name, $lastName, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE customers SET name = ?, LastName = ?, email = ?, password = ? WHERE CustomerID = ?";
    $params = [$name, $lastName, $email, $hashedPassword, $userID];

    try {
        $stmt = $this->db->query($sql, $params);

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



public function deleteUser($userID) {
    $sql = "DELETE FROM customers WHERE CustomerID = ?";
    $params = [$userID];

    try {
        $stmt = $this->db->query($sql, $params);

        if ($stmt) {
            return true; // Success
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }
    } catch (Exception $e) {
        // Log the error for further investigation
        error_log("Error deleting user: " . $e->getMessage());
        return false; // Failed
    }
}
public function getCarById($carId) {
    $sql = "SELECT * FROM cars WHERE CarID = ?";
    $result = $this->db->query($sql, [$carId]);

    if ($result instanceof mysqli_result && $result->num_rows > 0) {
        $car = $result->fetch_assoc();
        $result->close(); // Close the result set
        return $car;
    } else {
        return null;
    }
}
public function editCar($carID, $brand, $model, $year, $licensePlate, $availability, $carImage) {
    $existingCar = $this->getCarById($carID);

    if (!$existingCar) {
        // Car not found
        return false;
    }

    $updatedImage = null;

    // Check if a new image is uploaded
    if (!empty($carImage) && $carImage['error'] === 0) {
        $updatedImage = $this->addCar($brand, $model, $year, $licensePlate, $availability, $carImage);
        
        if (!$updatedImage) {
            // Handle the case where updating the image failed
            return false;
        }
    } else {
        // No new image uploaded, retain the existing image path
        $updatedImage = $existingCar['Image'];
    }

    $sql = "UPDATE cars SET Brand = ?, Model = ?, Year = ?, LicensePlate = ?, Availability = ?, Image = ? WHERE CarID = ?";
    $params = [$brand, $model, $year, $licensePlate, $availability, $updatedImage, $carID];

    try {
        $stmt = $this->db->query($sql, $params);

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


public function deleteCar($carID) {
    $sql = "DELETE FROM cars WHERE CarID = ?";
    $params = [$carID];

    try {
        $stmt = $this->db->query($sql, $params);

        if ($stmt) {
            return true; // Success
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }
    } catch (Exception $e) {
        // Log the error for further investigation
        error_log("Error deleting car: " . $e->getMessage());
        return false; // Failed
    }
}

    
    
}

$admin = new Admin();

?>
