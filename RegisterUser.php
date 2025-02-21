<?php
include "navbar.php";

if (isset($_SESSION["user_id"])) {
    header("Location: Home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure CSS is linked properly -->
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #800000; /* Adjust color */
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000; /* Ensure it stays on top */
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column; /* Stack items vertically */
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Ensure full height */
            background-color: #f8f9fa;
            margin: 0;
        }
        .register-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 80px; /* Adjust gap from navbar */
            margin-bottom: 180px; /* Adjust gap from footer */
        }
        .register-box h2 {
            margin-bottom: 20px;
        }
        .register-box label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
        }
        .register-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .register-box button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-box button:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
        }
        .register-box p {
            margin-top: 15px;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
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

<section class="register-container">
    <div class="register-box">
        <h2>Sign Up</h2>
        <form action="RegisterUserCode.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            
            <label for="idPhoneNumber">Mobile Number</label>
            <input id="idPhoneNumber" name="phonenumber" type="tel" placeholder="12345678" required>

            <button type="submit">Register</button>
        </form>
    </div>
</section>

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
