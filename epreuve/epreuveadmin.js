"use strict"

window.onload = init;

function init() {
    btnAjouterEpreuve.onclick = ajouter();
    btnSupprimerEpreuve.onclick = () => {
        Std.confirmer(supprimer());
    }

    $.ajax({
        url: '/epreuve/ajax/getlesepreuves.php',
        type: 'GET',
        dataType: 'json',
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
        success: afficher
    });

    let btnAjouter = document.getElementById("btnAjouter");
    let btnModifier = document.getElementById("btnModifier");
    let btnSupprimer = document.getElementById("btnSupprimer");

    btnAjouter.onclick = (e) => {
        console.log("cliquer sur ajouter");
    };
}

function afficher(data) {
    for (const epreuve of data) {
        // ce qui ne dépend pas des dates :  La date et la description
        let prochaineEpreuve = data[0];
        console.log(data[0]);
        document.getElementById("prochaine_epreuve").innerText = "Prochaine édition des 4 saisons : le " + prochaineEpreuve.dateCourse;
        document.getElementById("description").innerText = "Description: " + prochaineEpreuve.description;
        document.getElementById("dateepreuve").value = "Edition d'automne: " + prochaineEpreuve.dateCourse;

        // avoir la date du jour avec le même format qu'en sql
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //Janvier = 0!
        let yyyy = today.getFullYear();

        today = dd + '/' + mm + '/' + yyyy;

        // si les inscriptions ne sont pas encore ouvertes
        if (prochaineEpreuve.dateOuverture > prochaineEpreuve.today) {
            btnInscription.style.display = "none";
            btnInscrire.style.display = "none";
            msgInscription.innerText = "Les inscriptions seront ouvertes à partir du " + prochaineEpreuve.dateOuvertureFr
            msgInscription.style.fontWeight = 'bold';
        } else if (prochaineEpreuve.dateFermeture > prochaineEpreuve.today) {
            // les inscriptions sont encore ouvertes
            btnInscription.href = prochaineEpreuve.urlInscription;
            btnInscrire.href = prochaineEpreuve.urlInscrit;
            msgInscription.innerText = "Les inscriptions sont possibles jusqu'au " + prochaineEpreuve.dateFermetureFr
        } else {
            // les inscriptions sont closes
            btnInscription.style.display = "none";
            btnInscrire.href = prochaineEpreuve.urlInscrit;
            msgInscription.innerText = "Les inscriptions sont closes depuis le " + prochaineEpreuve.dateFermetureFr
        }
    }
}

function ajouter() {
    // contrôle des champs de saisie
    let erreur = false;
    for (const input of document.getElementsByClassName('ctrl')) {
        input.nextElementSibling.innerText = input.validationMessage;
        if (!input.checkValidity()) erreur = true;
    }
    // if (!Std.controler(input)) erreur = true;
    // si une erreur est détectée on quitte la fonction
    if (erreur) return;

    //  demande d'ajout dans la base de données
    $.ajax({
        url: '../ajax/epreuve/ajouter.php',
        type: 'POST',
        data: {
            nom: nom.value,
            description: description.value,
            date: date.value,
            dateOuverture: dateOuverture.value,
            dateFermeture: dateFermeture.value,
        },
        dataType: "json",
        success: function () {
            Std.afficherSucces('... ajouté')
            // effacer le contenu des champs
            for (const input of document.querySelectorAll('input.ctrl'))
                input.value = "";
        },

        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}

function modifier() {
    $.ajax({
        url: '../ajax/epreuve/modifier.php',
        type: 'POST',
        data: {
            nom: nom.value,
            description: description.value,
            date: date.value,
            dateOuverture: dateOuverture.value,
            dateFermeture: dateFermeture.value,
        },
        dataType: "json",
        success: function () {
            Std.afficherSucces("Modification enregistrée");
            // mettre à jour la zone de liste en supprimant l'opion sélectionnée et relancer la recherche

        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}

function supprimer() {
    $.ajax({
        url: '../ajax/epreuve/supprimer.php',
        type: 'POST',
        data: {
            nom: nom.value,
            description: description.value,
            date: date.value,
            dateOuverture: dateOuverture.value,
            dateFermeture: dateFermeture.value,
        },
        dataType: "json",
        success: function () {
            Std.afficherSucces("Suppression réalisée");
            // mettre à jour la zone de liste en supprimant l'otpion sélectionnée et relancer la recherche

        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}
