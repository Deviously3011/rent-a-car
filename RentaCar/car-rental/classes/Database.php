<?php

require_once(__DIR__ . '/../config/db_config.php');

class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error in query preparation: ' . $this->conn->error);
        }

        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error in query preparation: ' . $this->conn->error);
        }

        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;  // Return the mysqli_stmt object for INSERT operations
    }

    public function signupUser($name, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO customers (name, LastName, email, password) VALUES (?, ?, ?, ?)";
        $params = [$name, $lastName, $email, $hashedPassword];

        // Use the query method for INSERT operations
        return $this->query($query, $params);
    }

    public function isEmailTaken($email) {
        $query = "SELECT * FROM customers WHERE email = ?";
        $params = [$email];
        $result = $this->executeQuery($query, $params);
        return ($result->num_rows > 0);
    }

    public function getUserByEmailAndPassword($email, $password) {
        $query = "SELECT * FROM customers WHERE email = ?";
        $params = [$email];
        $result = $this->executeQuery($query, $params);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return null;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$database = new Database();

?>
