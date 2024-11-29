<?php include("navbar.php"); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            body {
                font-family: 'Arial', sans-serif; /* Readable font */
                background-color: #f4f4f4; /* Light background for better contrast */
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1200px;
                margin: 50px auto;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                text-align: center;
                background-color: #fff;
            }

            h1 {
                color: #835E4E;
            }

            h2 {
                text-align: center; /* Centering the header */
                color: #333;
            }

            p {
                color: #333;
                line-height: 1.6;
            }

            .carousel {
                margin: 20px 0; /* Add margin for spacing */
                max-width: 900px;
                margin-left: auto;
                margin-right: auto;
            }

            .carousel-inner img {
                height: 400px;
                object-fit: cover;
                border-radius: 10px;
            }

            /* Card styling */
            .card img {
                height: 200px; /* Set a fixed height for images */
                object-fit: cover; /* Maintain aspect ratio and cover the area */
                border-radius: 5px;
            }
            footer {
                background-color: #333;
                color: white;
                padding: 20px;
                text-align: center;
            }

            footer a {
                color: #f2f2f2;
                text-decoration: none;
            }

            footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <br>
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="Carousel/Banner1.png" class="d-block w-100" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="Carousel/Banner2b.png" class="d-block w-100" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="Carousel/Banner3.png" class="d-block w-100" alt="Image 3">
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

        <!-- Locations section -->
        <div class="container">
            <h2>Our Locations</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="Locations/Loc1.jpg" alt=""/>
                        <div class="card-body">
                            <h5 class="card-title">51@Ang Mo kio</h5>
                            <p class="card-text">Location: Northeast</p>
                            <p class="card-text">Opening Times: 10 AM - 10 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="Locations/Loc2.jpg" alt=""/>
                        <div class="card-body">
                            <h5 class="card-title">Balestier Point</h5>
                            <p class="card-text">Location: Central</p>
                            <p class="card-text">Opening Times: 8 AM - 11 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="Locations/Loc3.jpg" alt=""/>
                        <div class="card-body">
                            <h5 class="card-title">The Adelphi</h5>
                            <p class="card-text">Location: Central</p>
                            <p class="card-text">Opening Times: 8 AM - 10 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="Locations/Loc4.jpg" alt=""/>
                        <div class="card-body">
                            <h5 class="card-title">Valley point</h5>
                            <p class="card-text">Location: Northwest</p>
                            <p class="card-text">Opening Times: 7 AM - 10:30 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="Locations/Loc5.jpg" alt=""/>
                        <div class="card-body">
                            <h5 class="card-title">Woodgrove</h5>
                            <p class="card-text">Location: North</p>
                            <p class="card-text">Opening Times: 24 hours</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="Locations/Loc6.jpg" alt=""/>
                        <div class="card-body">
                            <h5 class="card-title">Yew Tee Point</h5>
                            <p class="card-text">Location: Mid-town</p>
                            <p class="card-text">Opening Times: 7 AM - 10:30 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <h2>Follow Us</h2>
            <p>Stay updated on our latest news and promotions:</p>
            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i> Facebook</a> |
            <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i> Instagram</a> |
            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
            <br><br>
            <h2>Contact Us</h2>
            <p>Email: info@ourrestaurant.com</p>
            <p>Phone: (123) 456-7890</p>
            <p>Address: 123 Main Street, City, State, ZIP</p>
        </footer>
    </body>
</html>
