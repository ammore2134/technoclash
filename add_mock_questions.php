<?php
include '../../pages/config.php';
session_start();

if (!isset($_GET['mock_id'])) {
    echo "Invalid Mock Test!";
    exit;
}

$mock_id = $_GET['mock_id'];

// Count existing questions
$countQuery = "SELECT COUNT(*) as total FROM mock_questions WHERE mock_id = '$mock_id'";
$countResult = $conn->query($countQuery);
$countRow = $countResult->fetch_assoc();
$totalQuestions = $countRow['total'];

// Check if 65 questions are already added
if ($totalQuestions >= 65) {
    echo "This mock test already has 65 questions!";
    exit;
}

// Handle question addition
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    $insertQuery = "INSERT INTO mock_questions (mock_id, question, option1, option2, option3, option4, correct_option) 
                    VALUES ('$mock_id', '$question', '$option1', '$option2', '$option3', '$option4', '$correct_option')";

    if ($conn->query($insertQuery)) {
        echo "Question added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Mock Test Questions</title>
</head>
<body>
    <h2>Add Questions (Must add 65 questions)</h2>
    <p>Questions added: <?php echo $totalQuestions; ?>/65</p>

    <form method="POST">
        <label>Question:</label>
        <textarea name="question" required></textarea><br>

        <label>Option 1:</label>
        <input type="text" name="option1" required><br>

        <label>Option 2:</label>
        <input type="text" name="option2" required><br>

        <label>Option 3:</label>
        <input type="text" name="option3" required><br>

        <label>Option 4:</label>
        <input type="text" name="option4" required><br>

        <label>Correct Option:</label>
        <select name="correct_option" required>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="4">Option 4</option>
        </select><br>

        <button type="submit" <?php echo ($totalQuestions >= 65) ? 'disabled' : ''; ?>>Add Question</button>
    </form>
</body>
</html>
