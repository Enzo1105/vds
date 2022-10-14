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
    if (data.length === 0) {
        btnInscription.style.display = "none";
        btnInscrire.style.display = "none";
    } else {
        // ce qui ne dépend pas des dates :  La date et la description
        let prochaineEpreuve = data[0];
        console.log(data[0]);
        document.getElementById("prochaine_epreuve").innerText = "Prochaine édition des 4 saisons : le " + prochaineEpreuve.dateCourse;
        document.getElementById("description").innerText = "Description: " + prochaineEpreuve.description;


        // avoir la date d'aujourd'hui avec le même format que sql
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //Janvier = 0!
        let yyyy = today.getFullYear();

        today = dd + '/' + mm + '/' + yyyy;

        // si les inscriptions ne sont pas encore ouvertes
        if (prochaineEpreuve.dateOuverture > prochaineEpreuve.today) {
            btnInscription.style.display = "none";
            btnInscrire.style.display = "none";
            msgInscription.innerText =  "Les inscriptions seront ouvertes à partir du " + prochaineEpreuve.dateOuvertureFr
            msgInscription.style.fontWeight = 'bold';
        } else if (prochaineEpreuve.dateFermeture > prochaineEpreuve.today) {
            // les inscriptions sont encore ouvertes
            btnInscription.href = prochaineEpreuve.urlInscription;
            btnInscrire.href = prochaineEpreuve.urlInscrit;
            msgInscription.innerText =  "Les inscriptions sont possibles jusqu'au " + prochaineEpreuve.dateFermetureFr
        } else {
            // les inscriptions sont closes
            btnInscription.style.display = "none";
            btnInscrire.href = prochaineEpreuve.urlInscrit;
            msgInscription.innerText =  "Les inscriptions sont closes depuis le " + prochaineEpreuve.dateFermetureFr

        }
    }
}