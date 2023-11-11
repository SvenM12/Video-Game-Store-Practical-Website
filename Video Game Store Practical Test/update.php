<?php
include('header.php');
$gameId = $_GET['gameId'];
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
        $query2 = "SELECT * FROM tbl_games WHERE gameId = '$gameId'";
        $result2 = mysqli_query($conn, $query2)
            or die("Error in query: " . mysqli_error($conn));
        $row2 = mysqli_fetch_row($result2);
?>
        <h1>UPDATE</h1>
        <p>Note: You do not need to edit all rows</p>
        <p>GameId you are editing: <?php echo $row2[0]?></p>
        <form enctype="multipart/form-data" action="" method="post">
            <br />
            <label>Game Name</label>
            <input type="text" name="gameName" value="<?php echo $row2[1]?>">
            <br />
            <label>Platform</label>
            <input type="text" name="platform" value="<?php echo $row2[2]?>">
            <br />
            <label>Developer</label>
            <input type="text" name="developer" value="<?php echo $row2[3]?>">
            <br />
            <label>Publisher</label>
            <input type="text" name="publisher" value="<?php echo $row2[4]?>">
            <br />
            <label>Price</label>
            <input type="number" name="price" value="<?php echo $row2[5]?>">
            <br />
            <label>Release Date</label>
            <input type="date" name="releaseDate" value="<?php echo $row2[6]?>">
            <br />
            <label>Image</label>
            <input type="file" name="cover" file="<?php echo $row2[7]?>">
            <br />
            <label>Description</label>
            <textarea name="description2" value=""><?php echo $row2[8]?></textarea>
            <br />
            <input type="submit" value="Update" name="upd" >
            <br /><br />
    <?php
        if (isset($_POST['upd'])) {
            $gameName = trim($_POST['gameName']);
            $platform = trim($_POST['platform']);
            $developer = trim($_POST['developer']);
            $publisher = trim($_POST['publisher']);
            $price = trim($_POST['price']);
            $releaseDate = date_create(trim($_POST['releaseDate']));
            $releaseDate = date_format($releaseDate, 'Y-m-d');
            if ($_FILES['cover']['error'] == 4 || ($_FILES['cover']['size'] == 0 && $_FILES['cover']['error'] == 0)) {
                //echo "There is no image";
            } else {
                $userfile2 = $_FILES['cover']['name'];
                $upfile2 = 'images/' . $userfile2;
                if (move_uploaded_file($_FILES['cover']['tmp_name'], $upfile2)) {
                    echo "File uploaded successfully.\n";
                    $query = "UPDATE tbl_games SET image =  '$upfile2' WHERE gameId = $row2[0]";
                    $result = mysqli_query($conn, $query)
                        or die("Error in query: " . mysqli_error($conn));
                }
            }
            $desc = trim($_POST['description2']);
            $fields = array('Platform', 'developer', 'publisher', 'price', 'releaseDate', 'description', 'gameTitle');
            $values = array($platform, $developer, $publisher, $price, $releaseDate, $desc, $gameName);
            for ($i = 0; $i < count($fields); $i++) {
                $value = $values[$i];
                $field = $fields[$i];
                if (!empty($value)) {
                    $value = mysqli_escape_string($conn, $value);
                    $query = "UPDATE tbl_games SET $field = '$value' WHERE gameId = $row2[0]";
                    $result = mysqli_query($conn, $query)
                        or die("Error in query: " . mysqli_error($conn));
                }
            }
            echo "Details have been updated.";
        }
    }
}
    ?>


    <?php
    include('footer.php');
    ?>