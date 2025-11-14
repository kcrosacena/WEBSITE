<?php
session_start();

// Hardcoded credentials (you can connect to a database later)
$validUser = "kristymangubat11@gmail.com";
$validPass = "kcrubio17";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if ($username === $validUser && $password === $validPass) {
    $_SESSION['loggedIn'] = true;
    header("Location: home.php");
    exit;
  } else {
    $_SESSION['error'] = "Incorrect username or password!";
    header("Location: login.php");
    exit;
  }
} else {
  // If someone tries to access loginprocess.php directly
  header("Location: home.php");
  exit;
}
