<footer>
    <?php
     if ((isset($_SESSION['name'])) && (isset($_SESSION['password']))) {
    ?>
    <a href="logout.php">Logout</a>
    <?php
     }
    ?>
</footer>
</body>

</html>