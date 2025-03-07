 
<?php
include '../pages/config.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quizzes</title>
    <link rel="stylesheet" href="../pages/admin/style.css"> <!-- Link to external CSS -->
    <script src="../js/script.js" defer></script> <!-- Link to external JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'admin_header.php'; ?>  <!-- Include Admin Header -->

<div class="container mt-4">
    <h2 class="text-center">Manage Quizzes</h2>

    <table class="table table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Quiz Name</th>
                <th>Description</th>
                <th>Duration (min)</th>
                <th>Total XP</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM quizzes";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['quiz_id']}</td>
                        <td>{$row['quiz_name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['duration']}</td>
                        <td>{$row['total_xp']}</td>
                        <td>
                            <a href='edit_quiz.php?id={$row['quiz_id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='add_questions.php?id={$row['quiz_id']}' class='btn btn-success btn-sm'>Add Questions</a>
                            <a href='delete_quiz.php?id={$row['quiz_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No Quizzes Found</td></tr>";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include 'admin_footer.php'; ?> <!-- Include Admin Footer -->

</body>
</html>
 
