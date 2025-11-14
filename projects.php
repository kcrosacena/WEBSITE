<?php
// Database configuration
$host = 'localhost';
$username = 'root';     // XAMPP default
$password = '';         // XAMPP default is empty
$database = 'projects'; // Make sure this database exists

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional debugging
// echo "Connected successfully";
?>
