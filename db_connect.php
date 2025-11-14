<?php
// Start session to store login status
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$servername = "db.fr-pari1.bengt.wasmernet.com";
$username = "695c3eb874798000bff4f95a1088";
$password = "0691695c-3eb8-75ae-8000-45e90c3677ae";
$dbname = "kcportfolio"; 
$port = "10272";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
