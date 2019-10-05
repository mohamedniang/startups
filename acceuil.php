<?php
require_once 'conx.php';
$quest = 'SELECT * FROM listestartups ORDER BY date_creation DESC LIMIT 5';
$res = $bdd->query($quest);
?>
<div class="container-fluid page pl-0 pr-0 ml-0 mr-0">
    <!-- <div class="banner mb-5">
        <span class="titre">Bienvenue sur Sénegal numerique startup</span>
    </div> -->
    <div class="banner">
        <div id="carouselAcceuil" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselAcceuil" data-slide-to="0" class="active"></li>
                <li data-target="#carouselAcceuil" data-slide-to="1"></li>
                <li data-target="#carouselAcceuil" data-slide-to="2"></li>
                <li data-target="#carouselAcceuil" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images\slider-01_crop.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h2>Bienvenue sur Sénégal Numerique StartUp</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images\slider-02_crop.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h2>Toutes les startups et pme du numérique aux Sénégal sont recenser ici.</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images\slider-03_crop.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h2>Inscrivez votre entreprise gratuitement</h2>
                        <p>Remplissez le formulaire</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images\slider-04_crop.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h2>Inscrivez votre entreprise et bénéficier d'une reconnaissance étatique</h2>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselAcceuil" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselAcceuil" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row mb-1 mt-1 mr-0 ml-0 align-items-center bg-white">
            <blockquote class=" blockquote col-9 d-flex flex-column pr-2">
                <p>Le numerique pour tous et pour tous les usagers avec un secteur privé dynamique et innovant dans un ecosystème performant</p>
                <footer class="blockquote-footer align-self-end">Sénégal Numerique 2025</footer>
            </blockquote>

            <figure class="figure col pr-0 pl-0 mb-0">
                <img src="images\ministre.png" alt="minitre" class="figure-img img-fluid rounded">
                <figcaption class="figure-caption text-center">Mme la ministre <br> Ndeye Tické Ndiaye Diop</figcaption>
            </figure>
            <!-- <div class="col-3 pr-0 pl-0">
                <img src="images\ministre.png" alt="minitre" class="img-fluid">
            </div> -->
        </div>
        <h2 class="titre-section d-flex justify-content-between">Startups les plus recentes <i class="fa fa-rocket align-self-center"></i></h2>
        <div class="row justify-content-around p-0 m-0">
            <?php
            while ($a = $res->fetch_array()) {
                ?>
                <div class="card col-lg col-sm mr-1 mb-3 shadow">
                    <img src="./images/rocket_startup.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h6 class="card-title"><?= $a['denomination'] ?></h4>
                            <span class="card-text"><?= $a['adresse'] ?></span><br>
                            <span class="text-muted">Crée le: <?= $a['date_creation'] ?></span>
                    </div>
                    <div class="card-footer d-flex">
                        <a href="index.php?page=detail&id=<?= $a['id'] ?>" class="btn btn-primary flex-fill">Voir</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <h2 class="titre-section d-flex justify-content-between">Identification de votre startup <i class="fa fa-pencil-alt align-self-center"></i></h2>
        <div class="container redir">
            <div class="inscr">
                <span><i class=" fa fa-user-check fa-5x"></i></span>
                <span class="descrip">Toujours pas de compte ?</span>
                <span class="titre">Inscrivez vous</span>
            </div>
            <div class="conx">
                <span><i class=" fa fa-user-circle fa-6x"></i></span>
                <span class="descrip">Ajoutez votre startup ?</span>
                <span class="titre">Connectez vous</span>
            </div>
        </div>
        <h2 class="titre-section d-flex justify-content-between">Actualités <i class="fa fa-newspaper align-self-center"></i></h2>
        <div class="container justify-items-center">
            <small class="text-muted ">Pas d'actualité pour le moment</small>
        </div>
    </div>
</div>