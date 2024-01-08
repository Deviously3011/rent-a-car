User
<?php

require_once('Database.php');
$database = new Database();
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
   
    public function rentCar($carID, $customerID, $StartDate, $EndDate) {
        // Add your logic here to insert a rental record into the database
        $sql = "INSERT INTO rentals (CarID, CustomerID, StartDate, EndDate) VALUES (?, ?, ?, ?)";
    
        try {
            $stmt = $this->db->query($sql, [$carID, $customerID, $StartDate, $EndDate]);
    
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
   
public function getCarPrice($carID) {
        $sql = "SELECT PricePerMonth FROM cars WHERE CarID = ?";
        $result = $this->db->query($sql, [$carID]);

        if ($result instanceof mysqli_result && $result->num_rows > 0) {
            $price = $result->fetch_assoc()['PricePerMonth'];
            $result->close(); // Close the result set
            return $price;
        } else {
            return null;
        }
    }
    
    
    
    
    
    public function rentCarAndGenerateInvoice($carID, $CustomerID, $StartDate, $endDate, $price) {
        // Add your logic here to insert a rental record into the database
        $sql = "INSERT INTO rentals (CarID, CustomerID, StartDate, EndDate, Cost) VALUES (?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->db->query($sql, [$carID, $CustomerID, $StartDate , $endDate, $price]);
    
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
    
}


$car = new Car();

?>
