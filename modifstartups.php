<?php

use function PHPSTORM_META\type;

require 'conx.php';
require 'addEditShare.php';

if (isset($_POST) and !empty($_POST)) {
    if ($req = $bdd->prepare('UPDATE listestartups
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
                                effectif = ?,
                                software = ?,
                                hardware = ?,
                                ict_network = ?,
                                ict_service = ?,
                                ict_advance = ?,
                                sous_domaine_soft = ?,
                                sous_domaine_hard = ?,
                                sous_domaine_ict_network = ?,
                                sous_domaine_ict_service = ?,
                                sous_domaine_ict_advance = ?
                            WHERE id = ?')) {
        $type = strtoupper(htmlspecialchars($_POST['type']));
        $denomination = htmlspecialchars($_POST['denomination']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $siteweb = htmlspecialchars($_POST['siteweb']);
        $statut_juridique = strtoupper(strval(htmlspecialchars($_POST['statut_juridique'])));
        $date_creation = htmlspecialchars($_POST['date_creation']);
        // $region = htmlspecialchars($_POST['region']);
        $description = htmlspecialchars($_POST['description']);
        $secteur = htmlspecialchars($_POST['secteur']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $efft = $_POST['efft'];
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
            $_GET['id']
        );
        // for adding / changing startup image
        if (isset($_FILES['img-file'])) {
            $img = $_FILES['img-file'];
            $imgName = $img['name'];
            $imgSize = $img['size'];
            $imgTmpName = $img['tmp_name'];
            $imgType = $img['type'];
            $imgError = $img['error'];

            $imgExt = explode(".", $imgName);
            $imgExt = strtolower(end($imgExt));

            $allowedTypes = array("png", "jpg", "jpeg", "pdf", "pptx", "docx", "xls");
            if (!$imgError) {
                if (in_array($imgExt, $allowedTypes)) {
                    if ($imgSize < 5*1024*1024) {
                        // file name : [startup name]_[startup id]_[unique id].[file extension]
                        $imgNewName = $_GET['id'] . "_imagestartup." . $imgExt;
                        $imgDestination = "images/uploads/" . $imgNewName;
                        if (move_uploaded_file($imgTmpName, $imgDestination)) {
                            $uploadQuest = "UPDATE listestartups SET logo_img = '".$imgNewName."' WHERE id = ".$_GET['id'];
                            if ($uploadRes = $bdd->query($uploadQuest)) { } else {
                                echo "ERROR : on updating file name on the database <br/>";
                                echo mysqli_error($bdd);
                                header('Location: index.php?page=detail&er=could.not.update.file.name.on.database&id=' . $_GET['id']);
                            }
                        } else {
                            echo "this file couldn't be uploaded";
                            header('Location: index.php?page=detail&er=this.file.could.not.be.uploaded&id=' . $_GET['id']);
                        }
                    } else {
                        echo "this file size is way too big";
                        header('Location: index.php?page=detail&er=this.file.size.is.way.too.big&id=' . $_GET['id']);
                    }
                } else {
                    echo "this file type is not allowed";
                    header('Location: index.php?page=detail&er=this.file.type.is.not.allowed&id=' . $_GET['id']);
                }
            } else {
                echo "there was an error while loading image";
                header('Location: index.php?page=detail&er=there.was.an.error.while.loading.image&id=' . $_GET['id']);
            }
        } else {
            echo "IMPORTANT: no image change";
            header('Location: index.php?page=detail&er=IMPORTANT:.no.image.change&id=' . $_GET['id']);
        }

        if ($req->execute()) {
            echo "Records added successfully.";
            header('Location: index.php?page=detail&sc=added&id=' . $_GET['id']);
        } else {
            echo "ERROR: Could not be able to execute" . mysqli_error($bdd);
            // header('Location: index.php?page=acceuil');
        }
    } else {
        echo "ERROR: Couldn't prepare the query --> " . mysqli_error($bdd);
    }
} else {
    die('no data received');
    // header('Location: index.php?page=acceuil');
}
