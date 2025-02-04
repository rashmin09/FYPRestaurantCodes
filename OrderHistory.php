<?php
session_start();

/**
 * Database connection function.
 */
function dbConnect() {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "restaurant_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

$conn = dbConnect();

// Ensure user is logged in
if (!isset($_SESSION['userId'])) {
    die("<p>Error: You must be logged in to view order history.</p>");
}

$userId = $_SESSION['userId'];

// Fetch orders for logged-in users with status 'Open' or 'Closed'
$queryOrders = "SELECT picture, name, quantity, price, short_description, sauces, sides, status FROM orderdetails WHERE userId = ? AND (status = 'Open' OR status = 'Closed')";
$stmt = $conn->prepare($queryOrders);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Picture</th><th>Name</th><th>Quantity</th><th>Price</th><th>Description</th><th>Sauces</th><th>Sides</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='meals/" . htmlspecialchars($row['picture']) . "' width='50'></td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['short_description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sauces']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sides']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No orders found for this user.</p>";
}

$stmt->close();
$conn->close();
?>