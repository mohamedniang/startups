<?php
// require 'conx.php';
$regions = file_get_contents('regions.json');
$regions = json_decode($regions, true);
?>
<div class="container page justify-content-center">
    <h1 class="titre-section d-flex justify-content-between">Identification de votre startup <i class="fa fa-plus-circle align-self-center"></i></h1>
    <form action="ajoutstartups.php" method="post" class="mx-auto" id="addForm">
        <div class="progress mb-3 mt-3 mx-auto" style="width: 50%">
            <div id="stepBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="tab-content" id="identTabContent">
            <div class="tab-pane fade show active" id="infoSimple" role="tabpanel" aria-labelledby="infoSimple">
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-1 pt-0">Type:</legend>
                        <div class="custom-control d-flex">
                            <div class="custom-control custom-radio mr-5">
                                <input class="custom-control-input" type="radio" id="startup" name="type" value="startup" checked>
                                <label class="custom-control-label" for="startup">STARTUP</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="pme" name="type" value="pme/pmi">
                                <label class="custom-control-label" for="pme">PME / PMI</label>
                            </div>
                        </div>
                </fieldset>
                <div class="form-group">
                    <label for="denomination">Dénomination : </label><input required type="text" class="form-control" name="denomination" id="denomination" placeholder="ex : Simplify Stack">
                    <label for="adresse">Adresse : </label><input required type="text" class="form-control" name="adresse" id="adresse" placeholder="ex : 1221,Niarry Tally">
                    <label for="email">Email : </label><input type="email" class="form-control" name="email" id="email" placeholder="ex : contact@gmail.com">
                    <label for="tel">Téléphone : </label><input pattern="(33|77|78|70|76)\d{7}" type="tel" class="form-control" name="tel" id="tel" placeholder="ex : 771234567" <label for="siteweb">Site Web : </label><input type="text" pattern="(www\.)(\w){0,}(-|.)?(\w){1,}(\.)([a-z]){2,}" class="form-control" name="siteweb" id="siteweb" placeholder="www.contact.sn">
                </div>
            </div>
            <div class="tab-pane fade" id="juridiction" role="tabpanel" aria-labelledby="juridiction">
                <div class="form-group">
                    <label for="statut_juridique">Statut Juridique : </label>
                    <select name="statut_juridique" id="statut_juridique" class="form-control">
                        <option value="default" disabled selected>Selectionnez votre statut juridique</option>
                        <option value="gie">GIE</option>
                        <option value="sarl">SARL</option>
                        <option value="suarl">SUARL</option>
                        <option value="sa">SA</option>
                        <option value="Entreprise individuelle">Entreprise Individuelle</option>
                    </select>
                    <label for="date_creation">Date De Création: </label><input class="form-control" type="date" name="date_creation" id="date_creation">
                    <label for="region">Région : </label>
                    <select class="form-control" name="region" id="region">
                        <option value="default" disabled selected>selectionnez votre région</option>
                        <?php
                        foreach ($regions['regions'] as $r) {
                            ?>
                            <option value="<?= strtolower($r) ?>"><?= $r ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="tab-pane fade" id="infoAvance" role="tabpanel" aria-labelledby="infoAvance">
                <form-group>
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Notre startup aide les gens a mieux comprendre ..."></textarea>
                    <div class="mt-2">
                        <span class="">Secteur(s) d'Activité(s)</span>
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="software" id="software" class="align-self-center mr-2 custom-control-input">
                                    <label for="software" class="mb-0 align-self-baseline custom-control-label">SOFTWARE</label>
                                </div>
                                <div id="sfShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf1" id="sf1" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sf1">Développement logiciel métier</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf2" id="sf2" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sf2">Base de données</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf3" id="sf3" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sf3">Applications web</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sf4" id="sf4" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sf4">Applications mobile</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="hardware" id="hardware" class="align-self-center mr-2 custom-control-input">
                                    <label for="hardware" class="mb-0 align-self-baseline custom-control-label">HARDWARE</label>
                                </div>
                                <div id="hdShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd1" id="hd1" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="hd1">Composants électroniques et assemblage</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd2" id="hd2" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="hd2">Ordinateurs et équipements informatiques</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="hd3" id="hd3" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="hd3">Terminaux mobiles et accessoires</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ict_network" id="ict_network" class="align-self-center mr-2 custom-control-input">
                                    <label for="ict_network" class="mb-0 align-self-baseline custom-control-label">ICT NETWORK</label>
                                </div>
                                <div id="ntShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="nt1" id="nt1" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="nt1">Télécoms</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="nt2" id="nt2" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="nt2">Services réseaux</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="nt3" id="nt3" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="nt3">Hosting, cloud</label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ict_service" id="ict_service" class="align-self-center mr-2 custom-control-input">
                                    <label for="ict_service" class="mb-0 align-self-baseline custom-control-label">ICT SERVICE</label>
                                </div>
                                <div id="scShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc1" id="sc1" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sc1">Sécurité, monitoring</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc2" id="sc2" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sc2">E-Payement, Fintech</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc3" id="sc3" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sc3">E-commerce</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc4" id="sc4" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sc4">E-santé</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc5" id="sc5" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sc5">E-agriculture</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sc6" id="sc6" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="sc6">E-éducation</label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ict_advance" id="ict_advance" class="align-self-center mr-2 custom-control-input">
                                    <label for="ict_advance" class="mb-0 align-self-baseline custom-control-label">ICT ADVANCE</label>
                                </div>
                                <div id="adShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad1" id="ad1" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad1">IIoT (internet des objets industrielles)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad2" id="ad2" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad2">Intelligence Artificielle (IA)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad5" id="ad5" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad5">Big Data</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad7" id="ad7" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad7">AR/VR (réalités augmentées/réalités virtuelles)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad8" id="ad8" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad8">Animation 3D</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad9" id="ad9" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad9">IoT (internet des objets)</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ad10" id="ad10" class="align-self-center mr-1 custom-control-input">
                                                <label class="custom-control-label" for="ad10">Drone, robotique</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="secteur">Autre Secteur d'Activité</label>
                    <textarea class="form-control" name="secteur" id="secteur" placeholder="On fait du ... et du ..."></textarea>
                    <div class="form-group">
                        <label for="proprio">Propriétaire</label>
                        <div class="form-inline form-group d-flex justify-content-around" id="proprio">
                            <!-- <label class="col-1" for="prenom">Prénom</label> -->
                            <input type="text" class="form-control flex-fill mr-2" required placeholder="Prénom" name="prenom" id="prenom">
                            <!-- <label class="col-1" for="nom">Nom</label> -->
                            <input type="text" class="form-control flex-fill" required placeholder="Nom" name="nom" id="nom">
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <label for="efft">Effectif</label><input type="number" class="form-control" name="efft" id="efft" placeholder="3">
                        </div>
                    </div>
                </form-group>
            </div>
            <div class="tab-pane fade justify-content-center" id="final" role="tabpanel" aria-labelledby="final">
                <div class="form-group d-flex flex-column justify-content-center align-items-center">
                    <h6 class="flex-fill">Vous avez completez le formulaire</h6>
                    <p>Vous avez la possibilité de <em><u>retourner</u></em> en arrière si vous voulez changer une ou plusieurs <em><u>informations</u></em> saisies</p>
                    <p>Si cela n'est pas le cas , il ne vous reste qu'a ajouter votre <em><u>startup</u></em></p>
                    <input type="submit" value="Envoyer" class="btn btn-primary pr-5 pl-5">
                </div>
            </div>
        </div>
        <ul class="nav nav-pills justify-content-center" id="identTab" role="tablist">
            <!-- <li class="nav-item">
                <a class="nav-link active" id="infoSimple" data-toggle="tab" href="#infoSimple" role="tab" aria-controls="infoSimple" aria-selected="true">Information Personnel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="juridiction" data-toggle="tab" href="#juridiction" role="tab" aria-controls="juridiction" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="infoAvance" data-toggle="tab" href="#infoAvance" role="tab" aria-controls="infoAvance" aria-selected="false">Contact</a>
            </li> -->
            <li class="nav-item mr-2"><a href="#" class="nav-link btn btn-outline-primary pl-5 pr-5" id="prev" data-toggle="tab" role="tab" aria-controls="" aria-selected="">Précédent</a></li>
            <li class="nav-item"><a href="#" class="nav-link btn btn-outline-primary pl-5 pr-5" id="next" data-toggle="tab" role="tab" aria-controls="" aria-selected="">Suivant</a></li>
        </ul>
    </form>
</div>