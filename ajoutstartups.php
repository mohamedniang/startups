<?php
require 'conx.php';
if (isset($_POST) and !empty($_POST)) {
    // $denomination = htmlspecialchars($_POST['denomination']);
    if ($req = $bdd->prepare('INSERT INTO listestartups (type, statut_juridique, denomination, date_creation, telephone_un, email, site_web, adresse, description, secteur, prenom, nom, effectif) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)')) {

        $type = strtoupper(htmlspecialchars($_POST['type']));
        $denomination = htmlspecialchars($_POST['denomination']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $siteweb = htmlspecialchars($_POST['siteweb']);
        $statut_juridique = strtoupper(strval(htmlspecialchars($_POST['statut_juridique'])));
        $date_creation = htmlspecialchars($_POST['date_creation']);
        $region = htmlspecialchars($_POST['region']);
        $description = utf8_encode(htmlspecialchars($_POST['description']));
        $secteur = utf8_encode(htmlspecialchars($_POST['secteur']));
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $efft = htmlspecialchars($_POST['efft']);

        $req->bind_param(
            "ssssssssssssi",
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
            $efft
        );
        $req->execute();
        echo "Records added successfully.";
        header('Location: index.php?page=acceuil&sc=signin.successfully');
    } else {
        echo "ERROR: Could not be able to execute" . mysqli_error($bdd);
        // header('Location: index.php?page=acceuil');
    }
} else {
    die('no data received');
    // header('Location: index.php?page=acceuil');
}
