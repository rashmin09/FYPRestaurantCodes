<?php
include "dbFunctions.php";
ini_set('display_errors', 0); // Disable display of errors
error_reporting(0); // Set error reporting level to 0 (no errors)
session_start(); // This will start a new session

// Check if user is logged in, if not set guest userId
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId']; // Get the user ID from session if logged in
} else {
    $userId = 'guest'; // Assign a default guest user ID if no user is logged in
}

// Query to fetch orders for the logged-in user or guest
$queryOrders = "SELECT id, picture, name, price, short_description, sauces, sides, quantity, TotalValue, time
                FROM orderdetails 
                WHERE userId = ?";
$stmt = mysqli_prepare($link, $queryOrders);
mysqli_stmt_bind_param($stmt, 's', $userId);  // Bind 's' for string (since userId can be guest)
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .quantity-display {
            font-size: 1.5rem;
            height: 50px;
        }
        .time-display {
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <?php
            if (count($arrItems) > 0) {
                foreach ($arrItems as $i => $order) {
                    $id = $order['id'];
                    $restaurantPicture = $order['picture'];
                    $restaurantName = $order['name'];
                    $restaurantPrice = $order['price'];
                    $restaurantSD = $order['short_description'];
                    $restaurantQuantity = $order['quantity'];
                    $orderTime = $order['time']; // Get the time
                    ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card" id="card-<?php echo $id; ?>">
                            <img src="meals/<?php echo $restaurantPicture; ?>" class="card-img-top" alt="Image of <?php echo $restaurantName; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $restaurantName; ?></h5>
                                <span class="card-price">Price: $<?php echo number_format($restaurantPrice, 2); ?></span>
                                <p class="card-text"><?php echo $restaurantSD; ?></p>
                                <div class="quantity-display"><b>X</b><?php echo $restaurantQuantity; ?></div> 
                                <div class="time-display"><b>Time: </b><?php echo $orderTime; ?></div> <!-- Display the time -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No orders found for your account.</p>";
            }
            ?>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <a href="Home.php" class="btn btn-success btn-lg">Return to Home</a>
    </div>
</body>
</html>