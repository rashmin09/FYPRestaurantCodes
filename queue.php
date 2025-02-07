<?php 
session_start();  // Ensure session starts before accessing session variables
include("navbar.php"); 
include "dbFunctions.php";  // Ensure this file correctly initializes $link (database connection)

// Check if session userId exists, otherwise set to 'guest'
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'guest';

// Generate a random 6-digit verification code
$verificationCode = random_int(100000, 999999);

// Generate a sequential checkoutId
$queryLastCheckoutId = "SELECT MAX(checkoutId) AS lastCheckoutId FROM queuetable";
$result = mysqli_query($link, $queryLastCheckoutId);
$row = mysqli_fetch_assoc($result);

// Assign checkoutId: If no records exist, start from 1000; otherwise, increment last checkoutId
$checkoutId = isset($row['lastCheckoutId']) ? $row['lastCheckoutId'] + 1 : 1000;

// Insert new record into queuetable
$queryInsertQueue = "INSERT INTO queuetable (checkoutId, userId, verification, status, phonenumber) 
                     VALUES (?, ?, ?, 'Open', NULL)";
$stmt = mysqli_prepare($link, $queryInsertQueue);
mysqli_stmt_bind_param($stmt, 'iss', $checkoutId, $userId, $verificationCode);
mysqli_stmt_execute($stmt);

// Retrieve the inserted queue_number
$queryRetrieveQueue = "SELECT queue_number FROM queuetable WHERE checkoutId = ?";
$stmtQueue = mysqli_prepare($link, $queryRetrieveQueue);
mysqli_stmt_bind_param($stmtQueue, 'i', $checkoutId);
mysqli_stmt_execute($stmtQueue);
mysqli_stmt_bind_result($stmtQueue, $queueNumber);
mysqli_stmt_fetch($stmtQueue);

// Close database connection
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmtQueue);
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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

        <?php if (isset($_SESSION['userId'])) { ?>
            <?php if ($_SESSION['role'] == "member") { ?>
                <p>Please verify your queue number and code below.</p>
                <form method="post" action="Home.php">
                    <div class="mb-3">
                        <label for="idqueuenumber" class="form-label">Queue Number:</label>
                        <input type="text" class="form-control text-center" id="idqueuenumber" name="queueNumber" 
                               value="<?php echo htmlspecialchars($queueNumber); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="idverificationcode" class="form-label">Verification Code:</label>
                        <input type="text" class="form-control text-center" id="idverificationcode" name="verificationCode" 
                               value="<?php echo htmlspecialchars($verificationCode); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Return</button>
                </form>
            <?php } else { ?>
                <p>Please enter your phone number for verification:</p>
                <form method="post" action="PhoneVerification.php">
                    <div class="mb-3">
                        <label for="idphonenumber" class="form-label">Phone Number:</label>
                        <input type="tel" class="form-control text-center" id="idphonenumber" name="phoneNumber" 
                               pattern="[0-9]{8}" placeholder="Enter 8-digit phone number" required>
                        <input type="hidden" name="queueNumber" value="<?php echo htmlspecialchars($queueNumber); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } ?>
        <?php } else { ?>
            <p>Please enter your phone number:</p>
            <form method="post" action="PhoneVerification.php">
                <div class="mb-3">
                    <label for="idphonenumber" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control text-center" id="idphonenumber" name="phoneNumber" 
                           pattern="[0-9]{8}" placeholder="Enter 8-digit phone number" required>
                    <input type="hidden" name="queueNumber" value="<?php echo htmlspecialchars($queueNumber); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
