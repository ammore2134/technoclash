<?php
include('../pages/config.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quiz_name = mysqli_real_escape_string($conn, $_POST['quiz_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $duration = (int) $_POST['duration'];
    $total_xp = (int) $_POST['total_xp'];
   
    $query = "INSERT INTO quizzes (quiz_name, description, duration, total_xp) 
              VALUES ('$quiz_name', '$description', '$duration', '$total_xp')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Quiz added successfully!'); window.location.href='view_quizzes.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Quiz</title>
    <link rel="stylesheet" href="../admin/add_quiz.css">
</head>
<body>
   
    <div class="container">
        <h2>Add New Quiz</h2>
        <form action="add_quiz.php" method="POST">
            <label>Quiz Title:</label>
            <input type="text" name="quiz_name" required>

            <label>Description:</label>
            <textarea name="description" required></textarea>

            <label>Duration (in minutes):</label>
            <input type="number" name="duration" required>

            <label>XP per Question:</label>
            <input type="number" name="total_xp" required>

           

            <button type="submit" class="btn">Add Quiz</button>
        </form>
    </div>
    
</body>
</html>


