"use strict";

window.onload = init;

function init() {
    $.ajax({
        url: '/epreuve/ajax/getlesepreuves.php',
        type: 'GET',
        dataType: 'json',
        error: reponse => { msg.innerHTML = Std.genererMessage(reponse.responseText)},
        success: afficher
    });
}

function afficher(data) {
    console.log(data);

    let prochaineEpreuve = data[0];

    document.getElementById("prochaine_epreuve").innerText = "Prochaine édition des 4 saisons: " + prochaineEpreuve.date;
    document.getElementById("description").innerText = "Description: " + prochaineEpreuve.description;
    document.getElementById("date_fermeture").innerText = "Fermeture: " + prochaineEpreuve.dateFermeture;
}