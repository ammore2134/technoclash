<?php
include '../../pages/config.php'; // Include database connection
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stream = $_POST['stream'];
    $mock_name = $_POST['mock_name'];
    $mock_duration = $_POST['mock_duration'];
    $mock_description = $_POST['mock_description'];

    // Insert into database
    $sql = "INSERT INTO mocktest (stream, mock_name, mock_duration, mock_description) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $stream, $mock_name, $mock_duration, $mock_description);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Mock Test Added Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mock Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f4f4; }
        .container { max-width: 600px; margin-top: 50px; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Add Mock Test</h2>
    <?php echo $message; ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="stream" class="form-label">Stream</label>
            <input type="text" class="form-control" id="stream" name="stream" required>
        </div>
        <div class="mb-3">
            <label for="mock_name" class="form-label">Mock Test Name</label>
            <input type="text" class="form-control" id="mock_name" name="mock_name" required>
        </div>
        <div class="mb-3">
            <label for="mock_duration" class="form-label">Duration (Minutes)</label>
            <input type="number" class="form-control" id="mock_duration" name="mock_duration" required>
        </div>
        <div class="mb-3">
            <label for="mock_description" class="form-label">Description</label>
            <textarea class="form-control" id="mock_description" name="mock_description" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Add Mock Test</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
