<?php
include "dbFunctions.php";
session_start();

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'guest';

// Query to fetch orders for the logged-in user or guest
$queryOrders = "SELECT id, name, price, quantity 
                FROM orderdetails 
                WHERE userId = ?";
$stmt = mysqli_prepare($link, $queryOrders);
mysqli_stmt_bind_param($stmt, 's', $userId);
mysqli_stmt_execute($stmt);
$resultOrders = mysqli_stmt_get_result($stmt);

// Fetch orders into an array
$arrItems = [];
while ($row = mysqli_fetch_assoc($resultOrders)) {
    $arrItems[] = $row;
}

mysqli_close($link);
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
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($itemTotal, 2); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h3 class="text-end">Total Price: $<?php echo number_format($totalPrice, 2); ?></h3>
        <div class="text-center mt-4">
            <a href="paymentPage.php" class="btn btn-primary btn-lg">Checkout</a>
        </div>
    </div>
</body>
</html>


