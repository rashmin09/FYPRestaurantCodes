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

// Ensure checkoutId is set for guests
if (!isset($_SESSION['checkoutId'])) {
    if (isset($_GET['checkoutId']) && !empty($_GET['checkoutId'])) {
        $_SESSION['checkoutId'] = intval($_GET['checkoutId']);
    } else {
        die("<p>Error: No checkoutId found. Please provide a checkoutId in the URL (e.g., OrderPending.php?checkoutId=1234).</p>");
    }
}

$checkoutId = $_SESSION['checkoutId'];

// Fetch orders with status 'Open' for guests
$queryOrders = "SELECT picture, name, quantity, price, short_description, sauces, sides FROM orderdetails WHERE checkoutId = ? AND status = 'Open'";
$stmt = $conn->prepare($queryOrders);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $checkoutId);
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Picture</th><th>Name</th><th>Quantity</th><th>Price</th><th>Description</th><th>Sauces</th><th>Sides</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='meals/" . htmlspecialchars($row['picture']) . "' width='50'></td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['short_description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sauces']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sides']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No open orders found for this checkout ID.</p>";
}

$stmt->close();
$conn->close();
?>
