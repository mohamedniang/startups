<?php
session_start();
if (isset($_SESSION['username']) and isset($_SESSION['usermail'])) {
    // echo $_SESSION['username']." ss ".$_SESSION['usermail'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($_GET['page']) ? strtoupper($_GET['page']) : "HOME" ?></title>
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome\css\all.css">
    <link rel="stylesheet" href="master.css">
</head>

<body>
    <?php
    require_once "navigation.php";
    if (isset($_GET['page']) and !empty($_GET['page'])) {
        require $_GET['page'] . '.php';
    } else {
        require 'acceuil.php';
    }
    ?>
    <?php require_once 'footer.html'; ?>
</body>
<script src="js\jquery-3.4.1.js"></script>
<script src="js\popper.min.js"></script>
<script src="bootstrap-4.3.1-dist\js\bootstrap.js"></script>
<script src="fontawesome\js\all.js"></script>
<script src="js\main.js"></script>
<script src="js\activeFunction.js"></script>
<script src="js\form-tabs.js"></script>
<script src="js\jquery.validate.js"></script>
<script src="js\updateCheck.js"></script>
</html>