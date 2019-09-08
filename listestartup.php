<?php
require 'conx.php';

if (isset($_POST['dc'])) {
    $res = $bdd->query('SELECT denomination, adresse, id, description FROM listestartups ORDER BY date_creation DESC');
} else if (isset($_POST['nt'])) {
    $res = $bdd->query('SELECT denomination, adresse, id, description FROM listestartups WHERE ict_network = 1 ORDER BY date_creation DESC');
} else if (isset($_POST['sc'])) {
    $res = $bdd->query('SELECT denomination, adresse, id, description FROM listestartups WHERE ict_service = 1 ORDER BY date_creation DESC');
} else if (isset($_POST['ad'])) {
    $res = $bdd->query('SELECT denomination, adresse, id, description FROM listestartups WHERE ict_advance = 1 ORDER BY date_creation DESC');
} else if (isset($_POST['rg'])) {
    $res = $bdd->query('SELECT denomination, adresse, id, description FROM listestartups ORDER BY adresse DESC');
} else {
    $res = $bdd->query('SELECT denomination, adresse, id, description FROM listestartups');
}

if (isset($_POST['rech']) and !empty($_POST['rech'])) {
    $rech = preg_replace("#[^0-9a-z]#i", "", $_POST['rech']);
    // $rech = $_POST['rech'];
    // $quest = "SELECT * FROM listestartups WHERE CONCAT('type', 'statut_juridique', 'denomination', 'date_creation', 'adresse', 'effectif', 'telephone_un', 'email', 'site_web', 'description', 'prenom', 'nom') LIKE '%".$rech."%'";
    $quest = "SELECT * FROM listestartups WHERE denomination LIKE '%" . $rech . "%'";
    $res_startup = $bdd->query($quest);
}
?>
<div class="container page">
    <h1 class="titre-section">Toutes les startups</h1>
    <div>
        <form action="index.php?page=listestartup" method="POST" class="form-inline">
            <div class="form-group d-flex flex-fill justify-content-center">
                <button type="submit" name="dc" class="btn btn-outline-info m-1 <?= isset($_POST['dc']) ? 'active' : '' ?>">Par Date De Creation<i class="fas fa-sort-down float-right"></i></button>
                <!-- <button type="submit" name="sc" class="btn btn-outline-secondary flex-fill m-1 <?= isset($_POST['sc']) ? 'active' : '' ?>">Par Secteur<i class="fas fa-sort-down float-right"></i></button> -->
                <div class="dropdown">
                    <button class="btn btn-outline-info dropdown-toggle align-self-stretch" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Par Secteur</button>
                    <div class="dropdown-menu dropdown-menu-left">
                        <input type="submit" class="dropdown-item <?= isset($_POST['nt']) ? 'active' : '' ?>" name="nt" value="ICT Network">
                        <input type="submit" class="dropdown-item <?= isset($_POST['sc']) ? 'active' : '' ?>" name="sc" value="ICT Services">
                        <input type="submit" class="dropdown-item <?= isset($_POST['ad']) ? 'active' : '' ?>" name="ad" value="ICT Advance">
                    </div>
                </div>
                <button type="submit" name="rg" class="btn btn-outline-info m-1 <?= isset($_POST['rg']) ? 'active' : '' ?>">Par Region<i class="fas fa-sort-down float-right"></i></button>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <?php
        if (isset($res_startup) and $_POST['rech'] != "") {
            while ($a = $res_startup->fetch_array()) {
                ?>
                <div class="card col-2 mr-3 mb-3" style="width: 300px;">
                    <div class="card-header">
                        <h6 class="card-title text-capitalize"><?= $a['denomination'] ?></h6>
                        <span class="card-subtitle text-muted"><?= $a['adresse'] ?></span>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><small><?= utf8_encode(substr($a['description'], 0, 75)) ?> ...</small></p>
                    </div>
                    <div class="card-footer d-flex">
                        <a href="index.php?page=detail&id=<?= $a['id'] ?>" class="btn btn-info d-flex flex-fill justify-content-around align-items-center"><span>Voir plus</span><i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            <?php
                }
            } else {
                while ($a = $res->fetch_array()) {
                    ?>
                <div class="card col-2 mr-3 mb-3" style="width: 300px;">
                    <div class="card-header">
                        <h6 class="card-title text-capitalize"><?= $a['denomination'] ?></h6>
                        <span class="card-subtitle text-muted"><?= $a['adresse'] ?></span>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><small><?= substr($a['description'], 0, 75) ?> ...</small></p>
                    </div>
                    <div class="card-footer d-flex">
                        <a href="index.php?page=detail&id=<?= $a['id'] ?>" class="btn btn-info d-flex flex-fill justify-content-around align-items-center">
                        <span>Voir plus</span>
                        <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>