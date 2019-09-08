<?php
require 'conx.php';
if (isset($_POST['inscr'])) {
    $nomuser = $_POST['nomuser'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdp_r = $_POST['mdp_r'];
    // print_r($mdp_r);
    if ($mdp !== $mdp_r) {
        header('Location: index.php?page=signup&er=pwdnotmatch&nomuser=' . $nomuser);
        exit();
    } else if (!empty($email)) {
        $quest2 = 'SELECT usermail FROM utilisateurs WHERE usermail = ?';
        $res2 = $bdd->prepare($quest2);
        $res2->bind_param('s', $email);
        if (!$res2->execute()) {
            // print_r($res2->get_result()->num_rows);
            die('error from database');
        } else {
            if ($res2->get_result()->num_rows != 0) {
                header('Location: index.php?page=signup&er=usralreadyexist');
                exit();
            } else if ($res2->get_result()->num_rows == 0) {
                $res2->close();
                $questuser = 'INSERT INTO utilisateurs (username, usermail, userpwd) VALUES (?, ?, ?)';
                $resuser = $bdd->prepare($questuser);
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                $resuser->bind_param('sss', $nomuser, $email, $mdp);
                if ($resuser->execute()) {
                    $resuser->close();
                    header('Location: index.php?page=acceuil');
                } else {
                    die('error database ');
                }
            } else {
                header('Location: index.php?page=signup&er=toomucherror');
                exit();
                
            }
            $res2->close();
        }
    } else {
        header('Location: index.php?page=signup&er=noemail');
    }
}
?>
<div class="container page justify-content-center">
    <h1>Inscription :</h1>
    <form action="#" method="POST">
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