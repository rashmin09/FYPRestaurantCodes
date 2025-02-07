<?php
include "dbFunctions.php";

// Check if user is logged in, if not set guest userId
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId']; // Get the user ID from session if logged in
} else {
    $userId = 'guest'; // Assign a default guest user ID if no user is logged in
}

$mealId = $_POST['mealId']; // Get the selected meal ID
$sauces = $_POST['Sauces']; // Get selected sauce
$sides = $_POST['Sides']; // Get selected side
$quantity = $_POST['Quantity']; // Get selected quantity

// Get meal details from the meals table
$queryMeal = "SELECT picture, name, price, short_description FROM meals WHERE id = ?";
$stmt = mysqli_prepare($link, $queryMeal);
mysqli_stmt_bind_param($stmt, 'i', $mealId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$meal = mysqli_fetch_assoc($result);

// Insert order details into orderdetails table (AUTO_INCREMENT for 'id')
$queryInsertOrder = "INSERT INTO orderdetails (userId, picture, name, price, short_description, sauces, sides, quantity) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmtInsert = mysqli_prepare($link, $queryInsertOrder);
mysqli_stmt_bind_param($stmtInsert, 'issssssi', 
    $userId, 
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
        // Redirect to Mealsets.php after successful order
        header("Location: Mealsets.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error updating TotalValue: " . mysqli_error($link);
    }
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>