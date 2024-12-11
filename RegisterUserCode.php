<?php 
session_start();
include("dbFunctions.php");

$username = $_POST['username'];
$password = $_POST['password'];
$phonenumber = $_POST['phonenumber'];
$role = 'member'; // Default role

// Generate a random OTP
$otp = rand(100000, 999999); 

// Insert phone number into OTP table
$queryOTP = "INSERT INTO OTP (number, otp) VALUES ('$phonenumber', '$otp')";
$statusOTP = mysqli_query($link, $queryOTP);

if ($statusOTP) {
    // Store the phone number and username in session for later use
    $_SESSION['phonenumber'] = $phonenumber;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password; // Store password temporarily (consider encrypting it)

    // Redirect to 2fa page
    header("Location: 2fa.php"); 
    exit(); // Always exit after a header redirect
} else {
    echo "Failed to initiate OTP: " . mysqli_error($link);
}

mysqli_close($link);
?>