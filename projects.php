<?php
// Database configuration
$servername = 'db.fr-pari1.bengt.wasmernet.com';
$username = '695c3eb874798000bff4f95a1088';     // XAMPP default
$password = '0691695c-3eb8-75ae-8000-45e90c3677ae';         // XAMPP default is empty
$database = 'kcportfolio'; // Make sure this database exists
$port = '10272';

// Create connection
$conn = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional debugging
// echo "Connected successfully";
?>
