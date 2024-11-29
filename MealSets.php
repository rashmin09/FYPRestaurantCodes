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
        .container {
            max-width: 1200px; /* Wider container for larger screen sizes */
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        h1 {
            color: #000000;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 100%;
        }
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover; /* Ensures the image covers the area proportionally */
        }
        .view-more-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .view-more-btn:hover {
            background-color: #0056b3;
        }
        /* Bootstrap Grid: Ensure 3 items per row on large screens, 2 on medium, and 1 on small */
        .row .col-lg-4, .row .col-md-6 {
            margin-bottom: 20px;
        }
        @media (max-width: 991px) {
            /* 2 items per row for medium screens */
            .col-md-6 {
                max-width: 50%; /* 2 per row */
            }
        }
        @media (max-width: 575px) {
            /* 1 item per row on small screens */
            .col-sm-12 {
                max-width: 100%; /* 1 per row */
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1>Menu</h1>
        <hr>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="MealIcon/burger.png" class="card-img-top" alt="Burgers">
                        <div class="card-body">
                            <h5 class="card-title">Burgers</h5>
                            <button class="view-more-btn" onclick="filterByType('burger')">View Burgers</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="MealIcon/Chicken.png" class="card-img-top" alt="Chicken">
                        <div class="card-body">
                            <h5 class="card-title">Chicken</h5>
                            <button class="view-more-btn" onclick="filterByType('chicken')">View Chicken</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="MealIcon/Fish.png" class="card-img-top" alt="Fish">
                        <div class="card-body">
                            <h5 class="card-title">Fish</h5>
                            <button class="view-more-btn" onclick="filterByType('Fish')">View Fish</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="MealIcon/Rice.png" class="card-img-top" alt="Rice">
                        <div class="card-body">
                            <h5 class="card-title">Rice</h5>
                            <button class="view-more-btn" onclick="filterByType('Rice')">View Rice</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="MealIcon/Dessert.png" class="card-img-top" alt="Dessert">
                        <div class="card-body">
                            <h5 class="card-title">Dessert</h5>
                            <button class="view-more-btn" onclick="filterByType('Dessert')">View Dessert</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="MealIcon/Drink.png" class="card-img-top" alt="Dessert">
                        <div class="card-body">
                            <h5 class="card-title">Drinks</h5>
                            <button class="view-more-btn" onclick="filterByType('Drinks')">View Drinks</button>
                        </div>
                    </div>
                </div>
                <!-- Add additional items here as needed -->
            </div>
        </div>
    </div>

    <script>
        function filterByType(type) {
            // Redirect to MealDetails.php with the selected meal type as a query string
            window.location.href = `MealDetails.php?mealtype=${type}`;
        }
    </script>
</body>
</html>