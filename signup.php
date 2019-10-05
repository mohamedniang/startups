<div class="container page justify-content-center">
    <h1 class="titre-section">Inscription</h1>
    <form action="signup.func.php" method="POST" class="col-lg-4">
        <div class="form-group">
            <label for="nomuser">Nom d'Utilisateur</label>
            <input required class="form-control" type="text" name="nomuser" id="nomuser" value="<?= isset($_GET['nomuser']) ? $_GET['nomuser'] : '' ?>">
            <label for="email">Email</label>
            <input required class="form-control" type="email" name="email" id="email" value="<?= isset($_GET['email']) ? $_GET['email'] : '' ?>">
            <label for="mdp">mot de passe</label>
            <input required class="form-control" type="password" name="mdp" id="mdp" value="<?= isset($_GET['mdp']) ? $_GET['mdp'] : '' ?>">
            <label for="mdp_r">confirmer le mot de passe</label>
            <input required class="form-control" type="password" name="mdp_r" id="mdp_r" value="">
        </div>
        <input type="submit" class="btn btn-primary" name="inscr" value="S'inscrire">
    </form>
    <?php
    if (isset($_GET['er'])) {
        if ($_GET['er'] == 'pwdnotmatch') {
            ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Les mot de passe ne correspondent pas !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        } else if ($_GET['er'] == 'usralreadyexist') {
            ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Cette utilisateurs existe déja !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        }
    }
    ?>
</div>