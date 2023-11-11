<?php
include('header.php');
header('Location: cart.php');
$gameId = $_GET['gameId'];
$query = "DELETE FROM tbl_purchased WHERE id = '$gameId'";
$result = mysqli_query($conn, $query)
    or die("Error in query: " . mysqli_error($conn));
    if ($result) {
        echo "Item removed from cart.";
    }
?>