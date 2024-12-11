<?php include("navbar.php"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif; /* Readable font */
             background-color: #DCD1C1; /* Light background for better contrast */
        }
        footer {
                background-color: #361B1B;
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
    <div class="text-center">
        <h2>Register</h2>
    </div>
    <br>
    <div class="text-center">
        <form method="post" action="RegisterUserCode.php">
            <fieldset>
                <legend>Website Details</legend>
                <label for="idusername">Username:</label>
                <br>
                <input id="idusername" name="username" type="text" required />
                <br><br>
                <label for="idPassword">Password:</label>
                 <br>
                <input id="idPassword" name="password" type="password" required />
                <br><br>
            </fieldset>
            <br/><br/>
            <fieldset>
                <legend>Personal Details</legend>
                <label for="idPhoneNumber">Phone Number:</label>
                 <br>
                <input id="idPhoneNumber" name="phonenumber" type="tel" required placeholder="123-456-7890" />
                <br><br>
            </fieldset>
            <br/><br/>
            <input type="submit" value="Submit" />
        </form>
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