<?php
require 'src/Database/Connection.php';

use App\Database\Connection;

try {
    $connection = Connection::getInstance()->getPdo();
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

