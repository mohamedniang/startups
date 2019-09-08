<?php
require_once 'conx.php';
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
// echo $editMode ? 'true' : 'false';
?>
<div class="container page">
    <div class="toast" id="updateToast" style="position: absolute; top: 20px; right: 20px; z-index: 1000;"  role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto"><i class="fa fa-check"></i> Modifications éffectuées</strong>
            <small>Il y'a 1 min</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body">
            Vos modifications ont étaient bien enregistrés .
        </div>
    </div>
    <?php
    if (isset($editMode)) {
        if ($editMode) {
            ?>
            <form action="modifstartups.php?id=<?= $elt['id'] ?>&ownerID=<?= $ownerID ?>" method="POST">
        <?php
            }
        }
        ?>
        <div class="row mb-5">
            <div class="col-3 logo-startup border border-dark">
                <!-- <span>logo</span> -->
            </div>
            <div class="col-6 align-content-center">
                <?php
                if (isset($editMode) and $editMode == true) {
                    // if ($editMode) {
                    ?>
                    <div class="form-group">
                        <input class="form-control flex-fill form-control-lg" required name="denomination" value="<?= $elt['denomination'] ?>">
                    </div>
                    <div class="form-group form-inline">
                        <label class="font-weight-bold mr-1">Type :</label>
                        <!-- <input class="form-control flex-fill" value="<?= $elt['type'] ?>"> -->
                        <div class="form-check">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" id="startup" name="type" value="startup" <?= ($elt['type'] == 'STARTUP' || $elt['type'] == '') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="startup">STARTUP</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" id="pme" name="type" value="pme/pmi" <?= $elt['type'] == 'PME/PMI' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="pme">PME / PMI</label>
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
                        <input class="form-control flex-fill" pattern="\w{2,}@\w{3,}(\.)\w{2,}" name="email" value="<?= $elt['email'] ?>">
                    </div>
                    <div class="form-group form-inline">
                        <label class="font-weight-bold mr-1">Site Web:</label>
                        <input class="form-control flex-fill" pattern="(www\.)(\w){0,}(-|.)?(\w){1,}(\.)([a-z]){2,}" name="siteweb" value="<?= $elt['site_web'] ?>">
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
        <hr>
        <div class="container-fluid">
            <?php
            if (isset($editMode) and $editMode == true) {
                // if ($editMode) {
                ?>
                <div class="form-group form-inline d-flex">
                    <span class="font-weight-bold mr-1">Description:</span>
                    <textarea class="form-control flex-fill" name="description"><?= $elt['description'] ?></textarea>
                </div>
                <div class="form-group form-inline d-flex">
                    <span class="font-weight-bold mr-1">Secteur D'Activité:</span>
                    <textarea class="form-control flex-fill" name="secteur"><?= $elt['secteur'] ?></textarea>
                </div>
                <div class="form-group form-inline d-flex">
                    <span class="font-weight-bold mr-1">Propriétaire:</span>
                    <input class="form-control flex-fill mr-2" name="prenom" value="<?= $elt['prenom'] ?>">
                    <input class="form-control flex-fill" name="nom" value="<?= $elt['nom'] ?>">
                </div>
                <div class="form-group form-inline d-flex">
                    <span class="font-weight-bold mr-1">Numero De Téléphone:</span>
                    <input class="form-control flex-fill" pattern="(33|77|78|70|76)\d{7}" name="tel" value="<?= $elt['telephone_un'] ?>">
                </div>
                <!-- <span class="font-weight-bold mr-1">Numero De Téléphone:</span> <span><?= $elt['telephone_deux'] ?></span><br> -->
                <div class="form-group form-inline d-flex">
                    <span class="font-weight-bold mr-1">Effectif:</span>
                    <input class="form-control flex-fill" type="number" name="efft" value="<?= $elt['effectif'] ?>">
                </div>
            <?php
                // }
            } else {
                ?>
                <span class="font-weight-bold">Description:</span> <span><?= $elt['description'] ?></span><br>
                <span class="font-weight-bold">Secteur D'Activité:</span> <span><?= $elt['secteur'] ?></span><br>
                <span class="font-weight-bold">Propriétaire:</span> <span class="text-uppercase"><?= $elt['prenom'] . " " . $elt['nom'] ?></span><br>
                <span class="font-weight-bold">Numero De Téléphone:</span> <span><?= $elt['telephone_un'] ?></span><br>
                <!-- <span class="font-weight-bold">Numero De Téléphone:</span> <span><?= $elt['telephone_deux'] ?></span><br> -->
                <span class="font-weight-bold">Effectif:</span> <span><?= $elt['effectif'] ?></span><br>
            <?php
            }
            ?>
            <p>
                <span class="font-weight-bold">Poster par:</span> <span><?= $ownerName ?? 'none' ?></span>
            </p>
        </div>
        <hr>
        <div class="container-fluid" hidden>
            <span class="font-weight-bold">Domaine Du Software:</span><span> <?= $elt['software'] ? 'OUI' : 'NON'; ?></span><br>
            <?php
            if ($elt['software']) {
                ?>
                <span class="font-weight-bold">Sous Domaine Software:</span> <span><?= $elt['sous_domaine_soft'] ?></span><br>
            <?php
            }
            ?>
            <span class="font-weight-bold">Domaine Du Hardware:</span><span> <?= $elt['hardware'] ? 'OUI' : 'NON'; ?></span><br>
            <?php
            if ($elt['hardware']) {
                ?>
                <span class="font-weight-bold">Sous Domaine Hardware:</span> <span><?= $elt['sous_domaine_hard'] ?></span><br>
            <?php
            }
            ?>
            <span class="font-weight-bold">Domaine ICT Network:</span><span> <?= $elt['ict_network'] ? 'OUI' : 'NON'; ?></span><br>
            <?php
            if ($elt['ict_network']) {
                ?>
                <span class="font-weight-bold">Sous Domaine ICT Network:</span> <span><?= $elt['sous_domaine_ict_network'] ?></span><br>
            <?php
            }
            ?>
            <span class="font-weight-bold">Domaine ICT Advance:</span><span> <?= $elt['ict_advance'] ? 'OUI' : 'NON'; ?></span><br>
            <?php
            if ($elt['ict_advance']) {
                ?>
                <span class="font-weight-bold">Sous Domaine ICT Advance:</span> <span><?= $elt['sous_domaine_ict_advance'] ?></span><br>
            <?php
            }
            ?>
            <span class="font-weight-bold">Domaine ICT Service:</span><span> <?= $elt['ict_service'] ? 'OUI' : 'NON'; ?></span><br>
            <?php
            if ($elt['ict_service']) {
                ?>
                <span class="font-weight-bold">Sous Domaine ICT Service:</span> <span><?= $elt['sous_domaine_ict_service'] ?></span><br>
            <?php
            }
            ?>
        </div>
        <div class="container">
            <div class="d-flex justify-content-center bd-highlight">
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
                                <button type="submit" id="save" class="btn btn-outline-primary flex-fill p-2 mr-2 flex-grow-2">Enregistrer</button>
                                <a href="index.php?page=detail&id=<?= $elt['id'] ?>" class="btn btn-danger p-2">Annuler</a>
                            <?php
                                        } else {
                                            ?>
                                <a href="index.php?page=detail&id=<?= $elt['id'] ?>&editor=1" class="btn btn-outline-primary flex-fill p-2 mr-2">Modifier</a>
                                <a href="supprstartups.php?id=<?= $elt['id'] ?>&editor=2" class="btn btn-outline-danger flex-fill p-2">Supprimer</a>
                            <?php
                                        }
                                    } else {
                                        ?>
                            <a href="index.php?page=detail&id=<?= $elt['id'] ?>&editor=1" class="btn btn-outline-primary flex-fill p-2 mr-2">Modifier</a>
                            <a href="supprstartups.php?id=<?= $elt['id'] ?>&editor=2" class="btn btn-outline-danger flex-fill p-2">Supprimer</a>
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