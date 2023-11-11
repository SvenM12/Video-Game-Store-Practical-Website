<?php
include('header.php');
header('Location: cart.php');
$itemId = $_GET['gameId'];
$query2 = "SELECT userId FROM tbl_users WHERE email = '$_SESSION[name]' OR phoneNo = '$_SESSION[name]'";
$result2 = mysqli_query($conn, $query2)
    or die("Error in query: " . mysqli_error($conn));
$row2 = mysqli_fetch_row($result2);
$userId = $row2[0];
$query = "INSERT INTO tbl_purchased (userId, idGame) VALUES ('$userId', '$itemId')";
$result = mysqli_query($conn, $query)
    or die("Error in query: " . mysqli_error($conn));
?>