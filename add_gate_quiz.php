<?php
include '../../pages/config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quiz_name = mysqli_real_escape_string($conn, $_POST['quiz_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stream = mysqli_real_escape_string($conn, $_POST['stream']);
    $duration = (int)$_POST['duration'];
    $total_xp = (int)$_POST['total_xp'];

    // Insert query
    $sql = "INSERT INTO gate_quizzes (quiz_name, description, stream, duration, total_xp) 
            VALUES ('$quiz_name', '$description', '$stream', $duration, $total_xp)";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Quiz added successfully!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gate Quiz</title>
    <link rel="stylesheet" href="../admin/add_gate_quiz.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Add Gate Quiz</h2>

        <?php if (isset($success_message)) { echo "<p class='success'>$success_message</p>"; } ?>
        <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>

        <form action="" method="POST" onsubmit="return validateForm()">
            <label>Quiz Name:</label>
            <input type="text" name="quiz_name" id="quiz_name" required>

            <label>Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label>Stream:</label>
            <select name="stream" id="stream" required>
                <option value="">Select Stream</option>
                <option value="CSE">Computer Science</option>
                <option value="ECE">Electronics & Communication</option>
                <option value="EEE">Electrical Engineering</option>
                <option value="ME">Mechanical Engineering</option>
                <option value="CE">Civil Engineering</option>
            </select>

            <label>Duration (Minutes):</label>
            <input type="number" name="duration" id="duration" required>

            <label>Total XP:</label>
            <input type="number" name="total_xp" id="total_xp" required>

            <button type="submit">Add Quiz</button>
        </form>
    </div>

    <script>
        function validateForm() {
            let quizName = document.getElementById("quiz_name").value;
            let description = document.getElementById("description").value;
            let stream = document.getElementById("stream").value;
            let duration = document.getElementById("duration").value;
            let totalXP = document.getElementById("total_xp").value;

            if (quizName === "" || description === "" || stream === "" || duration === "" || totalXP === "") {
                alert("All fields are required!");
                return false;
            }

            if (duration <= 0 || totalXP <= 0) {
                alert("Duration and XP must be greater than zero.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
