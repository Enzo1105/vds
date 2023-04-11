"use strict"

window.onload = init;

function init() {
    // activation de composant  de mise en forme des cases à cocher
    $(':checkbox').checkboxpicker();
    btnAjouter.onclick = ajouter;
}


function ajouter() {
    Std.effacerLesErreurs();
    // if (!Std.donneesValides()) return

    // données transmises
    let monFormulaire = new FormData();
    monFormulaire.append('nom', nom.value.toUpperCase());
    monFormulaire.append('numero', numero.value);
    monFormulaire.append('date', date.value);
    monFormulaire.append('challenge', challenge.checked ? 1 : 0);
    monFormulaire.append('label', label.checked ? 1 : 0);
    if (distance.value.length > 0) monFormulaire.append('distance', distance.value.toLowerCase());

    $.ajax({
            url: "ajax/ajouter.php",
            type: 'post',
            data: monFormulaire,
            contentType: false,
            processData: false,
            dataType: "json",

            success: (data) => {
                if (data.error) {
                    for (const erreur of data.error) {
                        if (erreur.champ === 'msg') {
                            msg.innerHTML = Std.genererMessage(erreur.message);
                        } else {
                            let champ = document.getElementById('msg' + erreur.champ)
                            champ.innerText = erreur.message;
                        }
                    }
                } else if (data.success) {
                    Std.retournerVers(data.success, 'index.php');
                } else {
                    Std.afficherErreur("Le serveur n'a pas renvoyé de réponse, contacter la maintenance");
                }
            },
            error: (reponse) => {
                msg.innerHTML = Std.genererMessage("L'opération a échoué, contacter la maintenance")
                console.error(reponse.responseText)
            }
        }
    );
}