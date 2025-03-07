<?php
session_start();
include 'pages/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Store session
        $_SESSION['user_name'] = $row['username']; // Ensure this matches your column name
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechnoClash</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <div class="logo">
            <img src="pages/logo.png" alt="TechnoClash Logo">
            <h2>TECHNOCLASH</h2>
        </div>
        <form method="POST" action="pages/select-type.php">
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
        <p class="register-link">Don't have an account? <a href="pages/register.php">Sign Up</a></p>
    </div>
</div>

<script src="login.js"></script>
</body>
</html>

