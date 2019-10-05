<?php
require 'conx.php';
require 'listestartup.func.php';
// print_r("<br> POST = ");
// if(isset($_POST)) print_r($_POST);
// print_r("<br> GET = ");
// if(isset($_GET)) print_r($_GET);
// print_r("<br> SESSION = ");
// if(isset($_SESSION)) print_r($_SESSION);
?>
<div class="container page">
    <h1 class="titre-section d-flex justify-content-between">Toutes les entreprises <i class="fa fa-list align-self-center"></i></h1>
    <div>
        <form action="index.php?page=listestartup&p=1" method="POST" class="form-inline">
            <div class="form-group d-flex flex-fill justify-content-center">
                <button type="submit" name="dc" class="btn btn-outline-info m-1 p-0 <?= isset($_POST['dc']) ? 'active' : '' ?>">Par Date De Creation</button>
                <div class="dropdown">
                    <button class="btn btn-outline-info m-1 p-0 dropdown-toggle align-self-stretch <?= $secteurActive ? "active" : "" ?>" data-trigger="hover" data-toggle="dropdown" type="button" id="secteurDropdown">Par Secteur</button>
                    <div class="dropdown-menu dropdown-menu-left">
                        <input type="submit" class="dropdown-item <?= isset($_POST['sf']) ? 'active' : '' ?>" name="sf" value="Software">
                        <input type="submit" class="dropdown-item <?= isset($_POST['hd']) ? 'active' : '' ?>" name="hd" value="Hardware">
                        <input type="submit" class="dropdown-item <?= isset($_POST['nt']) ? 'active' : '' ?>" name="nt" value="ICT Network">
                        <input type="submit" class="dropdown-item <?= isset($_POST['sc']) ? 'active' : '' ?>" name="sc" value="ICT Services">
                        <input type="submit" class="dropdown-item <?= isset($_POST['ad']) ? 'active' : '' ?>" name="ad" value="ICT Advance">
                    </div>
                </div>
                <button type="submit" name="rg" class="btn btn-outline-info m-1 p-0 <?= isset($_POST['rg']) ? 'active' : '' ?>">Par Region</button>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <?php
        if (isset($res_startup) and $_POST['rech'] != "") {
            if ($res_startup->num_rows == 0) {
                ?>
                <span>Pas de resultat pour "<b><?= $rech ?></b>"</span>
                <?php
                    } else {
                        while ($a = $res_startup->fetch_array()) {
                            ?>
                    <div class="card col-2 mr-3 mb-3" style="width: 300px;">
                        <div class="card-header">
                            <h6 class="card-title text-capitalize"><?= $a['denomination'] ?></h6>
                            <span class="card-subtitle text-muted"><?= $a['adresse'] ?></span>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><small><?= substr($a['description'], 0, 75) ?> (...) </small></p>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <a class="page-link" href="index.php?page=detail&id=<?= $a['id'] ?>" class="btn btn-outline-primary d-flex flex-fill justify-content-around align-items-center"><span>Voir plus</span><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                <?php
                        }
                    }
                } else {
                    while ($a = $res->fetch_array()) {
                        ?>
                <div class="card col-lg-2 col-sm-10 col-md-5 mr-3 mb-3" style="width: 300px;">
                    <div class="card-header">
                        <h6 class="card-title text-capitalize"><?= $a['denomination'] ?></h6>
                        <span class="card-subtitle text-muted"><?= $a['adresse'] ?></span>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-center"><small><?= substr($a['description'], 0, 75) . " (...)" ?></small></p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a class="page-link" href="index.php?page=detail&id=<?= $a['id'] ?>" class="btn btn-outline-primary d-flex flex-fill justify-content-around align-items-center">
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
    <?php if (ceil($totalCount / $nombreMax) > 1) : ?>
        <ul class="pagination justify-content-center">
            <?php if ($p > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p - 1 ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
                </li>
            <?php endif; ?>

            <?php if ($p > 3) : ?>
                <li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=1">1</a></li>
                <li class="page-item disabled"><a href="#" class="page-link">...</a></li>
            <?php endif; ?>

            <?php if ($p - 2 > 0) : ?><li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p - 2 ?>"><?php echo $p - 2 ?></a></li><?php endif; ?>
            <?php if ($p - 1 > 0) : ?><li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p - 1 ?>"><?php echo $p - 1 ?></a></li><?php endif; ?>

            <li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p ?>"><?php echo $p ?></a></li>

            <?php if ($p + 1 < ceil($totalCount / $nombreMax) + 1) : ?><li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p + 1 ?>"><?php echo $p + 1 ?></a></li><?php endif; ?>
            <?php if ($p + 2 < ceil($totalCount / $nombreMax) + 1) : ?><li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p + 2 ?>"><?php echo $p + 2 ?></a></li><?php endif; ?>

            <?php if ($p < ceil($totalCount / $nombreMax) - 2) : ?>
                <li class="page-item disabled"><a href="#" class="page-link">...</a></li>
                <li class="page-item"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo ceil($totalCount / $nombreMax) ?>"><?php echo ceil($totalCount / $nombreMax) ?></a></li>
            <?php endif; ?>

            <?php if ($p < ceil($totalCount / $nombreMax)) : ?>
                <li class="next"><a class="page-link" href="index.php?page=listestartup&filter=<?= $filter ?>&p=<?php echo $p + 1 ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>