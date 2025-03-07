<?php
session_start();
include("../pages/config.php");

// Redirect to login if not logged in

// Fetch users from database
$users_query = "SELECT * FROM users";
$users_result = mysqli_query($conn, $users_query);

// Fetch quizzes from database
$quizzes_query = "SELECT * FROM quizes";
$quizzes_result = mysqli_query($conn, $quizzes_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../pages/admin/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("admin_header.php"); ?>

    <div class="container mt-4">
        <h2 class="text-center">Admin Dashboard</h2>
        
        <div class="row">
            <div class="col-md-4">
                <a href="manage_users.php" class="btn btn-primary w-100 mb-3"><i class="fas fa-users"></i> Manage Users</a>
            </div>
            <div class="col-md-4">
                <a href="add_quiz.php" class="btn btn-success w-100 mb-3"><i class="fas fa-plus"></i> Add Quiz</a>
            </div>
            <div class="col-md-4">
                <a href="view_quizzes.php" class="btn btn-warning w-100 mb-3"><i class="fas fa-eye"></i> View Quizzes</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="add_gate_quiz.php" class="btn btn-primary w-100 mb-4"><i class="fas fa-users"></i> Add GATE QUIZ</a>
            </div>
            <div class="col-md-4">
                <a href="add_mocktest.php" class="btn btn-success w-100 mb-4"><i class="fas fa-plus"></i> Add Mocktest</a>
            </div>
            <div class="col-md-4">
                <a href="view_gate_quiz.php" class="btn btn-warning w-100 mb-4"><i class="fas fa-eye"></i> View GATE quizes</a>
            </div>
            <div class="col-md-4">
                <a href="view_mocktest.php" class="btn btn-warning w-100 mb-4"><i class="fas fa-eye"></i> View Mocktest</a>
            </div>
        </div>

        <!-- Manage Users Table -->
        <h3 class="mt-4">Users List</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>Username</th>
                    <th>Email</th>
                    <th>XP</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($users_result)) { ?>
                <tr>
                    
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['xp']; ?></td>
                    <!-- <td>
                        <a href="edit_user.php?id=<?= $user['user_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="delete_user.php?id=<?= $user['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td> -->
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- View Quizzes Table -->
        
    </div>

    <?php include("admin_footer.php"); ?>
</body>
</html>
