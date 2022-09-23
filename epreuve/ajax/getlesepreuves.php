<?php

require '../../class/class.database.php';
$db = Database::getInstance();

// définir ma requête
$sql = <<<EOD
            select id, nom, description, DATE_FORMAT(date, "%d/%m/%Y") as date, urlInscription, urlInscrit,
                    DATE_FORMAT(dateOuverture, "%d/%m/%Y") as dateOuverture, DATE_FORMAT(dateFermeture, "%d/%m/%Y") as dateFermeture
            from epreuve;
EOD;

// A FAIRE !! : TROUVER UN MOYEN POUR RECUPERER UNIQUEMENT LA PROCHAINE EPREUVE
// EN FONCTION DE LA DATE

$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();

// envoyer le résultat au format JSON
echo json_encode($lesLignes);
