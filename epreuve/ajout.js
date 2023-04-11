"use strict";

/**
 * Traitement sur l'ajout d'une épreuve
 * utilisation ckEditor pour la description
 */


window.onload = init

/**
 * Initialisation ckEditor
 * Définition de l'intervalle sur la date :j à j + 365
 */
function init() {
    CKEDITOR.replace('description', {height: '300px'});
    let dateduJour = new Date();
    let min = dateduJour.toFormatMySQL();
    dateduJour.ajouterJour(365)
    let max = dateduJour.toFormatMySQL();

    date.min = min;
    dateOuverture.min = min;
    dateOuverture.max = max;
    dateFermeture.min = min;
    dateFermeture.max = max;
    btnAjouter.onclick = ajouter;


    pied.style.visibility = 'visible';
}


/**
 * Demande d'ajout d'une épreuve après contrôle des champs de saisie
 * le champ description géré par ckEditor demande un traitement particulier
 */
function ajouter() {
    let valide = Std.donneesValides();

    // contrôle sur le champ description
    let description = CKEDITOR.instances.description.getData().trim();
    messageDescription.innerText = '';
    if (description.length < 30) {
        messageDescription.innerText = 'La description est insuffisamment renseignée (30 caractères minimum)';
        valide = false;
    }

    if (valide) {

        $.ajax({
            url: 'ajax/ajouter.php',
            type: 'POST',
            data: {
                nom: nom.value,
                description: description,
                date: date.value,
                dateOuverture: dateOuverture.value,
                dateFermeture: dateFermeture.value,
                urlInscription: urlInscription.value,
                urlInscrit: urlInscrit.value
            },
            dataType: 'json',
            error: reponse => {
                msg.innerHTML = Std.genererMessage(reponse.responseText)
            },
            success: function (id) {
                let parametre = {
                    message: "Votre nouvelle épreuve vient d'être ajoutée",
                    type: 'success',
                    fermeture: 1,
                    surFermeture: function () {
                        document.location.href = "index.php"
                    }
                }
                Std.afficherMessage(parametre);
            }
        })
    }
}


