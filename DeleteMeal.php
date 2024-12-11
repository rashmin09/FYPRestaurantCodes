<?php
include ("dbFunctions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $sauces = $_POST['sauces'];
    $sides = $_POST['sides'];
    $quantity = $_POST['quantity'];

$queryDelete = "DELETE FROM orderdetails 
               WHERE id = $id";

$status = mysqli_query($link, $queryDelete) or die(mysqli_error($link));

mysqli_close($link);
header("Location: OrderNow.php?id=$id");
exit();
}
?>
