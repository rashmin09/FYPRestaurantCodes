<?php
include "dbFunctions.php";
ini_set('display_errors', 0); // Disable display of errors
error_reporting(0); // Set error reporting level to 0 (no errors)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve groupId from the request
    $groupId = mysqli_real_escape_string($link, $_POST['groupId']);

    // Query to update the status of all orders with the specified GroupId
    $queryUpdateGroupStatus = "UPDATE orderdetails SET status = 'Closed' WHERE groupId = ? AND status = 'Open'";

    // Prepare the statement
    $stmt = mysqli_prepare($link, $queryUpdateGroupStatus);

    // Check if statement was prepared successfully
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL query']);
        exit;
    }

    // Bind the groupId to the prepared statement
    mysqli_stmt_bind_param($stmt, "s", $groupId);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update orders']);
    }

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>