<?php
include '../pages/config.php'; // Include your database connection file

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quiz_id = $_POST['quiz_id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    // Validate required fields
    if (empty($quiz_id) || empty($question) || empty($option1) || empty($option2) || empty($option3) || empty($option4) || empty($correct_option)) {
        $message = "All fields are required!";
    } else {
        // Insert query
        $sql = "INSERT INTO quiz_questions (quiz_id, question, option1, option2, option3, option4, correct_option) 
                VALUES ('$quiz_id', '$question', '$option1', '$option2', '$option3', '$option4', '$correct_option')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Question added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// Fetch quizzes for dropdown
$quizQuery = "SELECT quiz_id, quiz_name FROM gate_quizzes";
$quizResult = $conn->query($quizQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz Question</title>
    <link rel="stylesheet" href="../admin/add_quiz_questions.css"> <!-- Add your CSS file -->
</head>
<body>

    <div class="admin-container">
        <h2>Add Quiz Question</h2>
        
        <form method="POST" action="">
            <label>Select Quiz:</label>
            <select name="quiz_id" required>
                <option value="">-- Select Quiz --</option>
                <?php while ($quiz = $quizResult->fetch_assoc()): ?>
                    <option value="<?php echo $quiz['quiz_id']; ?>"><?php echo $quiz['quiz_name']; ?></option>
                <?php endwhile; ?>
            </select>

            <label>Question:</label>
            <textarea name="question" required></textarea>

            <label>Option 1:</label>
            <input type="text" name="option1" required>

            <label>Option 2:</label>
            <input type="text" name="option2" required>

            <label>Option 3:</label>
            <input type="text" name="option3" required>

            <label>Option 4:</label>
            <input type="text" name="option4" required>

            <label>Correct Option:</label>
            <select name="correct_option" required>
                <option value="">-- Select Correct Option --</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>

            <button type="submit">Add Question</button>
        </form>

        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
    </div>

</body>
</html>
