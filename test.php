<!-- Updated Navbar -->
<?php
session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar {
            background-color: #2C3E50; /* New color scheme: dark blue */
            border-bottom: none; /* Remove white line */
        }
        .navbar-brand {
            font-family: 'Roboto', sans-serif; /* Modern font */
            font-size: 1.5rem;
            font-weight: bold;
            color: #ECF0F1;
        }
        .navbar-nav .nav-link {
            font-size: 1rem;
            color: #ECF0F1;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #18BC9C; /* Hover color */
        }
        /* Reset styles for a fresh look */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #444;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: 600;
        }

        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        .section {
            padding: 50px 20px;
            text-align: center;
        }
        .popular-dish {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        .popular-dish img {
            width: 100%;
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
        }
        .popular-dish .text {
            flex: 1;
            padding: 10px;
            max-width: 600px;
            text-align: left;
        }
        .popular-dish-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Locations Section */
        .locations-section {
            background-color: #ffffff;
            padding: 80px 20px;
            margin-top: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .locations-section h2 {
            font-size: 2.5rem;
            color: #e74c3c;
            margin-bottom: 40px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            border-radius: 10px 10px 0 0;
            height: 250px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            text-align: left;
        }

        .card-title {
            font-size: 1.5rem;
            color: #e74c3c;
        }

        .card-text {
            color: #777;
            font-size: 1rem;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 40px 20px;
            text-align: center;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1rem;
        }

        footer a:hover {
            color: #ffd55a;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="Home.php">YourLogo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="LoginUser.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>

<!-- Updated Homepage -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F8F9FA; /* Light background */
        }
        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        .section {
            padding: 50px 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Carousel/Carousel1.png" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Carousel/Carousel2.png" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Carousel/Carousel3.png" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="section">
        <h2>About Our Restaurant</h2>
        <p>Welcome to a culinary journey like no other. Experience the flavors of the world on your plate.</p>
    </div>

    <div class="section" style="background-color: #E9ECEF;">
        <h2>Popular Dishes</h2>
        <p>Our most loved meals, crafted to perfection.</p>
    </div>
    <div class="popular-dish">
            <img src="meals/placeholder1.jpg" alt="Dish Image">
            <div class="text">
                <h3>Dish Name</h3>
                <p>A short description of the dish, highlighting its unique flavors and ingredients.</p>
            </div>
        </div>
        <div class="popular-dish">
            <div class="text">
                <h3>Dish Name</h3>
                <p>A short description of the dish, highlighting its unique flavors and ingredients.</p>
            </div>
            <img src="meals/placeholder2.jpg" alt="Dish Image">
        </div>
        <div class="popular-dish">
            <img src="meals/placeholder3.jpg" alt="Dish Image">
            <div class="text">
                <h3>Dish Name</h3>
                <p>A short description of the dish, highlighting its unique flavors and ingredients.</p>
            </div>
        </div>
        <div class="popular-dish">
            <div class="text">
                <h3>Dish Name</h3>
                <p>A short description of the dish, highlighting its unique flavors and ingredients.</p>
            </div>
            <img src="meals/placeholder4.jpg" alt="Dish Image">
        </div>

    <div class="section">
        <h2>Visit Us</h2>
        <p>Find us at our prime location and enjoy a delightful meal.</p>
    </div>
    <!-- Locations Section -->
    <div class="container locations-section">
        <h2>Our Locations</h2>
        <div class="row">
            <!-- Location 1 -->
            <div class="col-md-4 mb-4">
                <div class="card" data-bs-toggle="modal" data-bs-target="#location1Modal">
                    <img src="Locations/Loc1.jpg" alt="Location 1">
                    <div class="card-body">
                        <h5 class="card-title">51@Ang Mo Kio</h5>
                        <p class="card-text">Location: Northeast</p>
                        <p class="card-text">Opening Times: 10 AM - 10 PM</p>
                    </div>
                </div>
            </div>
            <!-- Modal for Location 1 -->
            <div class="modal fade" id="location1Modal" tabindex="-1" aria-labelledby="location1ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="location1ModalLabel">51@Ang Mo Kio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="Locations/Loc1.jpg" alt="Location 1" class="img-fluid mb-3">
                            <p><strong>Location:</strong> Northeast</p>
                            <p><strong>Opening Times:</strong> 10 AM - 10 PM</p>
                            <p>Additional details about this location can be displayed here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location 2 -->
            <div class="col-md-4 mb-4">
                <div class="card" data-bs-toggle="modal" data-bs-target="#location2Modal">
                    <img src="Locations/Loc2.jpg" alt="Location 2">
                    <div class="card-body">
                        <h5 class="card-title">Balestier Point</h5>
                        <p class="card-text">Location: Central</p>
                        <p class="card-text">Opening Times: 8 AM - 11 PM</p>
                    </div>
                </div>
            </div>
            <!-- Modal for Location 2 -->
            <div class="modal fade" id="location2Modal" tabindex="-1" aria-labelledby="location2ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="location2ModalLabel">Balestier Point</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="Locations/Loc2.jpg" alt="Location 2" class="img-fluid mb-3">
                            <p><strong>Location:</strong> Central</p>
                            <p><strong>Opening Times:</strong> 8 AM - 11 PM</p>
                            <p>Additional details about this location can be displayed here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location 3 -->
            <div class="col-md-4 mb-4">
                <div class="card" data-bs-toggle="modal" data-bs-target="#location3Modal">
                    <img src="Locations/Loc3.jpg" alt="Location 3">
                    <div class="card-body">
                        <h5 class="card-title">The Adelphi</h5>
                        <p class="card-text">Location: Central</p>
                        <p class="card-text">Opening Times: 8 AM - 10 PM</p>
                    </div>
                </div>
            </div>
            <!-- Modal for Location 3 -->
            <div class="modal fade" id="location3Modal" tabindex="-1" aria-labelledby="location3ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="location3ModalLabel">The Adelphi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="Locations/Loc3.jpg" alt="Location 3" class="img-fluid mb-3">
                            <p><strong>Location:</strong> Central</p>
                            <p><strong>Opening Times:</strong> 8 AM - 10 PM</p>
                            <p>Additional details about this location can be displayed here.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Location 4 Card -->
                <div class="col-md-4 mb-4">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#location4Modal">
                        <img src="Locations/Loc4.jpg" alt="Location 4">
                        <div class="card-body">
                            <h5 class="card-title">Valley Point</h5>
                            <p class="card-text">Location: Northwest</p>
                            <p class="card-text">Opening Times: 7 AM - 10:30 PM</p>
                        </div>
                    </div>
                </div>
                <!-- Location 4 Modal -->
                <div class="modal fade" id="location4Modal" tabindex="-1" aria-labelledby="location4ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="location4ModalLabel">Valley Point</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="Locations/Loc4.jpg" alt="Location 4" class="img-fluid mb-3">
                                <p><strong>Location:</strong> Northwest</p>
                                <p><strong>Opening Times:</strong> 7 AM - 10:30 PM</p>
                                <p>Additional details about this location can be displayed here.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location 5 Card -->
                <div class="col-md-4 mb-4">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#location5Modal">
                        <img src="Locations/Loc5.jpg" alt="Location 5">
                        <div class="card-body">
                            <h5 class="card-title">Woodgrove</h5>
                            <p class="card-text">Location: North</p>
                            <p class="card-text">Opening Times: 24 hours</p>
                        </div>
                    </div>
                </div>
                <!-- Location 5 Modal -->
                <div class="modal fade" id="location5Modal" tabindex="-1" aria-labelledby="location5ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="location5ModalLabel">Woodgrove</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="Locations/Loc5.jpg" alt="Location 5" class="img-fluid mb-3">
                                <p><strong>Location:</strong> North</p>
                                <p><strong>Opening Times:</strong> 24 hours</p>
                                <p>Additional details about this location can be displayed here.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location 6 Card -->
                <div class="col-md-4 mb-4">
                    <div class="card" data-bs-toggle="modal" data-bs-target="#location6Modal">
                        <img src="Locations/Loc6.jpg" alt="Location 6">
                        <div class="card-body">
                            <h5 class="card-title">Yew Tee Point</h5>
                            <p class="card-text">Location: Mid-town</p>
                            <p class="card-text">Opening Times: 7 AM - 10:30 PM</p>
                        </div>
                    </div>
                </div>
                <!-- Location 6 Modal -->
                <div class="modal fade" id="location6Modal" tabindex="-1" aria-labelledby="location6ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="location6ModalLabel">Yew Tee Point</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="Locations/Loc6.jpg" alt="Location 6" class="img-fluid mb-3">
                                <p><strong>Location:</strong> Mid-town</p>
                                <p><strong>Opening Times:</strong> 7 AM - 10:30 PM</p>
                                <p>Additional details about this location can be displayed here.</p>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>Follow us on social media:</p>
        <a href="https://www.facebook.com/" target="_blank">Facebook</a> |
        <a href="https://www.instagram.com/" target="_blank">Instagram</a> |
        <a href="https://twitter.com/" target="_blank">Twitter</a>
        <p>Contact Us: info@ourrestaurant.com | +65 1234 5678</p>
        <p>Example Street 1, Postal Code</p>
    </footer>
</body>
</html>
