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

// Query to fetch only 'Open' orders for the logged-in user or guest
$queryOrders = "SELECT id, picture, name, price, short_description, sauces, sides, quantity, TotalValue, time, status, groupId
                FROM orderdetails 
                WHERE status = 'Open'";  // Only fetch 'Open' orders
$stmt = mysqli_prepare($link, $queryOrders);
mysqli_stmt_execute($stmt);
$resultOrders = mysqli_stmt_get_result($stmt);

// Fetch orders into an array
$arrItems = [];
while ($row = mysqli_fetch_assoc($resultOrders)) {
    $arrItems[] = $row;
}


$queryUpdateStatus = "UPDATE orderdetails SET status = 'Closed' WHERE id = ?";
    
// Prepare the statement
$stmt = mysqli_prepare($link, $queryUpdateStatus);

// Check if statement was prepared successfully
if ($stmt === false) {
    die('MySQL prepare error: ' . mysqli_error($link));
}

// Bind the orderId to the prepared statement
mysqli_stmt_bind_param($stmt, "i", $orderId);

// Execute the query
if (!mysqli_stmt_execute($stmt)) {
    // Return error message if query fails
    echo "Error updating status: " . mysqli_error($link);
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
        .edit-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
        #offcanvas {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            max-width: 100%;
            height: 100%;
            background: #f8f9fa;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            display: none;
            flex-direction: column;
            padding: 20px;
        }
        .close-offcanvas {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #007BFF;
            cursor: pointer;
            align-self: flex-end;
        }
        .warning-message {
            display: none;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-top: 10px;
        }
        .edit-btn:disabled {
    background-color: #6c757d; /* Grey background for disabled button */
    cursor: not-allowed; /* Prevent pointer cursor */
    opacity: 0.6; /* Optional: add some opacity to make it look more disabled */
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
                    $orderStatus = $order['status']; // Get the status
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
            
              <!-- Display GroupId -->
            <div class="mt-3">
                <strong>Group ID: </strong><span><?php echo $order['groupId']; ?></span>
            </div>
            <!-- Display status and change it -->
            <div class="mt-3">
                <strong>Status: </strong><span id="status-<?php echo $id; ?>"><?php echo $orderStatus; ?></span>
                <?php if ($orderStatus === "Open") { ?>
                   <button id="button-<?php echo $id; ?>" class="edit-btn mt-2" onclick="changeStatus(<?php echo $id; ?>)">
                        Change Status to Closed
                    </button>
                <?php } else { ?>
                    <button id="button-<?php echo $id; ?>" class="edit-btn mt-2" disabled>
                        Order Closed
                    </button>
                <?php } ?>
            </div>
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
    <button id="clearClosedOrdersBtn" class="btn btn-success btn-lg">Clear Closed Orders</button>
    <button id="groupClearBtn" class="btn btn-success btn-lg" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">Group Clear</button>

    <!-- Input for Group ID positioned below the buttons, with improved styling -->
    <div class="mt-3">
        <label for="groupIdInput" class="form-label">Enter Group ID to Clear:</label>
        <input type="text" id="groupIdInput" class="form-control" placeholder="Enter Group ID" style="max-width: 300px; margin: 0 auto;">
    </div>
</div>

    <script>
  function changeStatus(orderId) {
    // Display the confirmation warning before closing the order
    const confirmation = confirm("This action can't be reversed. Are you sure you want to close the order?");
    if (confirmation) {
        // Use AJAX to send the orderId and update the status in the database
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "updateStatus.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Set up the onreadystatechange handler to handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Parse the JSON response from the backend
                const response = JSON.parse(xhr.responseText);

                if (response.status === "success") {
                    // Update the status in the DOM immediately
                    document.getElementById("status-" + orderId).textContent = "Closed";
                    
                    // Disable the button
                    document.getElementById("button-" + orderId).disabled = true;
                    document.getElementById("button-" + orderId).textContent = "Order Closed";
                } else {
                    console.error("Error:", response.message);
                }
            }
        };

        // Send the orderId to update the status in the database
        xhr.send("orderId=" + orderId);
    }
}
document.getElementById("clearClosedOrdersBtn").addEventListener("click", function () {
    const orderCards = document.querySelectorAll(".card");
    orderCards.forEach(function(card) {
        const statusElement = card.querySelector("[id^='status-']"); // Select the status element by its ID prefix
        if (statusElement && statusElement.textContent.trim() === "Closed") {
            card.style.display = "none"; // Hide the closed order row
        }
    });
});
document.getElementById("groupClearBtn").addEventListener("click", function () {
    const groupId = document.getElementById("groupIdInput").value.trim();
    if (groupId) {
        // Confirm the action
        const confirmation = confirm("This action will close all orders with the specified Group ID. Are you sure?");
        if (confirmation) {
            // Use AJAX to send the groupId and update the status in the database
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "updateGroupStatus.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        // Update the status of the orders in the DOM
                        document.querySelectorAll(".card").forEach(function(card) {
                            const statusElement = card.querySelector("[id^='status-']");
                            const groupElement = card.querySelector("[id^='groupId-']");
                            if (groupElement && groupElement.textContent.trim() === groupId && statusElement) {
                                statusElement.textContent = "Closed";
                                card.querySelector("button").disabled = true;
                                card.querySelector("button").textContent = "Order Closed";
                            }
                        });
                    } else {
                        alert("Error updating group orders: " + response.message);
                    }
                }
            };

            // Send the groupId to the backend
            xhr.send("groupId=" + groupId);
        }
    } else {
        alert("Please enter a valid Group ID.");
    }
});
</script>
</body>
<br>
<br>
</html>