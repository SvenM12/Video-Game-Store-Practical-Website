<?php
include('header.php');
?>
<script src="https://unpkg.com/validator@latest/validator.min.js"></script>
<form id="basic_form" enctype="multipart/form-data" method="post" class="row g-3">
    <div class="col-md-4">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" name="firstname" id="fname" class="form-control"><br />        
    </div>
    <div class="col-md-4">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lastname" id="lname" class="form-control"><br />
    </div>
    <div class="col-md-4">
        <label class="form-label">Password:</label>
        <input type="password" name="password" id="pass" class="form-control"><br />
    </div>
    <br />
    <div class="col-md-4">
        <label class="form-label">Phone Number:</label>
        <input type="number" id="validationCustom04" name="phoneNo" id="phone" class="form-control"><br />
    </div>
    <div class="col-md-4">
        <label class="form-label">Email Address:</label>
        <input type="text" name="email" id="em" class="form-control"><br />
    </div>
    <div class="col-md-4">
        <label class="form-label">Profile Picture:</label>
        <input type="file" name="profilePic" id="pfp" class="form-control"><br />
    </div>
    <div class="col-md-4">
        <label class="form-label">User Type</label>
        <select name="userType" class="form-control">
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>
    </div>
    <br />
    <button type="submit" id="sub" class="btn btn-primary" name="sub">Submit</button>
    <br />
</form>

<?php
if (isset($_POST['sub'])) {
    $var = "";
    if (
        empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['phoneNo'])
        || empty($_POST['email']) || empty($_POST['password'])
    ) {
        echo 'Please fill in all details<br/>';
    } else {
        if (strlen($_POST['firstname']) < 3 || strlen($_POST['lastname']) < 3 || strlen($_POST['password']) < 3) {
            $var .= "invalid";
            echo "name, surname and password need to have a minimum of 3 characters <br/>";
        }
        if (!preg_match("/^[a-zA-Z-']*$/", $_POST['firstname']) || !preg_match("/^[a-zA-Z-']*$/", $_POST['lastname'])) {
            $var .= "invalid";
            echo "Only letters for name and surname allowed";
        } else if (strlen($_POST['firstname']) > 15 || strlen($_POST['lastname']) > 15) {
            $var .= "invalid";
            echo "name and surname need to have not more than 15 characters <br/>";
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $var .= "invalid";
            echo "Invalid email. <br/>";
        }
        if (strlen($_POST['phoneNo']) < 8) {
            $var .= "invalid";
            echo "A minimum of 8 characters is required for phone Number <br/>";
        }
        if (preg_match("/^[a-zA-Z-' ]*$/", $_POST['phoneNo'])) {
            $var .= "invalid";
            echo "Only numbers are allowed for the phone Number field <br/>";
        }
        $firstName = trim($_POST['firstname']);
        $lastName = trim($_POST['lastname']);
        $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $phoneNo = trim($_POST['phoneNo']);
        $email = trim($_POST['email']);
        $userfile = $_FILES['profilePic']['name'];
        $upfile = 'images/' . $userfile;
        $userType = trim($_POST['userType']);
        require_once('connection.php');
        if ($var == "") {
            if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $upfile)) {
                echo "File uploaded successfully.\n";
            } else {
                echo "Please upload a profile picture.\n";
            }
            $firstName = mysqli_real_escape_string($conn, $firstName);
            $lastName = mysqli_real_escape_string($conn, $lastName);
            $password = mysqli_real_escape_string($conn, $password);
            $phoneNo = mysqli_real_escape_string($conn, $phoneNo);
            $email = mysqli_real_escape_string($conn, $email);
            $userType = mysqli_real_escape_string($conn, $userType);
            $query = "INSERT INTO tbl_users (firstName, lastName, password, phoneNo, email, role, image) VALUES ('$firstName', '$lastName', '$password', '$phoneNo', '$email', '$userType', '$upfile')";
            $query2 = "SELECT COUNT(*) FROM tbl_users WHERE email = '$email' OR phoneNo = '$phoneNo'";
            $result2 = mysqli_query($conn, $query2);
            $row = mysqli_fetch_row($result2);
            $count = $row[0];
            if ($count > 0) {
                echo 'Email or phoneNo already exists';
            } else {
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo 'User created successfully';
                } else {
                    echo 'Error: User not created';
                }
            }
        }
    }
}
?>
<?php
include('footer.php');
?>