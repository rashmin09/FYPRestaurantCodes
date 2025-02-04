<?php
session_start();
include "dbFunctions.php";

// Get the userId from the session or default to 'guest'
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'guest';

// Generate a random 6-digit verification code
$verificationCode = random_int(100000, 999999);

// Generate a sequential checkoutId
$queryLastCheckoutId = "SELECT MAX(checkoutId) AS lastCheckoutId FROM QueueTable";
$result = mysqli_query($link, $queryLastCheckoutId);
$row = mysqli_fetch_assoc($result);

// If there are no records, start from 1; otherwise, increment the last checkoutId
$checkoutId = isset($row['lastCheckoutId']) ? $row['lastCheckoutId'] + 1 : 1;

// Insert a new record into QueueTable
$queryInsertQueue = "INSERT INTO QueueTable (checkoutId, userId, verification, status) 
                     VALUES (?, ?, ?, 'Open')";

$stmt = mysqli_prepare($link, $queryInsertQueue);
mysqli_stmt_bind_param($stmt, 'iss', $checkoutId, $userId, $verificationCode);

// Execute the query
mysqli_stmt_execute($stmt);

// Retrieve the auto-incremented queue_number
$queueNumber = mysqli_insert_id($link);

// Close the database connection
mysqli_close($link);

// Redirect to queue page
header("Location: queue.php?queue_number=$queueNumber");
exit();
?>