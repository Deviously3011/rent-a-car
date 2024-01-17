<?php

require_once('Database.php');

class Admin {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function login($username, $password): ?array {
        try {
            $sql = "SELECT * FROM admins WHERE username = ?";
            $result = $this->db->query($sql, [$username]);

            if ($result instanceof PDOStatement && $result->rowCount() > 0) {
                $admin = $result->fetch(PDO::FETCH_ASSOC);

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
            $targetFile = "../../assets/img/" . $uniqueFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($carImage['tmp_name'], $targetFile)) {
                // File upload successful, proceed with database insertion
                $imagePath = $targetFile; // Store the path to the uploaded file

                // Insert the image path into the database along with other car details
                $sql = "INSERT INTO cars (Brand, Model, Year, LicensePlate, Availability, Image) VALUES (?, ?, ?, ?, ?, ?)";

                // Use try-catch block for error handling
                try {
                    $this->db->query($sql, [$brand, $model, $year, $licensePlate, $availability, $imagePath]);
                    return true; // Success
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
            // Insert the car details without an image
            $sql = "INSERT INTO cars (Brand, Model, Year, LicensePlate, Availability) VALUES (?, ?, ?, ?, ?)";

            // Use try-catch block for error handling
            try {
                $this->db->query($sql, [$brand, $model, $year, $licensePlate, $availability]);
                return true; // Success
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return false; // Failed
            }
        }
    }

    public function editCar($carID, $brand, $model, $year, $licensePlate, $availability, $carImage) {
        $existingCar = $this->getCarById($carID);

        if (!$existingCar) {
            // Car not found
            return false;
        }

        $updatedImage = $existingCar['Image'];

        // Check if a new image is uploaded
        if (!empty($carImage) && $carImage['error'] === 0) {
            // Use the existing image filename
            $uniqueFileName = pathinfo($existingCar['Image'], PATHINFO_BASENAME);
            // Construct the full path to the target file using an absolute path
            $targetFile = __DIR__ . "/../assets/img/" . $uniqueFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($carImage['tmp_name'], $targetFile)) {
                // File upload successful, update the image path
                $updatedImage = $targetFile; // Store the absolute path to the uploaded file
            } else {
                // Handle the case where the file couldn't be moved
                echo "Error moving the uploaded file. Debug: " . print_r(error_get_last(), true);
                return false; // Failed
            }
        }

        $sql = "UPDATE cars SET Brand = ?, Model = ?, Year = ?, LicensePlate = ?, Availability = ?, Image = ? WHERE CarID = ?";
        $params = [$brand, $model, $year, $licensePlate, $availability, $updatedImage, $carID];

        try {
            $this->db->query($sql, $params);

            return true; // Success
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Failed
        }
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM customers";
        $result = $this->db->executeQuery($sql);

        $users = array();

        foreach ($result as $row) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserById($userID) {
        $sql = "SELECT * FROM customers WHERE CustomerID = ?";
        $result = $this->db->query($sql, [$userID]);

        if ($result instanceof PDOStatement && $result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);
            return $user;
        } else {
            // User not found
            return null;
        }
    }

    public function updateUser($userID, $name, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE customers SET name = ?, LastName = ?, email = ?, password = ? WHERE CustomerID = ?";
        $params = [$name, $lastName, $email, $hashedPassword, $userID];

        try {
            $this->db->query($sql, $params);

            return true; // Success
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Failed
        }
    }

    public function deleteUser($userID) {
        $sql = "DELETE FROM customers WHERE CustomerID = ?";
        $params = [$userID];

        try {
            $this->db->query($sql, $params);

            return true; // Success
        } catch (Exception $e) {
            // Log the error for further investigation
            error_log("Error deleting user: " . $e->getMessage());
            return false; // Failed
        }
    }

    public function getCarById($carId) {
        $sql = "SELECT * FROM cars WHERE CarID = ?";
        $result = $this->db->query($sql, [$carId]);

        if ($result instanceof PDOStatement && $result->rowCount() > 0) {
            $car = $result->fetch(PDO::FETCH_ASSOC);
            return $car;
        } else {
            return null;
        }
    }

    public function deleteCar($carID) {
        $sql = "DELETE FROM cars WHERE CarID = ?";
        $params = [$carID];

        try {
            $this->db->query($sql, $params);

            return true; // Success
        } catch (Exception $e) {
            // Log the error for further investigation
            error_log("Error deleting car: " . $e->getMessage());
            return false; // Failed
        }
    }
    public function cancelRent($rentalID) {
        $sql = "DELETE FROM rentals WHERE RentalID = ?";
        $params = [$rentalID];

        try {
            $this->db->query($sql, $params);
            return true; // Success
        } catch (Exception $e) {
            // Log the error for further investigation
            error_log("Error canceling rent: " . $e->getMessage());
            return false; // Failed
        }
    }

    public function cancelReservation($reservationID) {
        $sql = "DELETE FROM reservations WHERE ReservationID = ?";
        $params = [$reservationID];

        try {
            $this->db->query($sql, $params);
            return true; // Success
        } catch (Exception $e) {
            // Log the error for further investigation
            error_log("Error canceling reservation: " . $e->getMessage());
            return false; // Failed
        }
    }
    
}

$admin = new Admin($database);

?>
