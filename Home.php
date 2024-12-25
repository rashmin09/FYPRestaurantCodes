<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            body {
                font-family: 'Times New Roman', Georgia, serif;
                background-color: #f8f9fa;
                color: #333;
            }

            .main-content {
                margin-top: 50px;
            }
            
            .welcome-section {
                background-color: #ffffff;
                padding: 40px 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 50px;
            }

            .welcome-section h1 {
                color: #0056b3;
                font-weight: 700;
                text-align: center;
            }

            .welcome-section p {
                font-size: 1.2rem;
                text-align: center;
            }

            .welcome-section .row {
                display: flex;
                align-items: center;
            }

            .welcome-section img {
                width: 100%;
                max-width: 400px;
                margin-left: 20px;
                border-radius: 10px;
            }
            
            .carousel {
                border-radius: 10px;
                overflow: hidden;
            }

            .carousel-container {
                margin-bottom: 50px;
                max-width: 95%; /* Adjust the width of the carousel */
                margin-left: auto;
                margin-right: auto;
            }

            .carousel-inner img {
                height: 500px;
            }

            .locations-section {
                padding: 50px 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                max-width: 95%;
                margin-left: auto;
                margin-right: auto;
            }

            .locations-section h2 {
                margin-bottom: 30px;
                color: #0056b3;
                font-weight: 700;
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
                height: 200px;
                object-fit: cover;
            }

            footer {
                background-color: #343a40;
                color: #ffffff;
                padding: 30px 20px;
                text-align: center;
            }

            footer a {
                color: #ffc107;
                text-decoration: none;
                margin: 0 10px;
                transition: color 0.3s;
            }

            footer a:hover {
                color: #ffd55a;
            }
        </style>
    </head>
    <body>

        <?php include("navbar.php"); ?>
        
        <!-- Welcome Section -->
        <div class="container welcome-section">
            <h1>Welcome to Fortuna!</h1>
            <div class="row">
                <div class="col-md-6">
                    <p>We are thrilled to welcome you to Fortuna, a place where excellence meets comfort and style. Whether you're here to experience our delicious meals, enjoy our services, or simply relax, we promise to deliver an unforgettable experience every time. Our team is dedicated to providing you with the best, and we are excited for you to discover all that we have to offer.</p>
                </div>
                <div class="col-md-6">
                    <img src="your-image-path.jpg" alt="Fortuna">
                </div>
            </div>
        </div>

        <div class="container main-content">
            <!-- Carousel Section -->
            <div class="carousel-container">
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
            </div>
        </div>

        <!-- Locations Section -->
        <div class="locations-section">
            <h2 class="text-center" style="color: black;">Our Locations</h2>
            <div class="row">
                <!-- Location 1 Card -->
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
                <!-- Location 1 Modal -->
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

                <!-- Location 2 Card -->
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
                <!-- Location 2 Modal -->
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

                <!-- Location 3 Card -->
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
                <!-- Location 3 Modal -->
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
            <p>Contact Us: info@ourrestaurant.com | (123) 456-7890</p>
            <p>123 Main Street, City, State, ZIP</p>
        </footer>

    </body>
</html>