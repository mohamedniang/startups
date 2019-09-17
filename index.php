<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($_GET['page']) ? strtoupper($_GET['page']) : "HOME" ?></title>
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome\css\all.css">

    <!-- <link rel="stylesheet" href="css\animate.min.css">
    <link rel="stylesheet" href="css\bootstrap-dropdownhover.min.css"> -->

    <link rel="stylesheet" href="css/master.css">
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

    <!-- All toast and modals -->

    <?php if (isset($_GET['sc']) && $_GET['sc'] == "added") : ?>
        <div class="toast" id="updateToast" style="position: absolute; top: 20px; right: 20px; z-index: 1000;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto"><i class="fa fa-check-circle"></i> Modifications éffectuées</strong>
                <small>Il y'a 1 min</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                Vos modifications ont étaient bien enregistrés .
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['er'])) : ?>
        <div class="toast" id="updateErrorToast" style="position: absolute; top: 20px; right: 20px; z-index: 1000;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                Error <span style="color: red;"><?= implode(" ", explode(".", $_GET['er'])) ?>.</span>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- a confirmation modal -->
    <div class="modal fade" id="inscrConf" tabindex="-1" role="dialog" aria-labelledby="inscrConfTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inscrConfTitle">Inscription complete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Bravo ! vôtre startup est maintenant inscrite</span> <br />
                    <span>Bonne Continuation.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Rester ici</button>
                    <a href="index.php?page=signin" class="btn btn-primary">Se Connecter</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end of the modal -->
    <!-- a confirmation toast -->
    <?php if(isset($_GET['sc']) && $_GET['sc'] == "signin.successfully") : ?>
    <div class="toast" id="addToast" style="position: absolute; top: 20px; right: 20px; z-index: 1000;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto"><i class="fa fa-check-circle"></i>Startup Ajouté</strong>
            <small>Il y'a 30 sec</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body">
            Votre startup a bien été ajouté.
        </div>
    </div>
    <?php endif; ?>
    <!-- end of toast -->
</body>
<script src="js\jquery-3.4.1.js"></script>
<script src="js\popper.min.js"></script>

<script src="bootstrap-4.3.1-dist\js\bootstrap.min.js"></script>
<!-- <script src="js\bootstrap-dropdownhover.min.js"></script> -->

<script src="fontawesomepro\js\all.js"></script>

<script src="js\main.js"></script>
<script src="js\activeFunction.js"></script>
<script src="js\form-tabs.js"></script>
<script src="js\jquery.validate.js"></script>
<script src="js\updateCheck.js"></script>

</html>