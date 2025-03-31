<?php

class Database
{
    private $config = [
        "host" => "localhost",
        "port" => 3306,
        "dbname" => "pet_shop",
        "charset" => "utf8mb4",
        "user" => "root",
        "password" => ""
    ];

    private $pdo;

    public function __construct()
    {
        $dsnWithoutDb = "mysql:host={$this->config['host']};port={$this->config['port']};charset={$this->config['charset']}";
        $dsnWithDb = "mysql:" . http_build_query($this->config, "", ";");

        try {
            // Attempt to connect to the database directly
            $this->pdo = new PDO($dsnWithDb, $this->config['user'], $this->config['password']);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo "Connected to the database '{$this->config['dbname']}' successfully.\n";
        } catch (PDOException $e) {
            if ($e->getCode() === 1049) { // Unknown database error
                echo "Database '{$this->config['dbname']}' does not exist. Creating it...\n";
                $this->createDatabase($dsnWithoutDb);
                $this->pdo = new PDO($dsnWithDb, $this->config['user'], $this->config['password']);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                echo "Connected to the newly created database '{$this->config['dbname']}' successfully.\n";
            } else {
                die("Database connection failed: " . $e->getMessage());
            }
        }
    }

    private function createDatabase($dsn)
    {
        try {
            $pdo = new PDO($dsn, $this->config['user'], $this->config['password']);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$this->config['dbname']}` CHARACTER SET {$this->config['charset']}");
            echo "Database '{$this->config['dbname']}' created successfully.\n";
        } catch (PDOException $e) {
            die("Error creating database: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
}
