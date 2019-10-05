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
                    header('Location: index.php?page=acceuil&sc=sign.in.validated');
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