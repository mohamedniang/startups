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
                        <div class="col-auto row">
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="type" value="startup" checked>
                                    </div>
                                </div>
                                <input type="text" name="startupLabel" id="startupLabel" disabled value="STARTUP" class="form-control">
                            </div>
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" value="pme" name="type">
                                    </div>
                                </div>
                                <input type="text" name="pmeLabel" id="pmeLabel" disabled value="PME / PMI" class="form-control">
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
                                <div class="input-group form-control align-content-center justify-content-center">
                                    <input type="checkbox" name="software" id="software" class="align-self-center mr-2">
                                    <label for="software" class="mb-0 align-self-baseline">SOFTWARE</label>
                                </div>
                                <div id="sfShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sf1" id="sf1" class="align-self-center mr-1">
                                            <label class="mb-0">Développement logiciel métier</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sf2" id="sf2" class="align-self-center mr-1">
                                            <label class="mb-0">Base de données</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sf3" id="sf3" class="align-self-center mr-1">
                                            <label class="mb-0">Applications web</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sf4" id="sf4" class="align-self-center mr-1">
                                            <label class="mb-0">Applications mobile</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="input-group form-control align-content-center justify-content-center">
                                    <input type="checkbox" name="hardware" id="hardware" class="align-self-center mr-2">
                                    <label for="hardware" class="mb-0 align-self-baseline">HARDWARE</label>
                                </div>
                                <div id="hdShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="hd1" id="hd1" class="align-self-center mr-1">
                                            <label class="mb-0">Composants électroniques et assemblage</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="hd2" id="hd2" class="align-self-center mr-1">
                                            <label class="mb-0">Ordinateurs et équipements informatiques</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="hd3" id="hd3" class="align-self-center mr-1">
                                            <label class="mb-0">Terminaux mobiles et accessoires</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="input-group form-control align-content-center justify-content-center">
                                    <input type="checkbox" name="ict_network" id="ict_network" class="align-self-center mr-2">
                                    <label for="ict_network" class="mb-0 align-self-baseline">ICT NETWORK</label>
                                </div>
                                <div id="ntShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="nt1" id="nt1" class="align-self-center mr-1">
                                            <label class="mb-0">Télécoms</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="nt2" id="nt2" class="align-self-center mr-1">
                                            <label class="mb-0">Services réseaux</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="nt3" id="nt3" class="align-self-center mr-1">
                                            <label class="mb-0">Hosting, cloud</label>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="input-group form-control align-content-center justify-content-center">
                                    <input type="checkbox" name="ict_service" id="ict_service" class="align-self-center mr-2">
                                    <label for="ict_service" class="mb-0 align-self-baseline">ICT SERVICE</label>
                                </div>
                                <div id="scShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sc1" id="sc1" class="align-self-center mr-1">
                                            <label class="mb-0">Sécurité, monitoring</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sc2" id="sc2" class="align-self-center mr-1">
                                            <label class="mb-0">E-Payement, Fintech</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sc3" id="sc3" class="align-self-center mr-1">
                                            <label class="mb-0">E-commerce</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sc4" id="sc4" class="align-self-center mr-1">
                                            <label class="mb-0">E-santé</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sc5" id="sc5" class="align-self-center mr-1">
                                            <label class="mb-0">E-agriculture</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="sc6" id="sc6" class="align-self-center mr-1">
                                            <label class="mb-0">E-éducation</label>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="input-group form-control align-content-center justify-content-center">
                                    <input type="checkbox" name="ict_advance" id="ict_advance" class="align-self-center mr-2">
                                    <label for="ict_advance" class="mb-0 align-self-baseline">ICT ADVANCE</label>
                                </div>
                                <div id="adShow">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad1" id="ad1" class="align-self-center mr-1">
                                            <label class="mb-0">IIoT (internet des objets industrielles)</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad2" id="ad2" class="align-self-center mr-1">
                                            <label class="mb-0">Intelligence Artificielle (IA)</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad5" id="ad5" class="align-self-center mr-1">
                                            <label class="mb-0">Big Data</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad7" id="ad7" class="align-self-center mr-1">
                                            <label class="mb-0">AR/VR (réalités augmentées/réalités virtuelles)</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad8" id="ad8" class="align-self-center mr-1">
                                            <label class="mb-0">Animation 3D</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad9" id="ad9" class="align-self-center mr-1">
                                            <label class="mb-0">IoT (internet des objets)</label>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-start p-1">
                                            <input type="checkbox" name="ad10" id="ad10" class="align-self-center mr-1">
                                            <label class="mb-0">Drone, robotique</label>
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