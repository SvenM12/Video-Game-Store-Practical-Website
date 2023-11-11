<?php
include('header.php');
?>
<?php
if ((isset($_SESSION['name'])) && (isset($_SESSION['password']))) {
    $query = "SELECT role FROM tbl_users WHERE email = '$_SESSION[name]' OR phoneNo = '$_SESSION[name]'";
    $result = mysqli_query($conn, $query)
        or die("Error in query: " . mysqli_error($conn));

    $row = mysqli_fetch_row($result);
    if ($row[0] == 2) {
        echo "Only admins have access to this page.";
        echo '<br/>';
        echo '<a href="index.php">Home</a>';
    } else {
?>
        <h1>ADD</h1>
        <form enctype="multipart/form-data" action="" method="post" class="row g-3 needs validation">
            <div class="col-md-4">
                <label class="form-label">Game Name</label>
                <input type="text" class="form-control" name="gameName" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Platform</label>
                <input class="form-control" type="text" name="platform" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Developer</label>
                <input class="form-control" type="text" name="developer" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Publisher</label>
                <input class="form-control" type="text" name="publisher" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Price</label>
                <input class="form-control" type="number" name="price" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Release Date</label>
                <input class="form-control" type="date" name="releaseDate" placeholder="Enter in yyyy-mm-dd format" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Image</label>
                <input class="form-control" type="file" name="userfile" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Description</label>
                <input class="form-control"type="text" name="description" required>
            </div>

            <br />
            <input type="submit" value="Add" name="submit" class="btn btn-primary">
            <?php
            if ((isset($_POST['submit']))) {
                $gameName = trim($_POST['gameName']);
                $platform = trim($_POST['platform']);
                $developer = trim($_POST['developer']);
                $publisher = trim($_POST['publisher']);
                $price = trim($_POST['price']);
                $releaseDate = date_create(trim($_POST['releaseDate']));
                $releaseDate = date_format($releaseDate, 'Y-m-d');
                $userfile = $_FILES['userfile']['name'];
                $upfile = 'images/' . $userfile;
                $desc = trim($_POST['description']);
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
                    echo "File uploaded successfully.\n";
                } else {
                    echo "Problem: Could not move file to destination directory.\n";
                }
                $gameName = mysqli_escape_string($conn, $gameName);
                $developer = mysqli_escape_string($conn, $developer);
                $publisher = mysqli_escape_string($conn, $publisher);
                $desc = mysqli_escape_string($conn, $desc);
                $query = "INSERT INTO tbl_games (gameTitle, Platform, developer, publisher, price, releaseDate, image, description) VALUES ('$gameName', '$platform', '$developer', '$publisher', '$price', '$releaseDate', '$upfile', '$desc')";
                $result = mysqli_query($conn, $query)
                    or die("Error in query: " . mysqli_error($conn));
                echo '<h1>Game added successfully</h1> <br/>';
            }
            ?>
        </form>
        <hr />
        <h1>DELETE</h1>
        <form action="edittable.php">
            <select name="sel">
                <?php
                $query = "SELECT gameTitle, gameId FROM tbl_games";
                $result = mysqli_query($conn, $query)
                    or die("Error in query: " . mysqli_error($conn));
                while ($row = mysqli_fetch_row($result)) {
                    echo "<option value='$row[0]'>$row[0]</option>";
                }
                
                ?>
            </select>
            <br /><br />
            <input type="submit" value="Delete" name="delete">
            <hr />
            <?php
            if ((isset($_GET['delete']))) {
                $sel = $_GET['sel'];
                $getgameId = "SELECT gameId FROM tbl_games WHERE gameTitle = '$sel'";
                $result = mysqli_query($conn, $getgameId)
                    or die("Error in query: " . mysqli_error($conn));
                $row = mysqli_fetch_row($result);
                $gameId = $row[0];
                $query = "DELETE FROM tbl_purchased WHERE idGame = '$gameId'";
                $query2 = "DELETE FROM tbl_games WHERE gameTitle = '$sel'";
                $result = mysqli_query($conn, $query)
                    or die("Error in query: " . mysqli_error($conn));
                $result = mysqli_query($conn, $query2)
                    or die("Error in query: " . mysqli_error($conn));
                echo '<label>Game has been deleted </label>';
            }
            ?>
        </form>
    <?php
    }
    ?>
<?php
} else {
    echo "Only users have access to this page";
}
include('footer.php');
?>