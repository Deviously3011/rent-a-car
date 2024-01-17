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
        $userDetails = $this->db->getUserByEmailAndPassword($email, $password);
    
        if ($userDetails) {
            // Successfully retrieved user details from the database
            // Store the user details in the session
            $_SESSION['user'] = $userDetails;
    
            // Return true to indicate successful login
            return true;
        } else {
            // Invalid login credentials
            return false;
        }
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

        if ($result instanceof PDOStatement && $result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);
            return $user['CustomerID'];
        } else {
            return null;
        }
    }
}

$user = new User();

?>
