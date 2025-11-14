<?php
session_start();
include 'kcportfolio.php'; // Your DB connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if ($password !== $confirm_password) {
        $_SESSION['registerError'] = "Passwords do not match.";
        header("Location: register.php");
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['registerError'] = "Password must be at least 6 characters.";
        header("Location: register.php");
        exit;
    }

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['registerError'] = "Username or Email already exists.";
        $stmt->close();
        header("Location: register.php");
        exit;
    }
    $stmt->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        $_SESSION['loginError'] = "Registration successful! Please log in.";
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['registerError'] = "Registration failed. Try again.";
        $stmt->close();
        $conn->close();
        header("Location: register.php");
        exit;
    }
} else {
    // If accessed directly, redirect to register page
    header("Location: register.php");
    exit;
}
