<?php
include '../pages/config.php'; // Include database connection
session_start();

// Fetch all mock tests
$mockQuery = "SELECT * FROM mocktest";
$mockResult = $conn->query($mockQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View & Edit Mock Tests</title>
    <link rel="stylesheet" href="../pages/admin/general.css"> <!-- Add your CSS file -->
</head>
<body>
    <h2>Manage Mock Tests</h2>
    
    <table border="1">
        <tr>
            <th>Mock ID</th>
            <th>Stream</th>
            <th>Mock Name</th>
            <th>Duration</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $mockResult->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['mock_id']; ?></td>
            <td><?php echo $row['stream']; ?></td>
            <td><?php echo $row['mock_name']; ?></td>
            <td><?php echo $row['mock_duration']; ?> mins</td>
            <td><?php echo $row['mock_description']; ?></td>
            <td>
                <a href="edit_mocktest.php?mock_id=<?php echo $row['mock_id']; ?>">Edit</a> |
                <a href="add_mock_questions.php?mock_id=<?php echo $row['mock_id']; ?>">Add Questions</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
