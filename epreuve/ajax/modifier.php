<?php
if (!isset($_POST['id'])) {
    echo "L'id de l'épreuve n'est pas transmise";
    exit;
}

// récupération des paramètres
$id = trim($_POST['id']);

// il faut au moins transmettre un des champs suivant : description, date, dateOuverture, dateFermeture
require '../../class/class.controle.php';
$nb = 0;

if (isset($_POST['description'])) {
    $nom = strtoupper(Controle::supprimerEspace($_POST['nom']));
    $nb++;
}

if (isset($_POST['date'])) {
    $prenom = Controle::supprimerEspace($_POST['date']);
    $nb++;
}

if (isset($_POST['dateOuverture'])) {
    $dateNaissance = trim($_POST['dateOuverture']);
    $nb++;
}

if (isset($_POST['dateFermeture'])) {
    $sexe = strtoupper(trim($_POST['dateFermeture']));
    $nb++;
}

if ($nb === 0) {
    echo "Aucune modification demandée";
    exit;
}

// Contrôle des données
require '../../class/class.database.php';
$db = Database::getInstance();
$erreur = false;