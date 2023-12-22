<?php

require_once('Database.php');

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function signup($name, $lastName, $email, $password) {
        if ($this->isEmailTaken($email)) {
            return false; // Email is already taken
        }
    
        return $this->db->signupUser($name, $lastName, $email, $password);
    }
    

    private function isEmailTaken($email) {
        return $this->db->isEmailTaken($email);
    }

    public function login($email, $password) {
        return $this->db->getUserByEmailAndPassword($email, $password);
    }

    public function logout() {
        session_destroy();
        return true;
    }
    public function closeConnection() {
        $this->db->closeConnection();
    }
    public function getCustomerIdByEmail($email) {
        $sql = "SELECT CustomerID FROM customers WHERE email = ?";
        $result = $this->db->query($sql, [$email]);

        if ($result instanceof mysqli_result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $result->close(); // Close the result set
            return $user['CustomerID'];
        } else {
            return null;
        }
    }
    
}

$user = new User();

?>
