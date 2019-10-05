<?php
require 'conx.php';
if(!headers_sent()){
    foreach (headers_list() as $header) {
        header_remove($header);
    }
}
if (isset($_POST['connect'])) {
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_unset();
    } else {
        session_start();
    }
    $questcont = 'SELECT * FROM utilisateurs WHERE usermail=?';
    if ($rescont = $bdd->prepare($questcont)) {
        $rescont->bind_param('s', $_POST['email']);
        $rescont->execute();
        $result = $rescont->get_result();
        if ($result->num_rows == 0) {
            header('Location: index.php?page=signin&er=username.or.email.error');
            $rescont->close();
        } else {
            if ($row = $result->fetch_assoc()) {
                $pwdCheck = password_verify($_POST['mdp'], $row['userpwd']);
                if ($pwdCheck) {
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
            $rescont->close();
        }
    } else {
        die('database error');
    }
} else { }