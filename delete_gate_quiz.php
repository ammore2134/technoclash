<?php
include '../pages/config.php';

if (isset($_GET['id'])) {
    $quiz_id = $_GET['id'];
    $sql = "DELETE FROM gate_quizzes WHERE quiz_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $quiz_id);

    if ($stmt->execute()) {
        echo "<script>alert('Quiz deleted successfully'); window.location='admin_view_gate_quizzes.php';</script>";
    } else {
        echo "<script>alert('Error deleting quiz'); window.location='admin_view_gate_quizzes.php';</script>";
    }
}
?>
