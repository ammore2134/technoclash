<?php
include '../pages/config.php';

if(isset($_GET['id'])) {
    $quiz_id = $_GET['id'];
    $query = "SELECT * FROM quizzes WHERE quiz_id = $quiz_id";
    $result = mysqli_query($conn, $query);
    $quiz = mysqli_fetch_assoc($result);
}

if(isset($_POST['update_quiz'])) {
    $quiz_name = $_POST['quiz_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $total_xp = $_POST['total_xp'];

    $update_query = "UPDATE quizzes SET quiz_name='$quiz_name', description='$description', duration='$duration', total_xp='$total_xp' WHERE quiz_id = $quiz_id";
    
    if(mysqli_query($conn, $update_query)) {
        header("Location: view_quizzes.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Quiz</title>
    <link rel="stylesheet" href="../pages/admin/style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container mt-4">
    <h2>Edit Quiz</h2>
    <form method="POST">
        <input type="text" name="quiz_name" value="<?= $quiz['quiz_name'] ?>" required>
        <textarea name="description"><?= $quiz['description'] ?></textarea>
        <input type="number" name="duration" value="<?= $quiz['duration'] ?>" required>
        <input type="number" name="total_xp" value="<?= $quiz['total_xp'] ?>" required>
        <button type="submit" name="update_quiz">Update Quiz</button>
    </form>
</div>

<?php include 'admin_footer.php'; ?>

</body>
</html>
