<?php
require 'conx.php';
// print_r($_POST);
// echo '<hr/>';
// print_r("1 ");
if (isset($_POST['connect'])) {
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
            header('Location: index.php?page=signin&er=user.error');
            $rescont->close();
        } else {
            // print_r("5 ");
            if ($row = $result->fetch_assoc()) {
                // print_r("6 ");
                $pwdCheck = password_verify($_POST['mdp'], $row['userpwd']);
                if ($pwdCheck) {
                    // print_r("7 ");
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
    <h1>Connection</h1>
    <div class="row">
        <form action="#" class="form col-4" method="POST">
            <div class="form-group">
                <input class="form-control form-control-lg mb-1" name="email" type="email" required placeholder="Adresse email" value="<?= isset($_GET['mail']) ? $_GET['mail'] : '' ?>">
                <input class="form-control form-control-lg mb-1" name="mdp" type="password" required placeholder="Mot De Passe">
                <button type="submit" name="connect" class="btn btn-primary btn-lg col  ">Se Connecter</button>
            </div>
        </form>
        <hr>
        <?php
        if (isset($_GET['er'])) {
            ?>
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ERROR: <?= $_GET['er'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>