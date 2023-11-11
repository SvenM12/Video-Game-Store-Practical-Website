<?php
include('header.php');
?>
    <?php
    if ((isset($_SESSION['name'])) && (isset($_SESSION['password']))) {
    require_once('connection.php');
    $query = "SELECT * FROM tbl_games";
    $result = mysqli_query($conn, $query)
        or die("Error in query: " . mysqli_error($conn));
    echo "<table border = '1' class='table table-striped table-hover table-bordered table-sm'>
        <thead>
            <tr>
            <th scope='col'>Game Name</th>
            <th scope='col'>Platform</th>
            <th scope='col'>Developer</th>
            <th scope='col'>Publisher</th>
            <th scope='col'>Price</th>
            <th scope='col'>Release Date</th>
            <th scope='col'>Cover Box</th>
            <th scope='col'>Description</th>
        </thead>
        </tr>";
    while ($row = mysqli_fetch_row($result)) {
        $count = 2;
        $count++;
        echo "<tr scope='row'>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[3] . "</td>";
        echo "<td>" . $row[4] . "</td>";
        echo "<td> $" . $row[5] . "</td>";
        echo "<td>" . $row[6] . "</td>";
        ?>
        <td> <img src="<?php echo $row[7]; ?>" width='100px' </td>
    <?php
    echo "<td>" . $row[8] . "</td>";
    ?>
    <td><a href="buy.php?gameId=<?php echo $row[0]; ?>">Add To Cart</a></td>
    <td><a href="update.php?gameId=<?php echo $row[0]; ?>">Update</a></td>
    <?php
    }
    echo "</table>";
    } else {
        echo "You are not logged in.";
        echo '<br/>';
        echo '<a href="login.php">Login</a>';
    }
    ?>
    </tr>
    </table>
    <?php
    if ((isset($_SESSION['name'])) && isset($_SESSION['password']))
    {
        $query = "SELECT role FROM tbl_users WHERE email = '$_SESSION[name]' OR phoneNo = '$_SESSION[name]'";
        $result = mysqli_query($conn, $query)
            or die("Error in query: " . mysqli_error($conn));
        $row = mysqli_fetch_row($result);
        if ($row[0] == 1) {
            echo '<a href="edittable.php">Edit Table</a>';
        }
    }
    ?>
<?php
include('footer.php');
?>