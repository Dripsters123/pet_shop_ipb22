<?php
require_once 'Database.php';

try {
    // Initialize the Database class
    $db = new Database();

    // Path to the migrations folder
    $migrationPath = __DIR__ . '/migrations';

    // Fetch migration files
    $migrationFiles = array_diff(scandir($migrationPath), ['.', '..']);
    sort($migrationFiles); // Ensure files are sorted by name

    foreach ($migrationFiles as $file) {
        $filePath = $migrationPath . '/' . $file;

        if (pathinfo($filePath, PATHINFO_EXTENSION) === 'sql') {
            echo "Processing migration: $file\n";

            // Execute migration
            try {
                $query = file_get_contents($filePath);
                $db->query($query);
                echo "Migration $file executed successfully.\n";
            } catch (Exception $e) {
                echo "Error executing migration $file: " . $e->getMessage() . "\n";
            }
        }
    }

    echo "All migrations have been executed.\n";
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
}
