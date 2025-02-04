<?php
include "dbFunctions.php";
session_start();

// Check if user is logged in, if not set guest userId
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId']; // Get the user ID from session if logged in
} else {
    $userId = 'guest'; // Assign a default guest user ID if no user is logged in
}

// Query to fetch orders for the logged-in user or guest
$queryOrders = "SELECT id, name, price, quantity, groupId 
                FROM orderdetails 
                WHERE userId = ?"; // Only fetch orders that are not grouped
$stmt = mysqli_prepare($link, $queryOrders);
mysqli_stmt_bind_param($stmt, 's', $userId);  // Bind 's' for string (since userId can be guest)
mysqli_stmt_execute($stmt);
$resultOrders = mysqli_stmt_get_result($stmt);

// Fetch orders into an array
$arrItems = [];
while ($row = mysqli_fetch_assoc($resultOrders)) {
    $arrItems[] = $row;
}

// Generate new groupId if no orders are grouped
$queryMaxGroupId = "SELECT MAX(groupId) AS lastGroupId FROM orderdetails";
$resultMaxGroupId = mysqli_query($link, $queryMaxGroupId);
$row = mysqli_fetch_assoc($resultMaxGroupId);
$groupId = isset($row['lastGroupId']) ? $row['lastGroupId'] + 1 : 1; // Start from 1 if no groupId exists

// Update the groupId for the orders
if (count($arrItems) > 0) {
    $queryUpdateGroupId = "UPDATE orderdetails SET groupId = ? WHERE userId = ? AND groupId IS NULL"; // Update orders where groupId is NULL
    $stmt = mysqli_prepare($link, $queryUpdateGroupId);
    mysqli_stmt_bind_param($stmt, 'is', $groupId, $userId);
    mysqli_stmt_execute($stmt);
}

mysqli_close($link); // Close the database connection after all queries
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Confirm Order</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Confirm Your Order</h1>

        <?php if (count($arrItems) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalPrice = 0;
                    foreach ($arrItems as $item) {
                        $itemTotal = $item['price'] * $item['quantity'];
                        $totalPrice += $itemTotal;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($itemTotal, 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h3 class="text-end">Total Price: $<?php echo number_format($totalPrice, 2); ?></h3>
            <div class="text-center mt-4">
                <form method="post" action="queue.php">
                    <input type="hidden" name="groupId" value="<?php echo $groupId; ?>"> <!-- Pass groupId to queue.php -->
                    <button type="submit" class="btn btn-primary btn-lg">Checkout</button>
                </form>
            </div>
        <?php else: ?>
            <p>No orders found in your cart. Please add items to your cart before proceeding.</p>
        <?php endif; ?>

    </div>
</body>
</html>