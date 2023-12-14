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
    
    
}

$user = new User();

?>
