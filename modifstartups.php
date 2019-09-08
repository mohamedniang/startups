<?php
require 'conx.php';
// $editMode = false;
if (isset($_POST) and !empty($_POST)) {
    // print_r($editMode);
    // $denomination = htmlspecialchars($_POST['denomination']);
    $req = $bdd->prepare('UPDATE listestartups
                            SET type = ?,
                                statut_juridique = ?,
                                denomination = ?,
                                date_creation = ?,
                                telephone_un = ?,
                                email = ?,
                                site_web = ?,
                                adresse = ?,
                                description = ?,
                                secteur = ?,
                                prenom = ?,
                                nom = ?,
                                effectif = ?
                            WHERE id = ?');


    $type = strtoupper(htmlspecialchars($_POST['type']));
    $denomination = htmlspecialchars($_POST['denomination']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $siteweb = htmlspecialchars($_POST['siteweb']);
    $statut_juridique = strtoupper(strval(htmlspecialchars($_POST['statut_juridique'])));
    $date_creation = htmlspecialchars($_POST['date_creation']);
    $region = htmlspecialchars($_POST['region']);
    $description = htmlspecialchars($_POST['description']);
    $secteur = htmlspecialchars($_POST['secteur']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $efft = $_POST['efft'];

    $req->bind_param(
        "ssssssssssssii",
        $type,
        $statut_juridique,
        $denomination,
        $date_creation,
        $tel,
        $email,
        $siteweb,
        $adresse,
        $description,
        $secteur,
        $prenom,
        $nom,
        $efft,
        $_GET['id']
    );

    if ($req->execute()) {
        echo "Records added successfully.";
        header('Location: index.php?page=detail&sc=added&id='.$_GET['id']);
    } else {
        echo "ERROR: Could not be able to execute" . mysqli_error($bdd);
        // header('Location: index.php?page=acceuil');
    }
} else {
    die('no data received');
    // header('Location: index.php?page=acceuil');
}
