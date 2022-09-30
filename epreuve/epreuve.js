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
    console.log(data[0]);
    document.getElementById("prochaine_epreuve").innerText = "Prochaine édition des 4 saisons : le " + prochaineEpreuve.dateCourse;
    document.getElementById("description").innerText = "Description: " + prochaineEpreuve.description;
    document.getElementById("date_fermeture").innerText = "Les inscriptions sont possibles jusqu'au " + prochaineEpreuve.dateFermetureFr;

    let btnInscription = document.getElementById('inscription');

    // avoir la date d'aujourd'hui avec le même format que sql
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();

    today = dd + '/' + mm + '/' + yyyy;

    // si la date de fermeture est supérieur à la date du jour , le bouton inscription s'affiche
    if (prochaineEpreuve.dateFermetureFr > today) {

        btnInscription.style.visibility = "hidden";
    }
}