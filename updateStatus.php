<?php
include "dbFunctions.php";
ini_set('display_errors', 0); // Disable display of errors
error_reporting(0); // Set error reporting level to 0 (no errors)

// Start the session
session_start();

// Check if orderId is provided via POST request
if (isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Query to update the order status to 'Closed'
    $queryUpdateStatus = "UPDATE orderdetails SET status = 'Closed' WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($link, $queryUpdateStatus);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('MySQL prepare error: ' . mysqli_error($link));
    }

    // Bind the orderId to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $orderId);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Status updated to 'Closed' successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating status: " . mysqli_error($link)]);
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    echo json_encode(["status" => "error", "message" => "Order ID not provided."]);
}
?>