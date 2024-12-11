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
        fieldset {
            border: none; /* Remove the border of the fieldset */
            color: #484848; /* Color for "Login Details" */
        }
        label {
            color: #484848; /* Color for "Username" and "Password" labels */
        }
        input[type="submit"] {
    background-color: #9B1010; /* Red background color */
    color: white; /* White text */
    border: none; /* Remove border */
    padding: 10px 20px; /* Padding for the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 20px; /* Increase the border-radius for a more rounded effect */
    transition: background-color 0.3s; /* Smooth hover transition */
}

input[type="submit"]:hover {
    background-color: #7F0E0E; /* Darker red on hover */
}
        .register-link {
            font-size: 0.9em; /* Smaller text */
            color: #484848; /* Text color */
        }
        .register-link a {
            text-decoration: underline; /* Underline the link */
            color: #9B1010; /* Red color for the link */
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
        <h2>Login</h2>
    </div>
    <br>
    <div class="text-center">
        <form method="post" action="LoginUserCode.php">
            <fieldset>
                <legend>Login Details</legend>
                <label for="idusername">Username:</label>
                <br>
                <input id="idusername" name="username" type="text" required />
                <br><br>
                <label for="idPassword">Password:</label>
                 <br>
                <input id="idPassword" name="password" type="password" required />
                <br>
                <span class="register-link">
                    Don't have an account? <a href="RegisterUser.php">Register now</a>
                </span>
                <br><br>
                <input type="submit" value="Login" />
            </fieldset>
        </form>
    </div>
      <footer>
          <div style="display: flex">
          <div style="flex:1">
            <h2>Follow Us</h2>
            <p>Stay updated on our latest news and promotions:</p>
            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i> Facebook</a> |
            <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i> Instagram</a> |
            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
          </div>
            <br><br>
          <div style=" flex:1">
            <h2>Contact Us</h2>
            <p>Email: info@ourrestaurant.com</p>
            <p>Phone: (123) 456-7890</p>
            <p>Address: 123 Main Street, City, State, ZIP</p>
          </div>
          </div>
        </footer>
</body>
</html>