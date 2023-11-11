<?php
include('header.php')
?>

<h1>List of Items</h1>
<?php
$query = "SELECT * FROM tbl_games g JOIN tbl_purchased p ON (g.gameId = p.idGame) JOIN tbl_users u ON (p.userId = u.userId)
WHERE u.email = '$_SESSION[name]' OR u.phoneNo = '$_SESSION[name]'";
$query2 = "SELECT * FROM tbl_purchased p JOIN tbl_games g ON (p.idGame = g.gameId) JOIN tbl_users u ON (p.userId = u.userId)
WHERE u.email = '$_SESSION[name]' OR u.phoneNo = '$_SESSION[name]'";
$result2 = mysqli_query($conn, $query2)
    or die("Error in query: " . mysqli_error($conn));
$row2 = mysqli_fetch_row($result2);
$result = mysqli_query($conn, $query)
    or die("Error in query: " . mysqli_error($conn));
echo "<table border = '1' border = '1' class='table table-striped table-hover table-bordered table-sm'>
    <thead>
        <tr>
        <th>Game Name</th>
        <th></th>
        
    </thead>
    </tr>";
while ($row = mysqli_fetch_row($result)) {
    echo "<tr scope='row'>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td><a href='delete.php?gameId=$row2[0]'>Remove from Cart</a></td>";
}
?>
</table>
<?php
include('footer.php')
?>