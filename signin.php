<?php
// require 'signin.func.php';
?>
<div class="container page">
    <h1 class="titre-section">Connexion</h1>
    <div class="row justify-content-center">
        <form action="signin.func.php" class="form col-lg-5 align-content-center" method="POST">
            <div class="form-group">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input class="form-control form-control-lg mb-1 <?= (isset($_GET['er'])) ? "border border-danger" : "" ?>" name="email" type="email" required placeholder="Adresse email" value="<?= isset($_GET['mail']) ? $_GET['mail'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input class="form-control form-control-lg mb-1 <?= (isset($_GET['er'])) ? "border border-danger" : "" ?>" name="mdp" type="password" required placeholder="Mot De Passe">
                </div>
                <button type="submit" name="connect" class="btn btn-primary btn-lg col  ">Se Connecter</button>
            </div>
        </form>
        <!-- <div class="col">
            <img src="images/login.gif" alt="logingif" id="logingif" class="img-fluid">
        </div>
        <hr> -->
        <?php
        if (isset($_GET['er'])) {
            ?>
            <div class="toast" id="signinError" style="position: absolute; top: 20px; right: 20px; z-index: 1000;" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    <small>Une erreur est survenue lors de votre connection:</small>
                    <em style="color: red"><?= implode(" ", explode(".", $_GET['er'])) ?></em>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>