<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif; /* Readable font */
            background-color: #f0f8ff; /* Light background for better contrast */
        }
    </style>
    <script>
        function validateDescription() {
            var description = document.getElementById("shortDescription").value.trim();
            var wordCount = description.split(/\s+/).length;

            if (wordCount > 10) {
                alert("Short description can only include up to 10 words.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
        <?php include 'navbar.php'; ?>
    <div class="text-center">
        <h2>Register Meal</h2>
    </div>
    <br>
    <div class="container">
<form method="post" action="AddMealCode.php" enctype="multipart/form-data">
    <!-- Meal Type Selection -->
    <label for="mealtype">Meal Type:</label>
    <select id="mealtype" name="mealtype" class="form-control" required>
        <option value="Burger">Burger</option>
        <option value="Chicken">Chicken</option>
        <option value="Fish">Fish</option>
        <option value="Rice">Rice</option>
        <option value="Dessert">Dessert</option>
        <option value="Drinks">Drinks</option>
    </select>
    <br>

    <!-- Meal Photo -->
    <label for="mealPhoto">Upload Photo:</label>
    <input id="mealPhoto" name="mealPhoto" type="file" class="form-control" accept="image/*" required />
    <br>

    <!-- Meal Name -->
    <label for="name">Meal Name:</label>
    <textarea id="mealname" name="name" class="form-control" rows="1" required placeholder="Enter Meal name"></textarea>
    <br>

    <!-- Price -->
    <label for="price">Price:</label>
    <input id="price" name="price" type="number" step="0.01" class="form-control" required placeholder="Enter price" />
    <br>

    <!-- Short Description -->
    <label for="short_description">Short Description:</label>
    <textarea id="short_description" name="short_description" class="form-control" rows="3" required placeholder="Enter a short description"></textarea>
    <br>

    <input type="submit" value="Submit" class="btn btn-primary" />
</form>
    </div>
</body>
</html>