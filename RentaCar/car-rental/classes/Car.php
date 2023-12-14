<?php

require_once('Database.php');

class Car {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCars() {
        $sql = "SELECT * FROM cars";
        $result = $this->db->executeQuery($sql);

        $cars = array();

        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        return $cars;
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
    public function rentCar($carID, $userID, $startDate, $endDate) {
        // Add your logic here to insert a rental record into the database
        $sql = "INSERT INTO rentals (CarID, UserID, StartDate, EndDate) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->db->query($sql, [$carID, $userID, $startDate, $endDate]);

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

    public function closeConnection() {
        $this->db->closeConnection();
    }
}

$car = new Car();

?>
