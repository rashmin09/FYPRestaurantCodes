<?php
include "dbFunctions.php";
session_start();

// Check if user is logged in, if not set guest userId
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId']; // Get the user ID from session if logged in
} else {
    $userId = 'guest'; // Assign a default guest user ID if no user is logged in
}

$mealId = $_POST['mealId'];
$sauces = $_POST['Sauces'];
$sides = $_POST['Sides'];
$quantity = $_POST['Quantity'];

// Get meal details
$queryMeal = "SELECT picture, name, price, short_description FROM meals WHERE id = ?";
$stmt = mysqli_prepare($link, $queryMeal);
mysqli_stmt_bind_param($stmt, 'i', $mealId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$meal = mysqli_fetch_assoc($result);

// Find existing groupId where checkoutId is NULL
$queryGroup = "SELECT groupId FROM orderdetails WHERE userId = ? AND checkoutId IS NULL ORDER BY id DESC LIMIT 1";
$stmtGroup = mysqli_prepare($link, $queryGroup);
mysqli_stmt_bind_param($stmtGroup, 's', $userId);
mysqli_stmt_execute($stmtGroup);
$resultGroup = mysqli_stmt_get_result($stmtGroup);
$rowGroup = mysqli_fetch_assoc($resultGroup);

// Assign existing groupId or generate a new one
if ($rowGroup) {
    $groupId = $rowGroup['groupId'];
} else {
    // Generate new groupId (incrementing)
    $queryNewGroup = "SELECT IFNULL(MAX(groupId), 0) + 1 AS newGroup FROM orderdetails";
    $resultNewGroup = mysqli_query($link, $queryNewGroup);
    $rowNewGroup = mysqli_fetch_assoc($resultNewGroup);
    $groupId = $rowNewGroup['newGroup'];
}

// Insert order details
$queryInsertOrder = "INSERT INTO orderdetails (userId, groupId, picture, name, price, short_description, sauces, sides, quantity) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmtInsert = mysqli_prepare($link, $queryInsertOrder);
mysqli_stmt_bind_param($stmtInsert, 'sissssssi', 
    $userId, 
    $groupId, 
    $meal['picture'], 
    $meal['name'], 
    $meal['price'], 
    $meal['short_description'], 
    $sauces, 
    $sides, 
    $quantity
);

if (mysqli_stmt_execute($stmtInsert)) {
    // Get the last inserted order ID
    $orderId = mysqli_insert_id($link);

    // Calculate and populate the TotalValue column
    $queryUpdateTotalValue = "UPDATE orderdetails SET TotalValue = quantity * price WHERE id = ?";
    $stmtUpdate = mysqli_prepare($link, $queryUpdateTotalValue);
    mysqli_stmt_bind_param($stmtUpdate, 'i', $orderId);
    
    if (mysqli_stmt_execute($stmtUpdate)) {
        header("Location: Mealsets.php");
        exit();
    } else {
        echo "Error updating TotalValue: " . mysqli_error($link);
    }
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>