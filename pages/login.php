<?php
session_start();
include '../pages/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST["username_email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            echo "<script>alert('Login Successful! Redirecting to Home...'); window.location.href = '../pages/home.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid Password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechnoClash</title>
    <link rel="stylesheet" href="../pages/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <div class="logo">
            <img src="../pages/logo.png" alt="TechnoClash Logo">
            <h2>TECHNOCLASH</h2>
        </div>
        <form method="POST" action="login.php">
            <div class="input-group">
                <label>Username or Email</label>
                <input type="text" name="username_email" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <p class="register-link">Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
</div>

<script src="../pages/login.js"></script>
</body>
</html>

