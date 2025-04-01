<?php
// Start Session
session_start();

    // Create Constants to Store Non-Repeating Values
    define('SITEURL', 'http://localhost');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'shop_db');

    // Database Connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check if connection was successful
    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }



