<?php
include("dbFunctions.php");
session_start(); // Ensure session is started

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);
        $userId = $_SESSION['userId'] ?? 'guest'; 

        // Check if the meal exists for the user
        $queryCheck = "SELECT * FROM orderdetails WHERE id = ? AND userId = ?";
        $stmtCheck = mysqli_prepare($link, $queryCheck);
        mysqli_stmt_bind_param($stmtCheck, "is", $id, $userId);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);
        $orderExists = mysqli_fetch_assoc($resultCheck);
        mysqli_stmt_close($stmtCheck);

        if ($orderExists) {
            // Proceed with deletion if the meal exists for the user
            $queryDelete = "DELETE FROM orderdetails WHERE id = ? AND userId = ?";
            $stmt = mysqli_prepare($link, $queryDelete);
            mysqli_stmt_bind_param($stmt, "is", $id, $userId);
            
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>
<?php
include("dbFunctions.php");
session_start(); // Ensure session is started

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);
        $userId = $_SESSION['userId'] ?? 'guest'; 
        
        // Check if the meal exists for the user
        $queryCheck = "SELECT * FROM orderdetails WHERE id = ? AND userId = ?";
        $stmtCheck = mysqli_prepare($link, $queryCheck);
        mysqli_stmt_bind_param($stmtCheck, "is", $id, $userId);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);
        $orderExists = mysqli_fetch_assoc($resultCheck);
        mysqli_stmt_close($stmtCheck);

        if ($orderExists) {
            // Proceed with deletion if the meal exists for the user
            $queryDelete = "DELETE FROM orderdetails WHERE id = ? AND userId = ?";
            $stmt = mysqli_prepare($link, $queryDelete);
            mysqli_stmt_bind_param($stmt, "is", $id, $userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Close the database connection
    mysqli_close($link);
}
?>
