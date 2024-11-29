<?php
// dbFunctions.php

// Database connection details
$host = "localhost"; // or your host, e.g. localhost
$username = "root";  // your database username
$password = "";      // your database password
$dbname = "restaurant_db"; // your database name

// Create a connection
$link = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>