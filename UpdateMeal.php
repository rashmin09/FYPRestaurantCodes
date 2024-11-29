<?php
include "dbFunctions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $sauces = $_POST['sauces'];
    $sides = $_POST['sides'];
    $quantity = $_POST['quantity'];

    $query = "UPDATE orderdetails 
              SET sauces = '$sauces', sides = '$sides', quantity = $quantity 
              WHERE id = $id";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_close($link);

    // Redirect to OrderNow.php with the edited item's ID
    header("Location: OrderNow.php?id=$id");
    exit();
}
?>