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

    public function closeConnection() {
        $this->db->closeConnection();
    }
}

$car = new Car();

?>
