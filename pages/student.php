<?php
session_start();
include('../pages/config.php'); // Ensure database connection


// Fetch quizzes from database
$query = "SELECT * FROM quizzes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home - Quiz Platform</title>
    
    <!-- Linking CSS from the 'pages' directory -->
    <link rel="stylesheet" href="sthome.css">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h2 class="text-light">normal</h2>
                <ul class="nav flex-column">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Department</a></li>
                    <li><a href="#">Quiz</a></li>
                    <li><a href="#">Question Banks</a></li>
                    <li><a href="#">Solutions</a></li>
                    <li><a href="#">leaderboard</a></li>
                    <li><a href="#">profile</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="header">
                    <button class="btn btn-danger">Contact Us</button>
                    <button class="btn btn-danger">Feedback</button>
                    <button class="btn btn-danger">Help</button>
                    <div class="xp-section">
                        <span>XP</span>
                        <div class="xp-bar"></div>
                    </div>
                </div>

                <!-- Quiz Cards -->
                <div class="quiz-container">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="quiz-card">
                            <h3><?php echo htmlspecialchars($row['quiz_name']); ?></h3>
                            <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                            <button class="btn btn-dark start-btn" onclick="window.location.href='quiz.php?id=<?php echo $row['quiz_id']; ?>'">Start Quiz</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
