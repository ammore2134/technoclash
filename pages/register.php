    <!-- register.php -->
    <?php
    include('../pages/config.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $college = $_POST['college'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO users (username, name, college_name, email, phone_no, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $name, $college, $email, $mobile, $password);
        
        if ($stmt->execute()) {
            header("Location: homepage.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../pages/register.css">
        <script defer src="../pages/register.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="register-container">
            <div class="logo-section">
                <img src="../pages/logo.png" alt="TechnoClash Logo">
                <h2>TECHNOCLASH</h2>
                <p>A Clash of Minds in the World of Technology and Engineering!</p>
            </div>
            <form action="" method="POST" class="register-form">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="mobile" placeholder="Mobile No." required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="college" placeholder="College Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <div class="password-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="next-btn">Next</button>
            </form>
        </div>
    </body>
    </html>