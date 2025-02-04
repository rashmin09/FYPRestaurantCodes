<?php
// Start the session
session_start();

// Database connection (Replace with your actual database credentials)
$servername = "localhost";   // or your DB server
$username = "root";          // your MySQL username
$password = "";              // your MySQL password
$dbname = "restaurant_db";  // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if order ID is set in the session or URL
$orderID = isset($_SESSION['orderID']) ? $_SESSION['orderID'] : (isset($_GET['orderID']) ? $_GET['orderID'] : null);
if (!$orderID) {
    die("Order ID is missing or invalid.");
}

// Fetch order details from the database
$orderQuery = "SELECT * FROM Order WHERE OrderID = ?";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$orderResult = $stmt->get_result();
$order = $orderResult->fetch_assoc();

if (!$order) {
    die("Order not found.");
}

// Fetch order details for the specific order
$orderDetailsQuery = "SELECT * FROM OrderDetails WHERE OrderID = ?";
$stmt = $conn->prepare($orderDetailsQuery);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$orderDetailsResult = $stmt->get_result();

// Total price calculation
$totalPrice = 0;
while ($row = $orderDetailsResult->fetch_assoc()) {
    $mealID = $row['MealSetID'];
    $quantity = $row['Quantity'];

    // Get meal price from the MealSet table
    $mealQuery = "SELECT * FROM MealSet WHERE MealSetID = ?";
    $mealStmt = $conn->prepare($mealQuery);
    $mealStmt->bind_param("i", $mealID);
    $mealStmt->execute();
    $mealResult = $mealStmt->get_result();
    $meal = $mealResult->fetch_assoc();

    if ($meal) {
        $totalPrice += $meal['Price'] * $quantity;
    }
}

// If a discount is available, apply it
$discountQuery = "SELECT * FROM Discount WHERE OrderID = ?";
$discountStmt = $conn->prepare($discountQuery);
$discountStmt->bind_param("i", $orderID);
$discountStmt->execute();
$discountResult = $discountStmt->get_result();
$discount = $discountResult->fetch_assoc();

if ($discount) {
    $totalPrice -= $totalPrice * ($discount['DiscountPercentage'] / 100);
}

// Payment processing (Replace this with actual payment gateway integration like Stripe, PayPal)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = $_POST['paymentMethod'];

    if ($paymentMethod == 'credit_card') {
        // Process credit card payment (this is a placeholder, you need to integrate a real payment processor)
        // Example: Stripe, PayPal, etc.
        echo "Processing credit card payment of $" . $totalPrice;
        // Update order status to 'paid'
        $updateOrderQuery = "UPDATE Order SET Status = 'Paid' WHERE OrderID = ?";
        $updateStmt = $conn->prepare($updateOrderQuery);
        $updateStmt->bind_param("i", $orderID);
        $updateStmt->execute();

        echo "Payment successful!";
    } else {
        echo "Invalid payment method.";
    }
} else {
    // Display the payment page form
    ?>
    <h2>Payment for Order #<?php echo $orderID; ?></h2>
    <p>Total Price: $<?php echo number_format($totalPrice, 2); ?></p>

    <form method="POST" action="paymentPage.php">
        <label for="paymentMethod">Select Payment Method:</label><br>
        <input type="radio" id="credit_card" name="paymentMethod" value="credit_card" required>
        <label for="credit_card">Credit Card</label><br>
        
        <input type="submit" value="Pay Now">
    </form>

    <p>Order Details:</p>
    <table>
        <thead>
            <tr>
                <th>Meal</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display order details
            $orderDetailsResult->data_seek(0); // Reset pointer to the start
            while ($row = $orderDetailsResult->fetch_assoc()) {
                $mealID = $row['MealSetID'];
                $quantity = $row['Quantity'];

                // Get meal price from MealSet
                $mealQuery = "SELECT * FROM MealSet WHERE MealSetID = ?";
                $mealStmt = $conn->prepare($mealQuery);
                $mealStmt->bind_param("i", $mealID);
                $mealStmt->execute();
                $mealResult = $mealStmt->get_result();
                $meal = $mealResult->fetch_assoc();

                if ($meal) {
                    echo "<tr>
                            <td>" . htmlspecialchars($meal['MealName']) . "</td>
                            <td>" . htmlspecialchars($quantity) . "</td>
                            <td>$" . number_format($meal['Price'], 2) . "</td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
