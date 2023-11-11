<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <h1>Retro Games Store</h1>
    <?php
    if ((isset($_SESSION['name'])) && (isset($_SESSION['password']))) {
        require_once('connection.php');
        $query = "SELECT * FROM tbl_users WHERE email = '$_SESSION[name]' OR phoneNo = '$_SESSION[name]'";
        $result = mysqli_query($conn, $query)
            or die("Error in query: " . mysqli_error($conn));
        $row = mysqli_fetch_row($result);
    ?>
        <div id="profile">
            <img class="avatar" src="<?php echo $row[7]; ?>" width='100px'>
            <form id="change" enctype="multipart/form-data" action="" method="post">
                <label>Change Profile Picture</label>
                <input type="file" name="userfile" value="userfile Profile Picture">
                <input type="submit" value="Apply Changes" name="apply">
                <?php
                if (isset($_POST['apply'])) {
                    $userfile = $_FILES['userfile']['name'];
                    $upfile = 'images/' . $userfile;
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
                        echo "File uploaded successfully.\n";
                        $query = "UPDATE tbl_users SET image = '$upfile' WHERE email = '$_SESSION[name]' 
                    OR phoneNo = '$_SESSION[name]'";
                        $result = mysqli_query($conn, $query)
                            or die("Error in query: " . mysqli_error($conn));
                        header("Refresh:0");
                    } else {
                        echo "No file was found.\n";
                    }
                }
                ?>
            </form>
            <br />
        </div>
    <?php
    }
    ?>
    <title>Document</title>
</head>

<body>
    
    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <?php
                if (!(isset($_SESSION['name'])) && !(isset($_SESSION['password']))) {
                ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>

                    <li>
                        <a href="register.php">Register</a>
                    </li>
                <?php
                } else {
                ?>
                    <li>
                        <a href="cart.php">Cart</a>
                    </li>
                <?php
                if ($row[6] == '1') {
                    ?>
                    <li>
                        <a href="edittable.php">Edit Table</a>
                </i>
                <?php
                }
                }
                ?>
            </ul>
        </nav>
    </header>