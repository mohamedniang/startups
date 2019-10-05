<?php
$bdd = mysqli_connect('localhost', 'root', '', 'startups');
$bdd->set_charset("utf-8");
if ($bdd->connect_error || !$bdd) {
    die('erreur lors de la connection');
}
