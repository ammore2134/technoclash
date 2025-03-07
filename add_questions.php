<?php
include '../pages/config.php';

if(isset($_POST['add_question'])) {
    $quiz_id = $_POST['quiz_id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    $query = "INSERT INTO questions (quiz_id, question, option1, option2, option3, option4, correct_option) VALUES ('$quiz_id', '$question', '$option1', '$option2', '$option3', '$option4', '$correct_option')";
    
    if(mysqli_query($conn, $query)) {
        echo "Question Added Successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Questions</title>
    <link rel="stylesheet" href="../admin/add_question.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container mt-4">
    <h2>Add Questions</h2>
    <form method="POST">
        <input type="hidden" name="quiz_id" value="<?= $_GET['id'] ?>">
        <textarea name="question" required></textarea>
        <input type="text" name="option1" required>
        <input type="text" name="option2" required>
        <input type="text" name="option3" required>
        <input type="text" name="option4" required>
        <select name="correct_option" required>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="4">Option 4</option>
        </select>
        <button type="submit" name="add_question">Add Question</button>
    </form>
</div>

<?php include 'admin_footer.php'; ?>

</body>
</html>
