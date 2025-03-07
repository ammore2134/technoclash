<?php
include '../pages/config.php'; // Include your database connection

session_start();
if (!isset($_GET['quiz_id'])) {
    echo "Invalid Quiz!";
    exit;
}

$quiz_id = $_GET['quiz_id'];

// Fetch Quiz Details
$quizQuery = "SELECT * FROM gate_quizzes WHERE quiz_id = '$quiz_id'";
$quizResult = $conn->query($quizQuery);
$quiz = $quizResult->fetch_assoc();

if (!$quiz) {
    echo "Quiz not found!";
    exit;
}

// Fetch Quiz Questions
$questionQuery = "SELECT * FROM quiz_questions WHERE quiz_id = '$quiz_id' ORDER BY id ASC";
$questionResult = $conn->query($questionQuery);
$questions = $questionResult->fetch_all(MYSQLI_ASSOC);

// Store questions in session to track progress
$_SESSION['questions'] = $questions;
$_SESSION['quiz_id'] = $quiz_id;
$_SESSION['current_question'] = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $quiz['quiz_name']; ?> - Start Quiz</title>
    <link rel="stylesheet" href="gate_quiz.css"> <!-- CSS file -->
    <script src="get_quiz.js" defer></script> <!-- JavaScript file -->
</head>
<body>

    <div class="quiz-container">
        <h2><?php echo $quiz['quiz_name']; ?></h2>
        <p><strong>Duration:</strong> <?php echo $quiz['duration']; ?> mins</p>
        <p id="timer"></p>

        <form id="quizForm">
            <div id="questionContainer">
                <!-- Questions will be loaded here dynamically -->
            </div>

            <div class="buttons">
                <button type="button" id="prevBtn" onclick="prevQuestion()">Previous</button>
                <button type="button" id="nextBtn" onclick="nextQuestion()">Next</button>
                <button type="submit" id="submitBtn" style="display: none;">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>

