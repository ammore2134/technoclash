<?php
include '../pages/config.php'; // Database connection

$stream_filter = isset($_GET['stream']) ? $_GET['stream'] : 'ALL';

$sql = "SELECT * FROM gate_quizzes";
if ($stream_filter !== 'ALL') {
    $sql .= " WHERE stream = '$stream_filter'";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>GATE Dashboard</title>
    <link rel="stylesheet" href="gate.css"> <!-- Add your styles -->
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Notes</a></li>
            <li><a href="#">Mock Test</a></li>
            <li><a href="#">Leaderboard</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>GATE Quiz Dashboard</h1>

        <div class="filter-section">
            <a href="gate_dashboard.php?stream=ALL">ALL</a>
            <a href="gate_dashboard.php?stream=EC">EC</a>
            <a href="gate_dashboard.php?stream=EE">EE</a>
            <a href="gate_dashboard.php?stream=ME">ME</a>
            <a href="gate_dashboard.php?stream=CE">CE</a>
            <a href="gate_dashboard.php?stream=CSE">CSE</a>
        </div>

        <div class="quiz-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="quiz-card">
                    <h3><?php echo $row['quiz_name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <button onclick="startQuiz(<?php echo $row['quiz_id']; ?>)">Start Quiz</button>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        function startQuiz(quizId) {
            window.location.href = 'gate_quiz.php?quiz_id=' + quizId;
        }
    </script>
</body>
</html>
