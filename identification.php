<?php
// require 'conx.php';
$regions = file_get_contents('regions.json');
$regions = json_decode($regions, true);
?>
<div class="container page justify-content-center">
    <h1 class="titre-section">Identification de votre startup</h1>
    <form action="ajoutstartups.php" method="post" class="mx-auto" id="addForm">

        <div class="tab-content" id="identTabContent">
            <div class="tab-pane fade show active" id="infoSimple" role="tabpanel" aria-labelledby="infoSimple">
                <div class="form-group">
                    <label for="denomination">Dénomination : </label><input required type="text" class="form-control" name="denomination" id="denomination" placeholder="ex : Simplify Stack">
                    <label for="adresse">Adresse : </label><input required type="text" class="form-control" name="adresse" id="adresse" placeholder="ex : 1221,Niarry Tally">
                    <label for="email">Email : </label><input type="email" class="form-control" name="email" id="email" placeholder="ex : contact@gmail.com">
                    <label for="tel">Téléphone : </label><input pattern="(33|77|78|70|76)\d{7}" type="tel" class="form-control" name="tel" id="tel" placeholder="ex : 771234567"
                    <label for="siteweb">Site Web : </label><input type="text" pattern="(www\.)(\w){0,}(-|.)?(\w){1,}(\.)([a-z]){2,}" class="form-control" name="siteweb" id="siteweb" placeholder="www.contact.sn">
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
                    <label for="secteur">Secteur d'Activité</label>
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
                <div class="form-group d-flex">
                    <h6 class="flex-fill">Vous avez completez le formulaire, il ne vous reste qu'a l'envoyer !</h6>
                    <input type="submit" value="Envoyer" class="btn btn-primary flex-fill">
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
            <li class="nav-item"><a href="#" class="nav-link btn btn-outline-primary" id="prev" data-toggle="tab" role="tab" aria-controls="" aria-selected="">Précédent</a></li>
            <li class="nav-item"><a href="#" class="nav-link btn btn-outline-primary" id="next" data-toggle="tab" role="tab" aria-controls="" aria-selected="">Suivant</a></li>
        </ul>
    </form>
</div>