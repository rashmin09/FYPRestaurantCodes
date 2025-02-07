<?php
session_start();
include "dbFunctions.php";  // Ensure this file correctly initializes $link (database connection)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phoneNumber = $_POST["phoneNumber"];
    $queueNumber = $_POST["queueNumber"];

    // Validate phone number format (ensure it's 8 digits)
    if (!preg_match("/^[0-9]{8}$/", $phoneNumber)) {
        die("Invalid phone number format.");
    }

    // Update phone number in QueueTable
    $queryUpdatePhone = "UPDATE QueueTable SET phoneNumber = ? WHERE checkoutId = ?";
    $stmt = mysqli_prepare($link, $queryUpdatePhone);
    mysqli_stmt_bind_param($stmt, 'si', $phoneNumber, $queueNumber);
    mysqli_stmt_execute($stmt);
    
    // Redirect to Home.php after successful update
    header("Location: Home.php");
    exit();
}
?>