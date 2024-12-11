<?php
include("dbFunctions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the `id` is present and valid
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']); // Sanitize the id as an integer
        $userId = $_SESSION['userId'] ?? 'guest'; // Fetch userId from session or use 'guest'

        // Prepare the DELETE query with an additional condition for `userId`
        $queryDelete = "DELETE FROM orderdetails WHERE id = ? AND userId = ?";
        $stmt = mysqli_prepare($link, $queryDelete);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "is", $id, $userId); // Bind `id` (int) and `userId` (string)

            // Execute the query and check the status
            if (mysqli_stmt_execute($stmt)) {
                header("Location: OrderNow.php?status=success&deletedId=$id");
            } else {
                header("Location: OrderNow.php?status=error&message=Execution failed&id=$id");
            }

            mysqli_stmt_close($stmt);
        } else {
            header("Location: OrderNow.php?status=error&message=Statement preparation failed");
        }
    } else {
        header("Location: OrderNow.php?status=error&message=Invalid ID");
    }

    // Close the database connection
    mysqli_close($link);
    exit();
}
?>
