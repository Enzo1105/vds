"use strict"
// identifiant de l'épreuve en cours de modification
let id

window.onload = () => {

    date.value = data.date;
    numero.value = data.numero;
    nom.value = data.nom;
    distance.value = data.distance;
    id = data.id;

    btnModifier.onclick = () => {
        Std.effacerLesErreurs()
        if (!Std.donneesValides()) return;
        let monFormulaire = new FormData();
        monFormulaire.append('id', id);
        monFormulaire.append('nom', nom.value.toUpperCase());
        monFormulaire.append('numero', numero.value.toUpperCase());
        monFormulaire.append('date', date.value);
        if (distance.value.length > 0) monFormulaire.append('distance', distance.value.toLowerCase());
        $.ajax({
                url: "ajax/modifier.php",
                type: 'post',
                dataType: "json",
                data: monFormulaire,
                contentType: false,
                processData: false,
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
                        msg.innerHTML = Std.genererMessage("Réponse non attendue du serveur, contacter la maintenance");
                        console.error(data);
                    }
                },
                error: (reponse) => {
                    msg.innerHTML = Std.genererMessage("L'opération a échoué, contacter la maintenance")
                    console.error(reponse.responseText)
                }
            }
        );
    }
}