<?php

require_once('Database.php');

class Car {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getAllCars() {
        $sql = "SELECT * FROM cars";

        try {
            $stmt = $this->db->query($sql);

            if ($stmt) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getCarById($carId) {
        $sql = "SELECT * FROM cars WHERE CarID = ?";
        $result = $this->db->query($sql, [$carId]);

        if ($result && $result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function getCarPrice($carID) {
        $sql = "SELECT PricePerMonth FROM cars WHERE CarID = ?";
        $result = $this->db->query($sql, [$carID]);

        if ($result instanceof PDOStatement && $result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC)['PricePerMonth'];
        } else {
            return null;
        }
    }

    public function rentCarAndGenerateInvoice($carID, $customerID, $startDate, $endDate, $price) {
        $sql = "INSERT INTO rentals (CarID, CustomerID, StartDate, EndDate, Cost) VALUES (?, ?, ?, ?, ?)";

        try {
            $this->db->query($sql, [$carID, $customerID, $startDate, $endDate, $price]);
            return true; // Success
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Failed
        }
    }

    public function reserveCar($carID, $startDate, $endDate) {
        $sql = "INSERT INTO reservations (CarID, StartDate, EndDate) VALUES (?, ?, ?)";
        $result = $this->db->query($sql, [$carID, $startDate, $endDate]);
        return $result !== false;
    }

    public function getOverlappingRentals($carID, $startDate, $endDate) {
        $sql = "SELECT * FROM rentals 
                WHERE CarID = ? 
                AND ((StartDate <= ? AND EndDate >= ?) OR (StartDate <= ? AND EndDate >= ?))";

        $result = $this->db->query($sql, [$carID, $startDate, $startDate, $endDate, $endDate]);
        $overlappingRentals = $result->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($overlappingRentals)) ? $overlappingRentals : [];
    }

    public function getAllReservations() {
        $sql = "SELECT * FROM reservations";
        $result = $this->db->query($sql);

        return ($result instanceof PDOStatement) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function getAllRentals() {
        $sql = "SELECT * FROM rentals";
        $result = $this->db->query($sql);

        return ($result instanceof PDOStatement) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}

$car = new Car($database);

?>
