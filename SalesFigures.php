<?php
include("navbar.php");
// Database connection
$servername = "localhost"; // 
$username = "root"; // 
$password = ""; // 
$dbname = "restaurant_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to calculate total sales per meal
$sql = "
    SELECT od.name, SUM(od.price * od.quantity) AS total_sales
    FROM orderdetails od
    GROUP BY od.name
";
$result = $conn->query($sql);

$names = [];
$sales = [];

if ($result->num_rows > 0) {
    // Fetch data
    while ($row = $result->fetch_assoc()) {
        $names[] = $row["name"]; // Meal name
        $sales[] = $row["total_sales"]; // Calculated total sales for each meal
    }
} else {
    echo "No sales data found.";
}

$conn->close();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            body {
                font-family: 'Arial', sans-serif; /* Readable font */
                background-color: #DCD1C1; /* Light background for better contrast */
            }
        </style>
    </head>
    <body>
        <br>
        <div class="text-center">
            <h2>Sales Figures</h2>
        </div>
        <div class="container" style="max-width: 100%; padding: 20px;">
            <!-- Increased the width and height of the canvas element -->
            <canvas id="salesChart" width="1200" height="600"></canvas>
        </div>
        <script>
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'bar', // Change to 'line', 'pie', etc., if needed
                data: {
                    labels: <?php echo json_encode($names); ?>, // Meal names (X-axis labels)
                    datasets: [{
                            label: 'Total Sales ($)',
                            data: <?php echo json_encode($sales); ?>, // Total sales (Y-axis data)
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Light green for bars
                            borderColor: 'rgba(75, 192, 192, 1)', // Darker green for borders
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true, // Ensure the Y-axis starts at zero
                            title: {
                                display: true,
                                text: 'Total Sales ($)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Meal Name'
                            }
                        }
                    },
                    responsive: true, // Makes the chart responsive to window resizing
                    maintainAspectRatio: false // Ensure the chart doesn't stretch too much
                }
            });
        </script>
    </body>
</html>
