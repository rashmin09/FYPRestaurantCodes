<?php
session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheets/MovieListCode.css"/>
    <style>
        .navbar {
            background-color: #9B1010; /* Set the navbar background color */
            border-bottom: 3px solid #361B1B; /* Bottom outline of the navbar */
        }
        .navbar .nav-link {
            color: white !important; /* Ensure navbar links are readable in white */
        }
        .navbar-brand img {
            height: 40px; /* Keeps the brand logo the same size */
        }
        .order-now {
            color: #9B1010; /* Text color */
            background-color: #DCD1C1; /* Background color */
            font-weight: bold;
            padding: 20px;
            border-left: 3px solid #9B1010; /* Left border */
            border-bottom: #9B1010; /* Bottom border */
            transform: skewX(-10deg); /* Slanted shape */
            height: 100%; /* Fill the height of the navbar */
            display: flex;
            align-items: center; /* Center the text vertically */
            justify-content: center; /* Center the text horizontally */
            text-decoration: none; /* Remove underline from the link */
            
        }
        .logo-oval-background {
    background-color: white; /* White background color */
    border-radius: 50px; /* Creates the oval shape */
    padding: 10px 20px; /* Adjust padding to create the desired oval effect */
    display: inline-block; /* Make sure the container only wraps the logo */
}

.navbar-brand img {
    height: 40px; /* Keeps the brand logo the same size */
    display: block; /* Removes extra space under the image */
}
       
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="Home.php">
    <div class="logo-oval-background">
        <img src="Brand Logo/fortuna.png" alt="Restaurant Logo">
    </div>
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['userId'])) { // Check if user is logged in ?>
                        <?php if ($_SESSION['role'] == "member") { ?>
                            <!-- Navbar for Member -->
                            <li class="nav-item">
                                <a class="nav-link" href="Home.php" id="idHome">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MealSets.php" id="idMealSets">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="OrderHistory.php" id="idOrderHistory">Order History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="LogoutUser.php" id="idLogout">Logout</a>
                            </li>
                        <?php } elseif ($_SESSION['role'] == "owner") { ?>
                            <!-- Navbar for Owner -->
                            <li class="nav-item">
                                <a class="nav-link" href="Home.php" id="idHome">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MealSets.php" id="idMealSets">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="AddMeal.php" id="idAddMeal">Add a Meal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="CloseOrders.php" id="idCloseOrders">Close Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="SalesFigures.php" id="idSalesFigures">Sales Figures</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="LogoutUser.php" id="idLogout">Logout</a>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <!-- Navbar for Guests (Not Logged In) -->
                       <!-- <li class="nav-item">
                            <a class="nav-link" href="RegisterUser.php" id="idRegistration">Register</a>
                       --> </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="LoginUser.php" id="idLogin">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="MealSets.php" id="idMealSets">Meal Sets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="OrderPending.php" id="idOrderPending">Order Pending</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- Order Now Header -->
            <a href="OrderNow.php" class="order-now">
                Order Now
            </a>
        </div>
    </nav>
</body>
</html>