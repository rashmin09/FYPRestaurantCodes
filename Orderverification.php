<?php include("navbar.php"); ?>
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
    </style>
</head>
<body>
    <div class="text-center">
        <h2>Order Verification</h2>
    </div>
    <br>
    <div class="container">
        <!-- Display Order Verification Details -->
        <p>Verification Number: <strong>#12345</strong></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Burger</td>
                    <td>2</td>
                    <td>$10</td>
                </tr>
                <tr>
                    <td>Fries</td>
                    <td>1</td>
                    <td>$3</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><strong>Total:</strong></td>
                    <td><strong>$13</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
