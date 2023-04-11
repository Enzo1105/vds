"use strict";

/**
 * Définition des traitement sur l'interface de gestion des épreuves
 * Utilisation du composant ckEditor pour la saisie de la description
 */

// le tableau conserve les données des épreuves en mémoire

let dateJour = new Date();
// la date de l'épreuve doit être supérieure à la date du jour
let min = dateJour.toFormatMySQL();
let lesEpreuves = [];


window.onload = init;

/**
 * Chargement des épreuves et initialisation CkEditor
 */
function init() {

    CKEDITOR.replace('description');
    // charger les épreuves
    $.ajax({
        url: 'ajax/getlesepreuves.php',
        dataType: 'json',
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
        success: (data) => {
            if (data.length > 0) {
                formulaire.style.visibility = 'visible';
                lesEpreuves = data;
                for (let epreuve of lesEpreuves) {
                    liste.add(new Option(epreuve.nom, epreuve.id));
                }
                afficher();
            } else {
                document.location.href = "ajout.php"
            }
        }
    });

    liste.onchange = afficher;
    btnModifier.onclick = modifier;
    btnSupprimer.onclick = () => Std.confirmer(() => supprimer(liste.value));
}

/**
 * Affichage des informations concernant l'épreuve sélectionnée dans la zone de liste
 */
function afficher() {
    let epreuve = lesEpreuves[liste.selectedIndex];
    nom.value = epreuve.nom;
    date.value = epreuve.date;
    //  CKEDITOR.instances.description.setData(epreuve.description);
    setTimeout(() => CKEDITOR.instances.description.setData(epreuve.description), 50);
    dateOuverture.value = epreuve.dateOuverture
    dateFermeture.value = epreuve.dateFermeture
    urlInscription.value = epreuve.urlInscription
    urlInscrit.value = epreuve.urlInscrit
}

/**
 * Demande de modification après contrôle des données
 * Le champ description géré par ckEditor demande un traitmlent particulier
 */
function modifier() {
    let valide = Std.donneesValides();

    // contrôle sur le champ description
    let description = CKEDITOR.instances.description.getData().trim();
    messageDescription.innerText = '';
    if (description.length < 30) {
        messageDescription.innerText = 'La description est insuffisamment renseignée (30 caractères minimum)';
        valide = false;
    }

    if (valide) {

        msg.innerHTML = "";
        // mise à jour de la base de données
        $.ajax({
            url: 'ajax/modifier.php',
            type: 'POST',
            data: {
                date: date.value,
                nom: nom.value,
                description: description,
                id: liste.value,
                dateOuverture: dateOuverture.value,
                dateFermeture: dateFermeture.value,
                urlInscription: urlInscription.value,
                urlInscrit: urlInscrit.value
            },
            dataType: 'json',
            error: reponse => {
                msg.innerHTML = Std.genererMessage(reponse.responseText)
            },
            success: function () {
                // mise à jour du tableau
                let indice = liste.selectedIndex;
                lesEpreuves[indice].nom = nom.value;
                lesEpreuves[indice].description = description;
                lesEpreuves[indice].date = date.value;
                lesEpreuves[indice].dateOuverture = dateOuverture.value;
                lesEpreuves[indice].dateFermeture = dateFermeture.value;
                lesEpreuves[indice].urlInscription = urlInscription.value;
                lesEpreuves[indice].urlInscrit = urlInscrit.value;

                // mise à jour de l'interface
                Std.afficherSucces('Modification enregistrée');
                liste.options[liste.selectedIndex].text = nom.value
            }
        })
    }
}

/**
 * Demande de suppression
 */
function supprimer() {
    $.ajax({
        url: 'ajax/supprimer.php',
        type: 'POST',
        data: {id: liste.value},
        dataType: 'json',
        success: function () {
            Std.afficherSucces('Suppression réalisée');
            // mise à jour du tableau (il est synchronisé avec la zone de liste
            let indice = liste.selectedIndex;
            lesEpreuves.splice(indice, 1);
            // mise à jour de la zone de liste
            liste.removeChild(liste[indice]);

            // mise à jour interface
            if (lesEpreuves.length === 0) {
                document.location.href = "ajout.php";
            } else {
                afficher();
            }
        },
        error: reponse => {
            msg.innerHTML = Std.genererMessage(reponse.responseText)
        },
    })
}
