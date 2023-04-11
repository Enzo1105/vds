<?php
// Affichage de l'interface de modification
// donnée transmise par la méthode GET : id

// chargement des ressources
require "../include/initialisation.php";

// récupération de l'enregistrement correspondant
$table = new Calendrier();
$ligne = $table->rechercher();
if (!$ligne) {
    Std::traiterErreur($table->getValidationMessage());
}

// chargement de la page
// intervalle accepté pour la date de l'événement : dans l'annèe à venir
$min = date('Y-m-d');
$max = date("Y-m-d", strtotime("+1 year"));
$titreFonction = "Modification d'une épreuve du calendrier";
require RACINE . "/include/interface.php";

// transfert des données côté client
$data = json_encode($ligne);
echo "<script>let data = $data </script>";