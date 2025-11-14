<?php
session_start();

// Redirect to portfolio if already logged in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header("Location: portfolio.php");
    exit;
}

// Check for registration error
$registerError = isset($_SESSION['registerError']) ? $_SESSION['registerError'] : "";
unset($_SESSION['registerError']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register | KC’s Portfolio</title>
  <style>
    body {
      font-family: "Calibri", sans-serif;
      background: url('background.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .box {
      background: #ffffffd9;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      width: 300px;
      text-align: center;
    }

    .box h2 {
      color: #f76767;
      margin-bottom: 20px;
    }

    input, button {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 5px;
      outline: none;
    }

    input { border: 1px solid #333; }
    button {
      border: none;
      background: #f76767;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { background: #d75555; }

    .error { color: red; font-size: 0.9rem; margin-top: 10px; }

    .login-link { margin-top: 10px; display: block; color: #f76767; text-decoration: none; }
    .login-link:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Register</h2>
    <form method="POST" action="registerprocess.php">
      <input type="text" name="username" placeholder="Choose Username" required />
      <input type="email" name="email" placeholder="Enter Email" required />
      <input type="password" name="password" placeholder="Choose Password" required />
      <input type="password" name="confirm_password" placeholder="Confirm Password" required />
      <button type="submit">REGISTER</button>
    </form>
    <?php if ($registerError): ?>
      <p class="error"><?= $registerError ?></p>
    <?php endif; ?>
    <a href="login.php" class="login-link">Already have an account? Login</a>
  </div>
</body>
</html>
