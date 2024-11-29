<?php
// Start the session
session_start();

// Include the database connection file
include "dbFunctions.php"; // Ensure this file contains the $link connection logic

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if connection is successful
    if ($link) {

        // Get form data and sanitize inputs
        $mealType = mysqli_real_escape_string($link, $_POST['mealtype']);
        $mealName = mysqli_real_escape_string($link, $_POST['name']);
        $price = mysqli_real_escape_string($link, $_POST['price']);
        $shortDescription = mysqli_real_escape_string($link, $_POST['short_description']);
        
        // Handle file upload (photo)
        $targetDir = "meals/"; // Directory where the photo will be saved
        $fileName = basename($_FILES["mealPhoto"]["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if the file is a valid image
        if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["mealPhoto"]["tmp_name"], $targetFile)) {
                // If the file is uploaded successfully, insert the data into the database
                $userId = $_SESSION['userId']; // Assuming userId is stored in session after login

                // Insert query with only the filename stored in the database
                $query = "INSERT INTO meals (userId, mealtype, picture, name, price, short_description) 
                          VALUES ('$userId', '$mealType', '$fileName', '$mealName', '$price', '$shortDescription')";
                
                if (mysqli_query($link, $query)) {
                    // Redirect to MealSets.php with a success message
                    echo "<script>alert('Meal added successfully!'); window.location.href = 'MealSets.php';</script>";
                } else {
                    // Redirect to MealSets.php with an error message
                    echo "<script>alert('Error: " . mysqli_error($link) . "'); window.location.href = 'MealSets.php';</script>";
                }
            } else {
                // Redirect to MealSets.php with an upload error message
                echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'MealSets.php';</script>";
            }
        } else {
            // Redirect to MealSets.php with an invalid file format message
            echo "<script>alert('Invalid file format. Only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href = 'MealSets.php';</script>";
        }
    } else {
        // Redirect to MealSets.php with a connection error message
        echo "<script>alert('Database connection failed.'); window.location.href = 'MealSets.php';</script>";
    }
}

mysqli_close($link); // Close the database connection if it's open
?>