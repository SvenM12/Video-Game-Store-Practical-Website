<?php
include('header.php');
?>

<?php
if ((isset($_SESSION['name'])) && (isset($_SESSION['password']))) {
    echo 'You are logged in.';
} else {

?>
    <h1>
        Login
    </h1>
    <form method="post" action="login.php">
        <label>Email OR Phone Number</label>
        <input type="text" name="emphone">
        <br />
        <label>Password</label>
        <input type="password" name="password">
        <br />
        <input type="submit" value="Login" name="submit">
    <?php
    if ((isset($_POST['submit']))) {
        $var = "";
        $name = $_POST['emphone'];
        $password = $_POST['password'];
        if (empty($name) || empty($password)) {
            echo "Please fill in every field.";
        } else {
            if (strlen($password) < 3) {
                $var .= "invalid";
                echo "Password must have a minimum of 3 characters.";
            }
            if (empty($var)) {
                require_once('connection.php');
                $query = "SELECT * FROM tbl_users WHERE email= '$name' OR phoneNo = '$name'";
                $query2 = "SELECT COUNT(*) FROM tbl_users WHERE firstName = '$name'";
                $result = mysqli_query($conn, $query)
                    or die("Error in query: " . mysqli_error($conn));

                $row = mysqli_fetch_row($result);
                $count = $row[0];
                if ($count > 0) {
                    if (password_verify($password, $row[3])) {
                        if ($row[6] == 1) {
                            echo "You are an admin.";
                            $_SESSION['name'] = $name;
                            $_SESSION['password'] = $password;
                            echo '<br/>';
                            echo '<a href="edittable.php">Edit Table</a>';
                            header('Location: login.php');
                        } else {
                            echo "You are logged in as: $name";
                            $_SESSION['name'] = $name;
                            $_SESSION['password'] = $password;
                            echo '<br/>';
                            echo '<a href="index.php">Home</a>';
                            header('Location: login.php');
                        }
                    } else {
                        echo "Incorrect email/Phone Number or password.";
                    }
                } else {
                    echo "Incorrect email/Phone Number or password.";
                }
            }
        }
    }
}
    ?>

    </form>
    <?php
    include('footer.php');
    ?>