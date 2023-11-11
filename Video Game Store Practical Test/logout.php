<?php
session_start();
include('header.php');
header("Location: index.php");
?>

    <?php
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    session_destroy();
    include('footer.php');
    ?>