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
   let uneEpreuve = document.getElementById('idEpreuve');
    let option;
   for (const epreuve of data){
       option = new Option(data.nom);
   }
   uneEpreuve.appendChild(option);

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
            // mettre à jour la zone de liste en supprimant l'option sélectionnée et relancer la recherche

        },
        error: (reponse) => Std.afficherErreur(reponse.responseText)
    })
}
