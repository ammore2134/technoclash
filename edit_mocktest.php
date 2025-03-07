<?php
include '../pages/config.php';
session_start();

if (!isset($_GET['mock_id'])) {
    echo "Invalid Mock Test!";
    exit;
}

$mock_id = $_GET['mock_id'];

// Fetch mock test details
$mockQuery = "SELECT * FROM mocktest WHERE mock_id = '$mock_id'";
$mockResult = $conn->query($mockQuery);
$mock = $mockResult->fetch_assoc();

if (!$mock) {
    echo "Mock Test not found!";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stream = $_POST['stream'];
    $mock_name = $_POST['mock_name'];
    $mock_duration = $_POST['mock_duration'];
    $mock_description = $_POST['mock_description'];

    $updateQuery = "UPDATE mocktest SET 
                    stream='$stream', 
                    mock_name='$mock_name', 
                    mock_duration='$mock_duration', 
                    mock_description='$mock_description' 
                    WHERE mock_id='$mock_id'";

    if ($conn->query($updateQuery)) {
        echo "Mock Test updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mock Test</title>
</head>
<body>
    <h2>Edit Mock Test</h2>
    <form method="POST">
        <label>Stream:</label>
        <input type="text" name="stream" value="<?php echo $mock['stream']; ?>" required><br>

        <label>Mock Name:</label>
        <input type="text" name="mock_name" value="<?php echo $mock['mock_name']; ?>" required><br>

        <label>Duration (minutes):</label>
        <input type="number" name="mock_duration" value="<?php echo $mock['mock_duration']; ?>" required><br>

        <label>Description:</label>
        <textarea name="mock_description" required><?php echo $mock['mock_description']; ?></textarea><br>

        <button type="submit">Update Mock Test</button>
    </form>
</body>
</html>
