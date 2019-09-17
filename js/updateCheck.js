$(document).ready(() => {
    if (window.location.href.includes("detail")) {
        let urlID = window.location.href.split("id=")[1]; // this depend on what is sent by "modifstartups.php" /!\
        $("#updateToast").toast({
            "delay": 3000
        })
        if (window.location.href.includes("sc=added")) {
            console.log(urlID);
            $("#updateToast").toast("show")
            $("#updateToast").on('hidden.bs.toast', () => {
                console.log("Toast component has been completely closed.");
                history.replaceState('', '', 'index.php?page=detail&id=' + urlID);
            });
            $("#updateToast").on('show.bs.toast', () => {
                console.log("Toast component has been showed.");
            });
        } else if (window.location.href.includes("er")) {
            $("#updateErrorToast").toast({
                "delay": 3000
            })
            $("#updateErrorToast").toast("show")
            $("#updateErrorToast").on('hidden.bs.toast', () => {
                console.log("Toast component has been completely closed.");
                history.replaceState('', '', 'index.php?page=detail&id=' + urlID);
            });
            $("#updateErrorToast").on('show.bs.toast', () => {
                console.log("Toast component has been showed.");
            });
        }
        let stuffDone = false
        $("#save").click(function(e) {
            if (!stuffDone) {
                e.preventDefault();
                let denomination = $('[name = "denomination"]')
                let type = $('[name = "type"]')
                let statut_juridique = $('[name = "statut_juridique"]')
                let date_creation = $('[name = "date_creation"]')
                let adresse = $('[name = "adresse"]')
                let email = $('[name = "email"]')
                let siteweb = $('[name = "siteweb"]')
                let description = $('[name = "description"]')
                let secteur = $('[name = "secteur"]')
                let prenom = $('[name = "prenom"]')
                let nom = $('[name = "nom"]')
                let tel = $('[name = "tel"]')
                let efft = $('[name = "efft"]')

                let denominationValid = false;
                let typeValid = false;
                let statut_juridiqueValid = false;
                let date_creationValid = false;
                let adresseValid = false;
                let emailValid = false;
                let sitewebValid = false;
                let descriptionValid = false;
                let secteurValid = false;
                let prenomValid = false;
                let nomValid = false;
                let telValid = false;
                let efftValid = false;

                console.log(
                    "denomination = " + denomination[0].value + "\n",
                    "type = " + type[0].value + "\n",
                    "statut_juridique = " + statut_juridique[0].value + "\n",
                    "date_creation = " + date_creation[0].value + "\n",
                    "adresse = " + adresse[0].value + "\n",
                    "email = " + email[0].value + "\n",
                    "siteweb = " + siteweb[0].value + "\n",
                    "description = " + description[0].value + "\n",
                    "secteur = " + secteur[0].value + "\n",
                    "prenom = " + prenom[0].value + "\n",
                    "nom = " + nom[0].value + "\n",
                    "tel = " + tel[0].value + "\n",
                    "efft = " + efft[0].value + "\n"
                );

                if (denomination[0].validity.valid) {
                    denomination.addClass("border border-success")
                    denomination.removeClass("border border-danger")
                    denominationValid = true
                } else {
                    denomination.addClass("border border-danger")
                    denomination.removeClass("border border-success")
                    denominationValid = false
                }
                if (type[0].validity.valid) {
                    type.addClass("border border-success")
                    type.removeClass("border border-danger")
                    typeValid = true
                } else {
                    type.addClass("border border-danger")
                    type.removeClass("border border-success")
                    typeValid = false
                }
                if (statut_juridique[0].validity.valid) {
                    statut_juridique.addClass("border border-success")
                    statut_juridique.removeClass("border border-danger")
                    statut_juridiqueValid = true
                } else {
                    statut_juridique.addClass("border border-danger")
                    statut_juridique.removeClass("border border-success")
                    statut_juridiqueValid = false
                }
                if (date_creation[0].validity.valid && date_creation[0].value != "") {
                    date_creation.addClass("border border-success")
                    date_creation.removeClass("border border-danger")
                    date_creationValid = true
                } else {
                    date_creation.addClass("border border-danger")
                    date_creation.removeClass("border border-success")
                    date_creationValid = false
                }
                if (adresse[0].validity.valid) {
                    adresse.addClass("border border-success")
                    adresse.removeClass("border border-danger")
                    adresseValid = true
                } else {
                    adresse.addClass("border border-danger")
                    adresse.removeClass("border border-success")
                    adresseValid = false
                }
                if (email[0].validity.valid) {
                    email.addClass("border border-success")
                    email.removeClass("border border-danger")
                    emailValid = true
                } else {
                    email.addClass("border border-danger")
                    email.removeClass("border border-success")
                    emailValid = false
                }
                if (siteweb[0].validity.valid) {
                    siteweb.addClass("border border-success")
                    siteweb.removeClass("border border-danger")
                    sitewebValid = true
                } else {
                    siteweb.addClass("border border-danger")
                    siteweb.removeClass("border border-success")
                    sitewebValid = false
                }
                if (description[0].validity.valid) {
                    description.addClass("border border-success")
                    description.removeClass("border border-danger")
                    descriptionValid = true
                } else {
                    description.addClass("border border-danger")
                    description.removeClass("border border-success")
                    descriptionValid = false
                }
                if (secteur[0].validity.valid) {
                    secteur.addClass("border border-success")
                    secteur.removeClass("border border-danger")
                    secteurValid = true
                } else {
                    secteur.addClass("border border-danger")
                    secteur.removeClass("border border-success")
                    secteurValid = false
                }
                if (prenom[0].validity.valid) {
                    prenom.addClass("border border-success")
                    prenom.removeClass("border border-danger")
                    prenomValid = true
                } else {
                    prenom.addClass("border border-danger")
                    prenom.removeClass("border border-success")
                    prenomValid = false
                }
                if (nom[0].validity.valid) {
                    nom.addClass("border border-success")
                    nom.removeClass("border border-danger")
                    nomValid = true
                } else {
                    nom.addClass("border border-danger")
                    nom.removeClass("border border-success")
                    nomValid = false
                }
                if (tel[0].validity.valid) {
                    tel.addClass("border border-success")
                    tel.removeClass("border border-danger")
                    telValid = true
                } else {
                    tel.addClass("border border-danger")
                    tel.removeClass("border border-success")
                    telValid = false
                }
                if (efft[0].validity.valid) {
                    efft.addClass("border border-success")
                    efft.removeClass("border border-danger")
                    efftValid = true
                } else {
                    efft.addClass("border border-danger")
                    efft.removeClass("border border-success")
                    efftValid = false
                }

                if (denominationValid &&
                    typeValid &&
                    statut_juridiqueValid &&
                    date_creationValid &&
                    adresseValid &&
                    emailValid &&
                    sitewebValid &&
                    descriptionValid &&
                    secteurValid &&
                    prenomValid &&
                    nomValid &&
                    telValid &&
                    efftValid) {
                    console.log("ok");
                    stuffDone = true
                    $(this).trigger("click");
                } else {
                    console.log("not ok");
                    stuffDone = false
                }
            } else {
                return
            }
        });

        // for all the checkbox on the edit mode
        let sfEditCheck = $("#softwareEdit")
        if (sfEditCheck[0].checked) {
            $("#sfShow").show()
        } else {
            $("#sfShow").hide()
        }
        let hdEditCheck = $("#hardwareEdit")
        if (hdEditCheck[0].checked) {
            $("#hdShow").show()
        } else {
            $("#hdShow").hide()
        }
        let ntEditCheck = $("#ict_networkEdit")
        if (ntEditCheck[0].checked) {
            $("#ntShow").show()
        } else {
            $("#ntShow").hide()
        }
        let scEditCheck = $("#ict_serviceEdit")
        if (scEditCheck[0].checked) {
            $("#scShow").show()
        } else {
            $("#scShow").hide()
        }
        let adEditCheck = $("#ict_advanceEdit")
        if (adEditCheck[0].checked) {
            $("#adShow").show()
        } else {
            $("#adShow").hide()
        }
        sfEditCheck.click(() => {
            console.log(sfEditCheck[0].checked)
            if (sfEditCheck[0].checked) {
                $("#sfShow").show()
            } else {
                $("#sfShow").hide()
            }
        })
        hdEditCheck.click(() => {
            console.log(hdEditCheck[0].checked)
            if (hdEditCheck[0].checked) {
                $("#hdShow").show()
            } else {
                $("#hdShow").hide()
            }
        })
        ntEditCheck.click(() => {
            console.log(ntEditCheck[0].checked)
            if (ntEditCheck[0].checked) {
                $("#ntShow").show()
            } else {
                $("#ntShow").hide()
            }
        })
        scEditCheck.click(() => {
            console.log(scEditCheck[0].checked)
            if (scEditCheck[0].checked) {
                $("#scShow").show()
            } else {
                $("#scShow").hide()
            }
        })
        adEditCheck.click(() => {
            console.log(adEditCheck[0].checked)
            if (adEditCheck[0].checked) {
                $("#adShow").show()
            } else {
                $("#adShow").hide()
            }
        })
    }
});