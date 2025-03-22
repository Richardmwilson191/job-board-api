<?php

namespace app\Core;

use PDO;

class Database
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $conn;
    private $options;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?: '127.0.0.1';
        $this->db = getenv('DB_NAME') ?: 'job_board';
        $this->user = getenv('DB_USER') ?: 'root';
        $this->pass = getenv('DB_PASSWORD') ?: '';

        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db}";
            $this->conn = new PDO($dsn, $this->user, $this->pass, $this->options);
            return true;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }


    public function closeConnection()
    {
        $this->conn = null;
    }
}
