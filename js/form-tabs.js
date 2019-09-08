$(document).ready(() => {
    let prevBtn = $("#prev")
    let nextBtn = $("#next")
    let form = $("#addForm")
    let stepOne = $("#infoSimple")
    let stepTwo = $("#juridiction")
    let stepThree = $("#infoAvance")
    let stepFinal = $("#final")
    console.log(stepOne[0]);
    if (stepOne[0] != undefined || stepTwo[0] != undefined || stepThree[0] != undefined) {
        if (stepOne[0].className.includes("show active")) {
            prevBtn.hide()
        }
        nextBtn.click(function(e) {
            e.preventDefault();
            //step one
            let denomination = $("#denomination");
            let adresse = $("#adresse");
            let email = $("#email");
            let tel = $("#tel");
            let siteweb = $("#siteweb");
            let denominationValid = false;
            let adresseValid = false;
            let emailValid = false;
            let telValid = false;
            let sitewebValid = false;
            // step two
            let statut_juridique = $("#statut_juridique");
            let date_creation = $("#date_creation");
            let region = $("#region");
            let statut_juridiqueValid = false;
            let date_creationValid = false;
            let regionValid = false;
            //step three
            let description = $("#description");
            let secteur = $("#secteur");
            let prenom = $("#prenom");
            let nom = $("#nom");
            let efft = $("#efft");
            let descriptionValid = false;
            let secteurValid = false;
            let prenomValid = false;
            let nomValid = false;
            let efftValid = false;


            if (stepOne[0].className.includes("show active")) {
                if (denomination[0].validity.valid) {
                    denomination.addClass("border border-success");
                    denomination.removeClass("border border-danger");
                    denominationValid = true
                } else {
                    denomination.removeClass("border border-success");
                    denomination.addClass("border border-danger");
                    denominationValid = false
                }
                if (adresse[0].validity.valid) {
                    adresse.addClass("border border-success");
                    adresse.removeClass("border border-danger");
                    adresseValid = true
                } else {
                    adresse.removeClass("border border-success");
                    adresse.addClass("border border-danger");
                    adresseValid = false
                }
                if (email[0].validity.valid && email[0].value != "") {
                    email.addClass("border border-success");
                    email.removeClass("border border-danger");
                    emailValid = true
                } else {
                    email.removeClass("border border-success");
                    email.addClass("border border-danger");
                    emailValid = false
                }
                if (tel[0].validity.valid && tel[0].value != "") {
                    telValid = true
                    tel.addClass("border border-success");
                    tel.removeClass("border border-danger");
                } else {
                    tel.removeClass("border border-success");
                    tel.addClass("border border-danger");
                    telValid = false
                }
                if (siteweb[0].validity.valid && siteweb[0].value != "") {
                    siteweb.addClass("border border-success");
                    siteweb.removeClass("border border-danger");
                    sitewebValid = true
                } else {
                    siteweb.removeClass("border border-success");
                    siteweb.addClass("border border-danger");
                    sitewebValid = false
                }

                if (denominationValid &&
                    adresseValid &&
                    emailValid &&
                    telValid &&
                    sitewebValid) {
                    // for (let index = 0; index < tabs.length; index++) {
                    //     const div = tabs[index];
                    //     if (div.id = "juridiction" && !div.className.includes("show active")) {
                    //         div.addClass("show acive");
                    //     } else {
                    //         console.log(div);
                    //     }
                    // }
                    if (stepOne[0].className.includes("show active")) {
                        stepOne.removeClass("show active");
                        stepTwo.addClass("show active");
                        prevBtn.show();
                    }
                }
            } else if (stepTwo[0].className.includes("show active")) {
                if (statut_juridique[0].validity.valid && statut_juridique[0].value == "default") {
                    statut_juridique.removeClass("border border-success");
                    statut_juridique.addClass("border border-danger");
                    statut_juridiqueValid = false
                } else {
                    statut_juridique.addClass("border border-success");
                    statut_juridique.removeClass("border border-danger");
                    statut_juridiqueValid = true
                }
                if (date_creation[0].validity.valid && date_creation[0].value == "") {
                    date_creation.removeClass("border border-success");
                    date_creation.addClass("border border-danger");
                    date_creationValid = false
                } else {
                    date_creation.addClass("border border-success");
                    date_creation.removeClass("border border-danger");
                    date_creationValid = true
                }
                if (region[0].validity.valid && region[0].value == "default") {
                    region.removeClass("border border-success");
                    region.addClass("border border-danger");
                    regionValid = false
                } else {
                    region.addClass("border border-success");
                    region.removeClass("border border-danger");
                    regionValid = true
                }

                if (statut_juridiqueValid &&
                    date_creationValid &&
                    regionValid) {
                    stepTwo.removeClass("show active");
                    stepThree.addClass("show active");
                }
            } else if (stepThree[0].className.includes("show active")) {
                if (description[0].validity.valid && description[0].value != "") {
                    description.addClass("border border-success");
                    description.removeClass("border border-danger");
                    descriptionValid = true
                } else {
                    description.removeClass("border border-success");
                    description.addClass("border border-danger");
                    descriptionValid = false
                }
                if (secteur[0].validity.valid && secteur[0].value != "") {
                    secteur.addClass("border border-success");
                    secteur.removeClass("border border-danger");
                    secteurValid = true
                } else {
                    secteur.removeClass("border border-success");
                    secteur.addClass("border border-danger");
                    secteurValid = false
                }
                if (prenom[0].validity.valid && prenom[0].value != "") {
                    prenom.addClass("border border-success");
                    prenom.removeClass("border border-danger");
                    prenomValid = true
                } else {
                    prenom.removeClass("border border-success");
                    prenom.addClass("border border-danger");
                    prenomValid = false
                }
                if (nom[0].validity.valid && nom[0].value != "") {
                    nom.addClass("border border-success");
                    nom.removeClass("border border-danger");
                    nomValid = true
                } else {
                    nom.removeClass("border border-success");
                    nom.addClass("border border-danger");
                    nomValid = false
                }
                if (efft[0].validity.valid && efft[0].value != 0) {
                    efft.addClass("border border-success");
                    efft.removeClass("border border-danger");
                    efftValid = true
                } else {
                    efft.removeClass("border border-success");
                    efft.addClass("border border-danger");
                    efftValid = false
                }
                if (descriptionValid &&
                    secteurValid &&
                    prenomValid &&
                    nomValid &&
                    efftValid) {
                    stepThree.removeClass("show active");
                    stepFinal.addClass("show active");
                    nextBtn.hide();
                }
            }
        });
        prevBtn.click(function(e) {
            e.preventDefault();
            if (stepTwo[0].className.includes("show active")) {
                stepTwo.removeClass("show active");
                stepOne.addClass("show active");
                prevBtn.hide();
                nextBtn.show();
            } else if (stepThree[0].className.includes("show active")) {
                stepThree.removeClass("show active");
                stepTwo.addClass("show active");
            } else if (stepFinal[0].className.includes("show active")) {
                stepFinal.removeClass("show active");
                stepThree.addClass("show active");
            }
        });
    }
})