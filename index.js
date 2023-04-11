'use strict';

/**
 *    chargement de l'ensemble des données nécessaires afin d'alimenter la page d'accueil :
 *        dernier résultat présent sur le site FFA : table resultatFFA
 *        prochaine épreuve : table epreuve
 *        la dernière actualité : champ contenu de la table bandeau
 *        informations clubs et 4 saisons : table element
 *        partenaires et liens utiles : table partenaire et lien
 */

window.onload = init;

/**
 *     chargement de l'ensemble des données nécessaires :
 *
 */
function init() {
    $.ajax({
        url: 'ajax/getdonneesaccueil.php',
        dataType: 'json',
        error: reponse => console.error(reponse.responseText),
        success: afficher
    });

    // activation de toutes les infobulles et popover de la page
    let option = {
        trigger: "hover",
        placement: "top",
        html: true,
    }
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(element => new bootstrap.Tooltip(element));
    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(element => new bootstrap.Popover(element, option));
}

/**
 * Alimente en données les différents éléments de la page d'accueil
 * @param { Object } data données au format json
 *    date.lesClassements contient le nom des fichier pdf trouvé dans le répertoire
 */
function afficher(data) {

    // alimentation du bandeau
    detailBandeau.innerHTML = data.bandeau;


    // afficher le dernier résultat de moins de 15 jours publié sur le site de la F.F.A


    // affichage de la prochaine épreuve si renseignée
    if (data.epreuve.length === 0) {
        btnInscription.style.display = "none";
        btnInscrire.style.display = "none";
    } else {
        // ce qui ne dépend pas des dates :  La date et la description
        let prochaineEpreuve = data.epreuve[0];
        document.getElementById("prochaine_epreuve").innerText = "Prochaine édition des 4 saisons : le " + prochaineEpreuve.dateCourse;
        document.getElementById("description").innerHTML = prochaineEpreuve.description;


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


    // affichage des partenaires


    // affichage des liens

    
    pied.style.visibility = 'visible';
}
