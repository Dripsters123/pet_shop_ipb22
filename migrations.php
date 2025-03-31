<?php
$host = 'localhost';
$dbname = 'pet_shop';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$migrationPath = __DIR__ . '/migrations';


$migrationFiles = array_diff(scandir($migrationPath), ['.', '..']);
sort($migrationFiles);

foreach ($migrationFiles as $file) {
    $filePath = $migrationPath . '/' . $file;

    if (pathinfo($filePath, PATHINFO_EXTENSION) === 'sql') {
        echo "Processing migration: $file\n";

        try {
            $query = file_get_contents($filePath);
            $pdo->exec($query);
            echo "Migration $file executed successfully.\n";
        } catch (Exception $e) {
            echo "Error executing migration $file: " . $e->getMessage() . "\n";
        }
    }
}

echo "All migrations have been executed.\n";
