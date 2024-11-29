<?php
include "dbFunctions.php";

// Get the mealtype from the query string
$mealType = isset($_GET['mealtype']) ? $_GET['mealtype'] : '';

// Modify the query to filter based on the mealtype, if provided
$query = "SELECT id, picture, name, price, short_description FROM meals WHERE 1=1";
if ($mealType) {
    $query .= " AND mealtype = '" . mysqli_real_escape_string($link, $mealType) . "'";
}

$resultItems = mysqli_query($link, $query) or die(mysqli_error($link));

$arrItems = [];
while ($row = mysqli_fetch_assoc($resultItems)) {
    $arrItems[] = $row;
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap-jquery-check.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagsjs/1.0.4/tags.min.js"></script>

    <style>
        .container-fluid {
            background-color: #EE7644;
            color: #fff;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: space-between; /* Distribute space between off-canvas and form */
            margin: 0;
            padding: 0;
        }

        .offcanvas {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgba(139, 0, 0, 0.7); /* Dark red translucent background */
    z-index: 1; /* Ensure it's above other content */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
}

.form-container {
    display: none; /* Hidden initially */
    width: 45%;
    max-width: 600px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    z-index: 2; /* Ensure it stays above the offcanvas background */
}

#offcanvasCard {
    display: flex;
    flex-direction: column; /* Ensure content stacks vertically */
    align-items: center;
    width: 90%; /* Adjust width to make it visually appealing */
    max-width: 500px;
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 100%;
        }

        .open-btn {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        h1 {
                color: #000000; 
                text-align: center;
            }

            h2 {
                text-align: center; /* Centering the header */
            }

            p {
                color: #333;
                line-height: 1.6;
            }

        i.fa.fa-bookmark {
            font-size: 20px;
            color: #FFF; /* Change the color as needed */
            cursor: pointer;
        }

        i.fa.fa-bookmark:hover {
            color: #EE7644; /* Change the color on hover as needed */
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .card-img-top{
         width: 200px;
         height: 200px;
        }
         @media screen and (max-width: 600px) {
                .navbar a, .dropdown .dropbtn {
                    float: none;
                    display: block;
                    text-align: left;
                }

                .gallery img {
                    width: calc(50% - 10px); /* 2 images per row on smaller screens */
                }
            }

            @media screen and (max-width: 400px) {
                .gallery img {
                    width: 100%; /* 1 image per row on very small screens */
                }
            }

    </style>
</head>
<body>
    
     
    <div class="offcanvas" id="offcanvas">
        <div class="card" id="offcanvasCard">
            <!-- The card will be added here dynamically -->
            <button onclick="closeOffcanvas()">Close</button>
        </div>
    </div>

    <div class="form-container" id="formContainer">
        <form action="doOrder.php" method="POST">
            <fieldset>
                <label for="Sauces">Sauce:</label>
                <select id="Sauces" name="Sauces">
                    <option value="Barbecue Sauce">Barbecue Sauce</option>
                    <option value="Ranch Sauce">Ranch Sauce</option>
                    <option value="Sesame Sauce">Sesame Sauce</option>
                    <option value="Cheddar Cheese Sauce">Cheddar Cheese Sauce</option>
                </select>
                <br/><br/>

                <label for="Sides">Sides:</label>
                <select id="Sides" name="Sides">
                    <option value="French Fries">French Fries</option>
                    <option value="Onion Rings">Onion Rings</option>
                    <option value="Salad">Salad</option>
                    <option value="Coleslaw">Coleslaw</option>
                </select>
                <br/><br/>

                <label for="Quantity">Quantity:</label>
                <input type="number" id="Quantity" name="Quantity" value="1" min="1" required />
                <br/><br/>

                <input type="hidden" id="mealId" name="mealId" />
                <input type="submit" value="Submit Order" />
            </fieldset>
        </form>
    </div>
    <div class="container">
        <h1>Menu</h1>
        <hr>
    <div class="container mt-5">
        <div class="row">
            <?php
            for ($i = 0; $i < count($arrItems); $i++) {
                $id = $arrItems[$i]['id'];
                $restaurantPicture = $arrItems[$i]['picture'];
                $restaurantName = $arrItems[$i]['name'];
                $restaurantPrice = $arrItems[$i]['price'];
                $restaurantSD = $arrItems[$i]['short_description'];
                ?>
                <div class="col-md-6 col-lg-3 mb-4"> 
                    <div class="card">
                        <img src="meals/<?php echo $restaurantPicture; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $restaurantName; ?></h5>
                            <span class="card-price">Price: <?php echo $restaurantPrice; ?></span>
                           <div class="bookmark-icon-container">
    <i class="fa fa-plus" onclick="openOffcanvas(<?php echo $i; ?>)" title="Add to Bookmarks"></i>
</div>
                            <p class="card-text"><?php echo $restaurantSD; ?></p>
                           <!-- <button id="statusButton" onclick="toggleStatus()">Reserve</button> -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
         </div>

    <script>
        function openOffcanvas(index) {
            const items = <?php echo json_encode($arrItems); ?>;
            const item = items[index];
            document.getElementById("mealId").value = item.id; // Set mealId to hidden input field
            const offcanvasCard = document.getElementById('offcanvasCard');
            offcanvasCard.innerHTML = `
                <div class="card">
                    <img src="meals/${item.picture}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <span class="card-price">Price: ${item.price}</span>
                        <p class="card-text">${item.short_description}</p>
                        <button onclick="closeOffcanvas()">Close</button>
                    </div>
                </div>
            `;
            document.getElementById("offcanvas").style.display = "flex";
            document.getElementById("formContainer").style.display = "flex"; // Show the form
        }

        function closeOffcanvas() {
            document.getElementById("offcanvas").style.display = "none";
            document.getElementById("formContainer").style.display = "none"; // Hide the form
        }
    </script>

</body>
</html>