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
$queryOrders = "SELECT id, picture, name, price, short_description, sauces, sides, quantity, TotalValue 
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
        #offcanvasCard {
            margin-bottom: 20px;
        }
        .close-offcanvas {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #007BFF;
            cursor: pointer;
            align-self: flex-end;
        }
        .quantity-display {
            font-size: 1.5rem;
            height: 50px;
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
                    $restaurantquantity = $order['quantity'];
                    ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card" id="card-<?php echo $id; ?>">
                            <img src="meals/<?php echo $restaurantPicture; ?>" class="card-img-top" alt="Image of <?php echo $restaurantName; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $restaurantName; ?></h5>
                                <span class="card-price">Price: <?php echo $restaurantPrice; ?></span>
                                <p class="card-text"><?php echo $restaurantSD; ?></p>
                                <div class="quantity-display"><b>X</b><?php echo $restaurantquantity; ?></div> 
                                <button class="edit-btn" onclick="openOffcanvas(<?php echo $i; ?>)">Edit</button>
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
    
    <!-- Offcanvas for editing order -->
    <div id="offcanvas">
        <button class="close-offcanvas" onclick="closeOffcanvas()">&times;</button>
        <div id="offcanvasCard"></div>
        <form id="editForm" action="UpdateMeal.php" method="POST">
            <input type="hidden" name="id" id="editItemId">
            <div class="mb-3">
                <label for="editItemSauce" class="form-label">Sauce</label>
                <select class="form-select" name="sauces" id="editItemSauce">
                    <option value="Barbecue Sauce">Barbecue Sauce</option>
                    <option value="Ranch Sauce">Ranch Sauce</option>
                    <option value="Sesame Sauce">Sesame Sauce</option>
                    <option value="Cheddar Cheese Sauce">Cheddar Cheese Sauce</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="editItemSide" class="form-label">Side</label>
                <select class="form-select" name="sides" id="editItemSide">
                    <option value="French Fries">French Fries</option>
                    <option value="Onion Rings">Onion Rings</option>
                    <option value="Salad">Salad</option>
                    <option value="Coleslaw">Coleslaw</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="editItemQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="editItemQuantity" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        <form id="deleteForm" action="DeleteMeal.php" method="POST">
            <input type="hidden" name="id" id="deleteItemId">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>

    <script>
    function openOffcanvas(index) {
        const items = <?php echo json_encode($arrItems); ?>;
        const item = items[index];

        // Populate edit form fields
        document.getElementById("editItemId").value = item.id;
        document.getElementById("editItemSauce").value = item.sauces;
        document.getElementById("editItemSide").value = item.sides;
        document.getElementById("editItemQuantity").value = item.quantity;

        // Populate delete form
        document.getElementById("deleteItemId").value = item.id;

        document.getElementById("offcanvas").style.display = "flex";
    }

    function closeOffcanvas() {
        document.getElementById("offcanvas").style.display = "none";
    }
    </script>
</body>
</html>
