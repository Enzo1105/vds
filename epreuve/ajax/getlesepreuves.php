<?php

/**
 *  récupération des épreuves au format JSON
 * Appel : epreuve/index.js fonction init
 */

$ajax = 1;
require '../../include/initialisation.php';
require '../../include/controleacces.php';

// récupération des épreuves programmées des 4 saisons
$sql = <<<EOD
        Select id, date, nom, description, dateOuverture, dateFermeture, urlInscription, urlInscrit
        From epreuve
        Order by date desc;
EOD;
$db = Database::getInstance();
$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();

echo json_encode($lesLignes);

