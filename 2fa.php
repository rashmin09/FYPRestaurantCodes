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