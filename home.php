<?php
session_start();
//if(!isset($_SESSION['session_username'])) {
//    header("location:login.php");
//    exit();
//}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="login.css" rel="stylesheet">
        <style>
            Body {
                background: url(https://assets.hongkiat.com/uploads/minimalist-dekstop-wallpapers/4k/original/10.jpg);
                background-size: cover;
            }
        </style>
    </head>
        <form class="form">
            <h1>Quiz 2</h1>
            <h3>Muhammad Afif Nurruddin | 192410102039</h3>
            <h2>Session = <?php print_r($_SESSION) ?></h2>
            <h2>Cookie = <?php print_r($_COOKIE) ?></h2>
            <a href="logout.php" type="Submit" class="btn btn-danger" name="logout" value="Logout">Logout</a>
        </form>
    </body>
</html>