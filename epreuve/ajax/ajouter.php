<?php

/**
 *  Ajout d'une épreuve des 4 saisons
 * Appel : epreuve/ajout.php
 * Résultat : 1 ou message d'erreur
 */
$ajax = 1;
require '../../include/initialisation.php';
require '../../include/controleacces.php';

// contrôle des paramètres attendus
if (!Controle::existe('date', 'nom', 'description', 'dateOuverture', 'dateFermeture', 'urlInscription', 'urlInscrit')) {
    echo "Données manquantes";
    exit;
}

// récupération des paramètres
$nom = $_POST['nom'];
$description = $_POST['description'];
$date = $_POST['date'];
$dateOuverture = $_POST['dateOuverture'];
$dateFermeture = $_POST['dateFermeture'];
$urlInscription = $_POST['urlInscription'];
$urlInscrit = $_POST['urlInscrit'];

// contrôle de l'unicité de la date de l'épreuve
$sql = <<<EOD
    Select 1
    From epreuve
    Where date = :date;
EOD;
$db = Database::getInstance();
$curseur = $db->prepare($sql);
$curseur->bindParam('date', $date);
$curseur->execute();
$ligne = $curseur->fetch();
$curseur->closeCursor();
if ($ligne) {
    echo "Une épreuve est déjà programmée à cette date";
    exit();
}


// ajout dans la table épreuve
// les champs dateOuverture, dateFermeture urlInscription ert urlInscrit sont optionnels
// utilisation de la syntaxe insert into epreuve set pour une écriture commune avec la modification

// construction de la requête d'insertion
$pDateOuverture = empty($dateOuverture) ? "null" : ":dateOuverture";
$pDateFermeture = empty($dateFermeture) ? "null" : ":dateFermeture";
$pUrlInscription = empty($urlInscription) ? "null" : ":urlInscription";
$pUrlInscrit = empty($urlInscrit) ? "null" : ":urlInscrit";

$sql = <<<EOD
        insert into epreuve
            set description = :description, 
                nom = :nom,
                date = :date,
                dateOuverture = $pDateOuverture,
                dateFermeture = $pDateFermeture,
                urlInscription = $pUrlInscription,
                urlInscrit = $pUrlInscrit
EOD;
$db = Database::getInstance();
$curseur = $db->prepare($sql);
$curseur->bindParam('description', $description);
$curseur->bindParam('nom', $nom);
$curseur->bindParam('date', $date);
if (!empty($dateOuverture)) $curseur->bindParam('dateOuverture', $dateOuverture);
if (!empty($dateFermeture)) $curseur->bindParam('dateFermeture', $dateFermeture);
if (!empty($urlInscription)) $curseur->bindParam('urlInscription', $urlInscription);
if (!empty($urlInscrit)) $curseur->bindParam('urlInscrit', $urlInscrit);
try {
    $curseur->execute();
    echo 1;
} catch (Exception $e) {
    echo substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
}
