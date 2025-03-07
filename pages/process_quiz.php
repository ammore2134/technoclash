<?php
session_start();
include '../pages/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_id = $_POST['quiz_id'];
    $question_id = $_POST['question_id'];
    $selected_answer = $_POST['answer'];

    // Fetch the correct answer
    $query = "SELECT correct_option FROM questions WHERE id = '$question_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $correct_answer = $row['correct_option'];

    // Check if the answer is correct
    if ($selected_answer == $correct_answer) {
        $_SESSION['score'] += 10; // Add XP
        $_SESSION['correct'] += 1;
    } else {
        $_SESSION['incorrect'] += 1;
    }

    // Redirect to next question
    header("Location: quiz.php?quiz_id=$quiz_id&q=" . ($_POST['q'] + 1));
    exit;
}
?>
