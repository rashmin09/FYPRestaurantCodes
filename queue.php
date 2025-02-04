<?php 
include("navbar.php"); 
include "dbFunctions.php";

// Get the userId from the session or default to 'guest'
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'guest';

// Generate a random 6-digit verification code
$verificationCode = random_int(100000, 999999);

// Generate a sequential checkoutId
$queryLastCheckoutId = "SELECT MAX(checkoutId) AS lastCheckoutId FROM QueueTable";
$result = mysqli_query($link, $queryLastCheckoutId);
$row = mysqli_fetch_assoc($result);

// If there are no records, start from 1; otherwise, increment the last checkoutId
$checkoutId = isset($row['lastCheckoutId']) ? $row['lastCheckoutId'] + 1 : 1;

// Insert a new record into QueueTable
$queryInsertQueue = "INSERT INTO QueueTable (checkoutId, userId, verification, status) 
                     VALUES (?, ?, ?, 'Open')";

$stmt = mysqli_prepare($link, $queryInsertQueue);
mysqli_stmt_bind_param($stmt, 'iss', $checkoutId, $userId, $verificationCode);

// Execute the query
mysqli_stmt_execute($stmt);

// Retrieve the auto-incremented queue_number
$queueNumber = mysqli_insert_id($link);

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #DCD1C1;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Your Queue Details</h1>
        <p>Please verify your queue number and code below.</p>
        <form method="post" action="VerifyOTP.php">
            <div class="mb-3">
                <label for="idqueuenumber" class="form-label">Queue Number:</label>
                <input type="text" class="form-control text-center" id="idqueuenumber" name="queueNumber" value="<?php echo $queueNumber; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="idverificationcode" class="form-label">Verification Code:</label>
                <input type="text" class="form-control text-center" id="idverificationcode" name="verificationCode" value="<?php echo $verificationCode; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
</body>
</html>