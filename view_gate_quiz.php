<?php
include '../pages/config.php'; // Database connection

// Fetch all quizzes from the gate_quizzes table
$sql = "SELECT * FROM gate_quizzes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View GATE Quizzes</title>
    <link rel="stylesheet" href="../../pages/admin/view_gate_quiz.css">
</head>
<body>

    <div class="admin-container">
        <h1>Manage GATE Quizzes</h1>

        <table>
            <thead>
                <tr>
                    <th>Quiz Name</th>
                    <th>Description</th>
                    <th>Stream</th>
                    <th>Duration (mins)</th>
                    <th>Total XP</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['quiz_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['stream']); ?></td>
                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_xp']); ?></td>
                        <td>
                            <a href="edit_quiz.php?id=<?php echo $row['quiz_id']; ?>" class="edit-btn">Edit</a>
                            <a href="add_quiz_quetions.php?id=<?php echo $row['quiz_id']; ?>" class="edit-btn">Add questions</a>
                            <a href="delete_quiz.php?id=<?php echo $row['quiz_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this quiz?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
