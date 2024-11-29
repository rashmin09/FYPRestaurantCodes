<?php
session_start();
include("dbFunctions.php"); // Assuming dbFunctions.php contains the database connection setup

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user data
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['role'] = $user['role'];
    header("Location: Home.php"); // Redirect to home page after successful login
} else {
    echo "Invalid username or password.";
}

// Close connection
mysqli_close($link);
?>