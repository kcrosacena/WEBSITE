<?php
session_start();

// Redirect to portfolio if already logged in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
  header("Location: portfolio.php");
  exit;
}

// Check if an error message exists in the session
$error = "";
if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']); // Clear it after showing
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login | KC’s Portfolio</title>
  <style>
    body {
      font-family: "Calibri", sans-serif;
      background: url('images.jfif') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background: #ffffffd9;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      width: 300px;
      text-align: center;
    }

    .login-box h2 {
      color: #f76767;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 5px;
      border: 1px solid #333;
      outline: none;
    }

    button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background: #f76767;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #d75555;
    }

    .error {
      color: red;
      font-size: 0.9rem;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Welcome to My Portfolio</h2>
    <form method="POST" action="loginprocess.php">
      <input type="text" name="username" placeholder="Enter Username" required />
      <input type="password" name="password" placeholder="Enter Password" required />
      <button type="submit">LOG IN</button>
    </form>

    <?php if ($error): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
   <a href="register.php" class="register-link">Don't have an account? Register</a>
  </div>
</body>
</html>
