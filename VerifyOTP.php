<?php
session_start();
include("dbFunctions.php");

if (!isset($_SESSION['phonenumber'])) {
    die("Phone number is not set. Please register first.");
}

// Initialize the number of attempts in the session if not already set
if (!isset($_SESSION['otp_attempts'])) {
    $_SESSION['otp_attempts'] = 0; // Counter for failed attempts
}

$phonenumber = $_SESSION['phonenumber']; // Ensure you store the phone number in the session
$otpEntered = $_POST['otp'];

// Check the OTP
$query = "SELECT * FROM OTP WHERE number='$phonenumber' AND otp='$otpEntered'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    // Successful OTP verification
    echo "<h2 class='text-success text-center'>OTP verified successfully! Your account will now be created.</h2>";
    
    // Store user details in the users table
    $username = $_SESSION['username'];
    $password = $_SESSION['password']; // Note: Consider hashing this before inserting
    
    $queryUser = "INSERT INTO users (username, password, phonenumber, role) VALUES ('$username', '$password', '$phonenumber', 'member')";
    $statusUser = mysqli_query($link, $queryUser);
    
    if ($statusUser) {
    echo "<h2 class='text-success text-center'>Your account has been created successfully!</h2>";
    
    // Delete all OTP records for the user after successful account creation
    $deleteOtpQuery = "DELETE FROM OTP WHERE number='$phonenumber'";

    // Clear OTP session data
    unset($_SESSION['phonenumber']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);

    // Display the messages, then redirect to LoginUser.php after a short delay
    echo "<script>
        setTimeout(function() {
            window.location.href = 'LoginUser.php';
        }, 2000); // 2 seconds delay
    </script>";

    // Exit after outputting the script
    exit();
} else {
    echo "<h2 class='text-danger text-center'>Account creation failed: " . mysqli_error($link) . "</h2>";
}
    
    // Reset attempts on success
    unset($_SESSION['otp_attempts']);
    
} else {
    // Invalid OTP
    $_SESSION['otp_attempts']++; // Increment the attempts counter
    echo "<h2 class='text-danger text-center'>Invalid OTP. Please try again.</h2>";

    // Check if the maximum number of attempts has been reached
    if ($_SESSION['otp_attempts'] >= 3) {
        // Delete the OTP record
        $deleteOtpQuery = "DELETE FROM OTP WHERE number='$phonenumber'";
        
        if (mysqli_query($link, $deleteOtpQuery)) {
            echo "<h2 class='text-danger text-center'>Maximum OTP attempts exceeded. Your OTP record has been deleted.</h2>";
        } else {
            echo "<h2 class='text-danger text-center'>Error deleting OTP record: " . mysqli_error($link) . "</h2>";
        }

        // Clear session data
        session_destroy();

        // Redirect to RegisterUser.php
        header("Location: RegisterUser.php");
        exit(); // Stop further execution
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>OTP Verification</title>
   <style>
        body {
            font-family: 'Arial', sans-serif; /* Readable font */
            background-color: #f0f8ff; /* Light background for better contrast */
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>Enter OTP</h2>
    </div>
    <br>
    <div class="text-center">
        <form method="post" action="VerifyOTP.php">
            <label for="idOTP">OTP:</label>
            <input id="idOTP" name="otp" type="text" required />
            <br><br>
            <input type="submit" value="Verify" />
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($link);
?>