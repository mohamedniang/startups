<?php
require 'conx.php';
print_r(session_status());
// print_r($_POST);
// echo '<hr/>';
// print_r("1 ");
if (isset($_POST['connect'])) {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_unset();
        session_destroy();
    }
    // print_r("2 ");
    $questcont = 'SELECT * FROM utilisateurs WHERE usermail=?';
    if ($rescont = $bdd->prepare($questcont)) {
        // print_r("3 ");
        $rescont->bind_param('s', $_POST['email']);
        $rescont->execute();
        $result = $rescont->get_result();
        // print_r(" res = ".$result->num_rows." . ");
        if ($result->num_rows == 0) {
            // print_r("4 ");
            header('Location: index.php?page=signin&er=username.or.email.error');
            $rescont->close();
        } else {
            if ($row = $result->fetch_assoc()) {
                // print_r("6 ");
                $pwdCheck = password_verify($_POST['mdp'], $row['userpwd']);
                if ($pwdCheck) {
                    session_start();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['usermail'] = $row['usermail'];
                    $_SESSION['id'] = $row['id'];
                    header('Location: index.php?page=acceuil&sc=login.successfully');
                    exit();
                } else {
                    header('Location: index.php?page=signin&er=wrong.password&mail=' . $_POST['email']);
                    exit();
                }
            }

            print_r($row);
            $rescont->close();
        }
    } else {
        die('database error');
    }
} else {
    // die('error');
}
?>
<div class="container page">
    <h1 class="titre-section">Connection</h1>
    <div class="row">
        <form action="#" class="form col align-content-center" method="POST">
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
                <!-- <div class="toast-header">
                    <strong class="mr-auto"><i class="fa fa-book-dead"></i> Erreurs de Connection</strong>
                    <small>Il y'a 1 min</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div> -->
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