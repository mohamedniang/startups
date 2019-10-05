<?php
session_start();
require 'conx.php';
require 'addEditShare.php';

if (isset($_POST) and !empty($_POST)) {
    // $denomination = htmlspecialchars($_POST['denomination']);
    if ($req = $bdd->prepare('INSERT INTO listestartups (
        type,
        statut_juridique,
        denomination,
        date_creation,
        telephone_un,
        email,
        site_web,
        adresse,
        description,
        secteur,
        prenom,
        nom,
        effectif,
        software,
        hardware,
        ict_network,
        ict_service,
        ict_advance,
        sous_domaine_soft,
        sous_domaine_hard,
        sous_domaine_ict_network,
        sous_domaine_ict_service,
        sous_domaine_ict_advance,
        ownerID
    ) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')) {

        $type = htmlspecialchars($_POST['type']) == "startup" ? "STARTUP" : "PME/PMI";
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
        $efft = htmlspecialchars($_POST['efft']);
        $software = isset($_POST['software']) ? 1 : 0;
        $hardware = isset($_POST['hardware']) ? 1 : 0;
        $ict_network = isset($_POST['ict_network']) ? 1 : 0;
        $ict_service = isset($_POST['ict_service']) ? 1 : 0;
        $ict_advance = isset($_POST['ict_advance']) ? 1 : 0;

        $req->bind_param(
            "ssssssssssssiiiiiisssssi",
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
            $software,
            $hardware,
            $ict_network,
            $ict_service,
            $ict_advance,
            $sfFinal,
            $hdFinal,
            $ntFinal,
            $scFinal,
            $adFinal,
            $_SESSION['id']
        );
        $req->execute();
        echo "Records added successfully.";
        header('Location: index.php?page=acceuil&sc=startup.added.successfully');
    } else {
        echo "ERROR: Could not be able to execute" . mysqli_error($bdd);
        // header('Location: index.php?page=acceuil');
    }
} else {
    die('no data received');
    // header('Location: index.php?page=acceuil');
}
