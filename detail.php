<?php
require_once 'conx.php';
require 'addEditShare.php';

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $quest = 'SELECT * FROM listestartups WHERE id = ' . $_GET['id'];
    $res = $bdd->query($quest);
    // while ($elt = $res->fetch_array()) {
    //     # code...
    // }
    if ($elt = $res->fetch_assoc()) {
        $questOwner = 'SELECT * FROM utilisateurs WHERE id=?';
        if ($resOwner = $bdd->prepare($questOwner)) {
            $resOwner->bind_param("i", $elt['ownerID']);
            $resOwner->execute();
            $allInfoOwner = $resOwner->get_result();
            // print_r($allInfoOwner->fetch_assoc());
            $allInfoOwner = $allInfoOwner->fetch_assoc();
            $ownerName = $allInfoOwner['username'];
            $ownerID = $allInfoOwner['id'];
        } else {
            print_r($resOwner->error_get_last());
        }
        $softwareSubDomain = explode("(|)", $elt['sous_domaine_soft']);
        $hardwareSubDomain = explode("(|)", $elt['sous_domaine_hard']);
        $ictServiceSubDomain = explode("(|)", $elt['sous_domaine_ict_service']);
        $ictNetworkSubDomain = explode("(|)", $elt['sous_domaine_ict_network']);
        $ictAdvanceSubDomain = explode("(|)", $elt['sous_domaine_ict_advance']);
        // print_r(array(
        //     $softwareSubDomain,
        //     $hardwareSubDomain,
        //     $ictServiceSubDomain,
        //     $ictNetworkSubDomain,
        //     $ictAdvanceSubDomain
        // ));
        $logo = $elt['logo_img'];
        $is_logo = $logo != "defaultLogo.jpg" ? true : false;
    } else {
        die('database error');
    }
    // for the edit mode 
    if (isset($_GET['editor']) and !empty($_GET['editor']) and $_GET['editor'] == 1) {

        if (isset($_SESSION['id'])) {
            $editMode = (($_GET['editor'] == 1) and ($ownerID == $_SESSION['id'])) ? true : false;
        }
    } else {
        $editMode = false;
    }
} else {
    die('l\'element demander n\'existe plus');
}
?>
<div class="container page">
    <h2 class="titre-section d-flex justify-content-between"><?= ($editMode) ? "Modifications" : "Détails" ?> <i class="fa <?= ($editMode) ? "fa-edit" : "fa-database" ?> align-self-center"></i></h2>
    <?php
    if (isset($editMode)) {
        if ($editMode) {
            ?>
            <form action="modifstartups.php?id=<?= $elt['id'] ?>&ownerID=<?= $ownerID ?>" method="POST" enctype="multipart/form-data">
        <?php
            }
        }
        ?>
        <div class="row mb-5">
            <div class="col-auto">
                <?php if ($is_logo) { ?>
                    <div class="logo-startup border border-dark d-flex flex-column align-items-around justify-content-center">
                        <img src="<?= "./images/uploads/" . $logo ?>" alt="<?= $logo ?>">
                    <?php } else { ?>
                        <div class="logo-startup-default border border-dark d-flex align-items-center justify-content-center">
                        <?php }; ?>
                        </div>
                        <?php if (isset($editMode) and $editMode == true) : ?>
                                <div class="form-group">
                                    <input type="file" class="form-control" id="img-file" name="img-file" >
                                    <!-- <label class="label" for="img-file">Choose file</label> -->
                                </div>
                        <?php endif; ?>
                    </div>
                    <div class="col align-content-center">
                        <?php
                        if (isset($editMode) and $editMode == true) {
                            // if ($editMode) {
                            ?>
                            <div class="form-group">
                                <input class="form-control flex-fill form-control-lg" name="denomination" value="<?= $elt['denomination'] ?>">
                            </div>
                            <div class="form-group form-inline">
                                <label class="font-weight-bold mr-1">Type :</label>
                                <!-- <input class="form-control flex-fill" value="<?= $elt['type'] ?>"> -->
                                <div class="custom-control d-flex">
                                    <div class="custom-control custom-radio mr-5">
                                        <input class="custom-control-input" type="radio" id="startup" name="type" value="startup" <?= ($elt['type'] == 'STARTUP' || $elt['type'] == '') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="startup">STARTUP</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="pme" name="type" value="pme/pmi" <?= $elt['type'] == 'PME/PMI' ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="pme">PME / PMI</label>
                                    </div>
                                </div>
                                <!-- <select name="type" id="type" class="form-control">
                    <option value="startup">STARTUP</option>
                    <option value="pme">PME/PMI</option>
                </select> -->
                            </div>
                            <div class="form-group form-inline">
                                <label class="font-weight-bold mr-1">Statut Juridique:</label>
                                <!-- <input class="form-control flex-fill" value="<?= $elt['statut_juridique'] ?>"> -->
                                <select name="statut_juridique" id="statut_juridique" class="form-control">
                                    <option value="gie" <?= ($elt['statut_juridique'] == 'GIE') ? 'selected' : '' ?>>GIE</option>
                                    <option value="sarl" <?= ($elt['statut_juridique'] == 'SARL') ? 'selected' : '' ?>>SARL</option>
                                    <option value="suarl" <?= ($elt['statut_juridique'] == 'SUARL') ? 'selected' : '' ?>>SUARL</option>
                                    <option value="sa" <?= ($elt['statut_juridique'] == 'SA') ? 'selected' : '' ?>>SA</option>
                                    <option value="entreprise individuelle" <?= ($elt['statut_juridique'] == 'ENTREPRISE INDIVIDUELLE') ? 'selected' : '' ?>>Entreprise Individuelle</option>
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="font-weight-bold mr-1">Date De Création:</label>
                                <!-- <input class="form-control flex-fill" value="<?= $elt['date_creation'] ?>"> -->
                                <input type="date" class="form-control" name="date_creation" id="date_creation" value="<?= $elt['date_creation'] ?>">
                            </div>
                            <div class="form-group form-inline">
                                <label class="font-weight-bold mr-1">Adresse:</label>
                                <input class="form-control flex-fill" name="adresse" value="<?= $elt['adresse'] ?>">
                            </div>
                            <div class="form-group form-inline">
                                <label class="font-weight-bold mr-1">Email:</label>
                                <input class="form-control flex-fill" pattern="((\w{2,})(.))?(\w{2,})@\w{3,}(\.)\w{2,}" name="email" value="<?= $elt['email'] ?>">
                            </div>
                            <div class="form-group form-inline">
                                <label class="font-weight-bold mr-1">Site Web:</label>
                                <input class="form-control flex-fill" pattern="(http(s)?(\:\/\/))?(www\.)(\w){0,}(-|.)?(\w){1,}(\.)([a-z]){2,}" name="siteweb" value="<?= $elt['site_web'] ?>">
                            </div>
                        <?php
                            // }
                        } else {
                            ?>
                            <h1 class="display-3"><?= $elt['denomination'] ?></h1>
                            <span class="font-weight-bold">Type:</span><span> <?= $elt['type'] ?></span><br>
                            <span class="font-weight-bold">Statut Juridique:</span><span> <?= $elt['statut_juridique'] ?></span><br>
                            <span class="font-weight-bold">Date De Création:</span><span> <?= $elt['date_creation'] ?></span><br>
                            <span class="font-weight-bold">Adresse:</span><span> <?= $elt['adresse'] ?></span><br>
                            <span class="font-weight-bold">Email:</span><a href="mailto:<?= $elt['email'] ?>"> <?= $elt['email'] ?></a><br>
                            <span class="font-weight-bold">Site Web:</span> <a target="_blank" href="http://<?= $elt['site_web'] ?>"><?= $elt['site_web'] ?></a><br>
                        <?php
                        }
                        ?>
                    </div>
            </div>
            <div class="container-fluid advanceDetails mb-4 <?= !$editMode ? "list-group list-group-flush" : "" ?>">
                <h2 class="sous-titre-section"><?= $editMode ? "Modifications Des Détails Avancées" : "Détails Avancées" ?></h2>
                <?php
                if (isset($editMode) and $editMode == true) {
                    // if ($editMode) {
                    ?>
                    <div class="form-group form-inline d-flex">
                        <span class="font-weight-bold mr-1">Description:</span>
                        <textarea class="form-control flex-fill" name="description"><?= $elt['description'] ?></textarea>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="software" id="softwareEdit" class="custom-control-input" <?= $elt['software'] ? "checked" : "" ?>>
                                    <label for="softwareEdit" class="mb-0 custom-control-label">SOFTWARE</label>
                                </div>
                                <div id="sfShow" class="bgWhite">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf1" id="sf1" class="custom-control-input" <?= in_array($sf1Text, $softwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sf1">Développement logiciel métier</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf2" id="sf2" class="custom-control-input" <?= in_array($sf2Text, $softwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sf2">Base de données</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf3" id="sf3" class="custom-control-input" <?= in_array($sf3Text, $softwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sf3">Applications web</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf4" id="sf4" class="custom-control-input" <?= in_array($sf4Text, $softwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sf4">Applications mobile</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="hardware" id="hardwareEdit" class="custom-control-input" <?= $elt['hardware'] ? "checked" : "" ?>>
                                    <label for="hardwareEdit" class="mb-0 custom-control-label">HARDWARE</label>
                                </div>
                                <div id="hdShow" class="bgWhite">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd1" id="hd1" class="custom-control-input" <?= in_array($hd1Text, $hardwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="hd1">Composants électroniques et assemblage</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd2" id="hd2" class="custom-control-input" <?= in_array($hd2Text, $hardwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="hd2">Ordinateurs et équipements informatiques</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd3" id="hd3" class="custom-control-input" <?= in_array($hd3Text, $hardwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="hd3">Terminaux mobiles et accessoires</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd4" id="hd4" class="custom-control-input" <?= in_array($hd4Text, $hardwareSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="hd4">Signalétique digitale</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ict_network" id="ict_networkEdit" class="custom-control-input" <?= $elt['ict_network'] ? "checked" : "" ?>>
                                    <label for="ict_networkEdit" class="mb-0 custom-control-label">ICT NETWORK</label>
                                </div>
                                <div id="ntShow" class="bgWhite">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="nt1" id="nt1" class="custom-control-input" <?= in_array($nt1Text, $ictNetworkSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="nt1">Télécoms</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="nt2" id="nt2" class="custom-control-input" <?= in_array($nt2Text, $ictNetworkSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="nt2">Services réseaux</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="nt3" id="nt3" class="custom-control-input" <?= in_array($nt3Text, $ictNetworkSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="nt3">Hosting, cloud</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ict_service" id="ict_serviceEdit" class="custom-control-input" <?= $elt['ict_service'] ? "checked" : "" ?>>
                                    <label for="ict_serviceEdit" class="mb-0 custom-control-label">ICT SERVICE</label>
                                </div>
                                <div id="scShow" class="bgWhite">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc1" id="sc1" class="custom-control-input" <?= in_array($sc1Text, $ictServiceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sc1">Sécurité, monitoring</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc2" id="sc2" class="custom-control-input" <?= in_array($sc2Text, $ictServiceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sc2">E-Payement, Fintech</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc3" id="sc3" class="custom-control-input" <?= in_array($sc3Text, $ictServiceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sc3">E-commerce</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc4" id="sc4" class="custom-control-input" <?= in_array($sc4Text, $ictServiceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sc4">E-santé</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc5" id="sc5" class="custom-control-input" <?= in_array($sc5Text, $ictServiceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sc5">E-agriculture</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc6" id="sc6" class="custom-control-input" <?= in_array($sc6Text, $ictServiceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="sc6">E-éducation</label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ict_advance" id="ict_advanceEdit" class="custom-control-input" <?= $elt['ict_advance'] ? "checked" : "" ?>>
                                    <label for="ict_advanceEdit" class="mb-0 custom-control-label">ICT ADVANCE</label>
                                </div>
                                <div id="adShow" class="bgWhite">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad1" id="ad1" class="custom-control-input" <?= in_array($ad1Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad1">IIoT (internet des objets industrielles)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad2" id="ad2" class="custom-control-input" <?= in_array($ad2Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad2">Intelligence Artificielle (IA)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad5" id="ad5" class="custom-control-input" <?= in_array($ad5Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad5">Big Data</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad7" id="ad7" class="custom-control-input" <?= in_array($ad7Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad7">AR/VR (réalités augmentées/réalités virtuelles)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad8" id="ad8" class="custom-control-input" <?= in_array($ad8Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad8">Animation 3D</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad9" id="ad9" class="custom-control-input" <?= in_array($ad9Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad9">IoT (internet des objets)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad10" id="ad10" class="custom-control-input" <?= in_array($ad10Text, $ictAdvanceSubDomain) ? "checked" : "" ?>>
                                                <label class="custom-control-label" for="ad10">Drone, robotique</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-inline d-flex">
                        <span class="font-weight-bold mr-1">Propriétaire:</span>
                        <input class="form-control flex-fill mr-2" name="prenom" value="<?= $elt['prenom'] ?>">
                        <input class="form-control flex-fill" name="nom" value="<?= $elt['nom'] ?>">
                    </div>
                    <div class="form-group form-inline d-flex">
                        <span class="font-weight-bold mr-1">Numero De Téléphone:</span>
                        <input class="form-control flex-fill" pattern="((+)?(221))?(33|77|78|70|76)\d{7}" name="tel" value="<?= $elt['telephone_un'] ?>">
                    </div>
                    <div class="form-group form-inline d-flex">
                        <span class="font-weight-bold mr-1">Effectif(s):</span>
                        <input class="form-control flex-fill" type="number" name="efft" value="<?= $elt['effectif'] ?>">
                    </div>
                    <div class="form-group form-inline d-flex">
                        <span class="font-weight-bold mr-1">Autre Secteur d'Activité:</span>
                        <textarea class="form-control flex-fill" name="secteur"><?= $elt['secteur'] ?></textarea>
                    </div>
                <?php
                } else {
                    ?>
                    <div class="list-group-item">
                        <span class="font-weight-bold">Description:</span> <span><?= $elt['description'] ?></span>
                    </div>
                    <div class="list-group-item secteurActivite">
                        <span class="font-weight-bold">Secteur(s) d'Activité(s):</span>
                        <div class="row">
                            <div class="col">
                                <span>
                                    <i class="fa fa-<?= $elt['software'] ? "check-circle\" style=\"color: #05a505;\"" : "times-circle\" style=\"color: #d80d0d;\"" ?> mr-0"></i>
                                    <span class="ml-0 pl-2">SOFTWARE</span>
                                </span>
                                <div class="list-group">
                                    <?php if ($elt['software']) : ?>
                                        <?php foreach (explode("(|)", $elt['sous_domaine_soft']) as $domaine) : ?>
                                            <span class="list-group-item"><?= $domaine ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col">
                                <span>
                                    <i class="fa fa-<?= $elt['hardware'] ? "check-circle\" style=\"color: #05a505;\"" : "times-circle\" style=\"color: #d80d0d;\"" ?>"></i>
                                    HARDWARE
                                </span>
                                <div class="list-group">
                                    <?php if ($elt['hardware']) : ?>
                                        <?php foreach (explode("(|)", $elt['sous_domaine_hard']) as $domaine) : ?>
                                            <span class="list-group-item"><?= $domaine ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col">
                                <span>
                                    <i class="fa fa-<?= $elt['ict_network'] ? "check-circle\" style=\"color: #05a505;\"" : "times-circle\" style=\"color: #d80d0d;\"" ?>"></i>
                                    ICT NETWORK
                                </span>
                                <div class="list-group">
                                    <?php if ($elt['ict_network']) : ?>
                                        <?php foreach (explode("(|)", $elt['sous_domaine_ict_network']) as $domaine) : ?>
                                            <span class="list-group-item"><?= $domaine ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col">
                                <span>
                                    <i class="fa fa-<?= $elt['ict_service'] ? "check-circle\" style=\"color: #05a505;\"" : "times-circle\" style=\"color: #d80d0d;\"" ?>"></i>
                                    ICT SERVICES
                                </span>
                                <div class="list-group">
                                    <?php if ($elt['ict_service']) : ?>
                                        <?php foreach (explode("(|)", $elt['sous_domaine_ict_service']) as $domaine) : ?>
                                            <span class="list-group-item"><?= $domaine ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col">
                                <span>
                                    <i class="fa fa-<?= $elt['ict_advance'] ? "check-circle\" style=\"color: #05a505;\"" : "times-circle\" style=\"color: #d80d0d;\"" ?>"></i>
                                    ADVANCE
                                </span>
                                <div class="list-group">
                                    <?php if ($elt['ict_advance']) : ?>
                                        <?php foreach (explode("(|)", $elt['sous_domaine_ict_advance']) as $domaine) : ?>
                                            <span class="list-group-item"><?= $domaine ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <span class="font-weight-bold">Propriétaire:</span> <span class="text-uppercase"><?= $elt['prenom'] . " " . $elt['nom'] ?></span>
                    </div>
                    <div class="list-group-item">
                        <span class="font-weight-bold">Numero De Téléphone:</span> <span><?= $elt['telephone_un'] ?></span>
                    </div>
                    <!-- <span class="font-weight-bold">Numero De Téléphone:</span> <span><?= $elt['telephone_deux'] ?></span> -->
                    <div class="list-group-item">
                        <span class="font-weight-bold">Effectif(s):</span> <span><?= $elt['effectif'] ?></span>
                    </div>
                    <div class="list-group-item">
                        <span class="font-weight-bold">Poster par:</span>
                        <span><?= $ownerName ?? 'none' ?></span>
                    </div>
                    <?php
                        if (!empty($elt['secteur'])) {
                            ?>
                        <div class="list-group-item">
                            <span class="font-weight-bold">Autre Secteur d'Activité:</span>
                            <span><?= $elt['secteur'] ?></span>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="container">
                <div class="d-flex justify-content-end bd-highlight">
                    <?php
                    if (!isset($_SESSION['username']) and !isset($_SESSION['usermail'])) {
                        ?>
                        <div>
                            <small class="text-muted">Connectez-vous pour avoir plus d'acces</small>
                        </div>
                        <?php
                        } else {
                            // if ($editMode) {
                            if ($_SESSION['id'] === $ownerID) {
                                if (isset($editMode)) {
                                    if ($editMode == true) {
                                        ?>
                                    <button type="submit" id="save" class="btn btn-outline-primary p-2 mr-2 flex-grow-2"><i class="fa fa-save"></i> Enregistrer</button>
                                    <a href="index.php?page=detail&id=<?= $elt['id'] ?>" class="btn btn-outline-danger p-2"><i class="fa fa-times"></i> Annuler</a>
                                <?php
                                            } else {
                                                ?>
                                    <a href="index.php?page=detail&id=<?= $elt['id'] ?>&editor=1" class="btn btn-outline-primary p-2 mr-2"><i class="fa fa-edit"></i> Modifier</a>
                                    <!-- <a href="supprstartups.php?id=<?= $elt['id'] ?>&editor=2" class="btn btn-outline-danger flex-fill p-2"><i class="fa fa-eraser"></i> Supprimer</a> -->
                                <?php
                                            }
                                        } else {
                                            ?>
                                <a href="index.php?page=detail&id=<?= $elt['id'] ?>&editor=1" class="btn btn-outline-primary p-2 mr-2"><i class="fa fa-edit"></i> Modifier</a>
                                <!-- <a href="supprstartups.php?id=<?= $elt['id'] ?>&editor=2" class="btn btn-outline-danger flex-fill p-2"><i class="fa fa-eraser"></i> Supprimer</a> -->
                            <?php
                                    }
                                } else {
                                    ?>
                            <div>
                                <small class="text-muted">Vous n'êtes pas le propiétaire de ce poste</small>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            if (isset($editMode)) {
                if ($editMode) {
                    ?>
            </form>
    <?php
        }
    }
    ?>
</div>