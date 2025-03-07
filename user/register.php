<?php
// Include database connection
include '../includes/db.php'; // Adjust the path as necessary

// Initialize variables
$name = $mobile_no = $college_name = $email = $username = $password = $confirm_password = $user_type = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile_no = $_POST['mobile_no'];
    $college_name = $_POST['college_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];

    // Validate input
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data
        $sql = "INSERT INTO Users (username, name, college_name, email, password, phone_no) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $name, $college_name, $email, $hashed_password, $mobile_no);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect based on user type
            if ($user_type == 'student') {
                header("Location: student_home.php"); // Redirect to student home page
            } else {
                header("Location: gate_home.php"); // Redirect to GATE home page
            }
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Register
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-pink-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row w-full max-w-4xl">
   <div class="bg-gradient-to-r from-pink-200 to-white p-10 flex flex-col items-center justify-center w-full md:w-1/2">
    <img alt="Logo with a graduation cap and an arrow pointing upwards" class="mb-4" height="150" src="https://storage.googleapis.com/a1aa/image/DMJUHFlGh9zpcXQDP6hwcPw7FKE-ib38fw2hi1tF030.jpg" width="150"/>
    <h1 class="text-3xl font-bold text-center">
     TECHNOCLASH
    </h1>
    <p class="text-center text-sm mt-2">
     A CLASH OF MINDS IN THE WORLD OF TECHNOLOGY AND ENGINEERING
    </p>
   </div>
   <div class="p-10 w-full md:w-1/2">
    <form class="space-y-4">
     <div>
      <label class="block text-sm font-medium text-gray-700">
       NAME
      </label>
      <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="text"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700">
       MOBILE NO.
      </label>
      <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="text"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700">
       EMAIL ADDRESS
      </label>
      <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="email"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700">
       COLLEGE NAME
      </label>
      <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="text"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700">
       USERNAME
      </label>
      <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="text"/>
     </div>
     <div class="flex space-x-4">
      <div class="w-1/2">
       <label class="block text-sm font-medium text-gray-700">
        PASSWORD
       </label>
       <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="password"/>
      </div>
      <div class="w-1/2">
       <label class="block text-sm font-medium text-gray-700">
        CONFIRM PASSWORD
       </label>
       <input class="mt-1 block w-full rounded-full bg-pink-200 border-transparent focus:border-pink-500 focus:ring-0" type="password"/>
      </div>
     </div>
     <div class="flex justify-center mt-6">
      <button class="bg-red-500 text-white font-bold py-2 px-6 rounded-full" type="submit">
       NEXT
      </button>
     </div>
    </form>
   </div>
  </div>
 </body>
</html>
