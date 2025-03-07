<?php
include '../pages/config.php';
session_start();

// Get quiz ID
$quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : 3;

// Fetch questions
$query = "SELECT * FROM questions WHERE quiz_id = '$quiz_id'";
$result = mysqli_query($conn, $query);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

$total_questions = count($questions);
$current_question = isset($_GET['q']) ? $_GET['q'] : 0;

if ($current_question >= $total_questions) {
    echo "<script>
        alert('Quiz is over! Click OK to go back to the dashboard.');
        window.location.href = 'dashboard.php';
    </script>";
    exit;
}

$question = $questions[$current_question];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>

    <div class="quiz-container">
        <div class="header">
            <a href="dashboard.php" class="back-btn">←</a>
            <div class="xp">XP <span><?php echo $_SESSION['score']; ?>.00</span></div>
            <div class="profile-icon">👤</div>
        </div>

        <div class="question-box">
            <h2><?php echo $question['question']; ?></h2>
            <form action="process_quiz.php" method="POST">
                <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
                <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                <input type="hidden" name="q" value="<?php echo $current_question; ?>">

                <button type="submit" name="answer" value="1"><?php echo $question['option1']; ?></button>
                <button type="submit" name="answer" value="2"><?php echo $question['option2']; ?></button>
                <button type="submit" name="answer" value="3"><?php echo $question['option3']; ?></button>
                <button type="submit" name="answer" value="4"><?php echo $question['option4']; ?></button>
            </form>
        </div>

        <div class="sidebar">
            <div class="score-card">
                <p><span><?php echo $_SESSION['correct']; ?></span> Correct</p>
                <p><span><?php echo $_SESSION['incorrect']; ?></span> Incorrect</p>
            </div>
            <div class="timer-box">
                <p>Time Left :</p>
                <h3 id="timer">00:15:00</h3>
            </div>
            <div class="nav-buttons">
                <?php if ($current_question > 0) { ?>
                    <a href="quiz.php?quiz_id=<?php echo $quiz_id; ?>&q=<?php echo $current_question - 1; ?>" class="prev-btn">Previous</a>
                <?php } ?>
                <?php if ($current_question < $total_questions - 1) { ?>
                    <a href="quiz.php?quiz_id=<?php echo $quiz_id; ?>&q=<?php echo $current_question + 1; ?>" class="next-btn">Next</a>
                <?php } ?>
            </div>
        </div>
    </div>

</body>
</html>
