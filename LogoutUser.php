<?php
session_start();
if (isset($_SESSION['userId'])) {
    session_destroy();
    session_unset(); 
    $_SESSION = array();
}
$message = "You have logged out.";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="stylesheets/style.css" />
    </head>
    <body>
        <?php include "navbar.php" ?>
        <h3>Logout</h3>
        <?php
        echo $message;
        ?>
    </body>
</html>