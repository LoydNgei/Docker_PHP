<?php
// test_connection.php

require_once 'src/Database/Connection.php';

try {
    $pdo = \App\Database\Connection::getInstance()->getPdo();
    echo "Connected to MySQL successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
