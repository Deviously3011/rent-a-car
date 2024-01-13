<?php

require_once(__DIR__ . '/../config/db_config.php');

class Database {
    private $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->conn = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function executeQuery($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error in query preparation: ' . implode(', ', $this->conn->errorInfo()));
        }

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Error in query preparation: ' . implode(', ', $this->conn->errorInfo()));
        }

        $stmt->execute($params);

        if ($stmt->errorCode() !== '00000') {
            die('Error executing query: ' . implode(', ', $stmt->errorInfo()));
        }

        return $stmt;
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
        return (count($result) > 0);
    }

    public function getUserByEmailAndPassword($email, $password) {
        $query = "SELECT * FROM customers WHERE email = ?";
        $params = [$email];
        $result = $this->executeQuery($query, $params);

        if (count($result) > 0) {
            $user = $result[0];
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return null;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}

$database = new Database();

?>
