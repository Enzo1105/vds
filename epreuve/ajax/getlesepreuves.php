<?php

require '../../class/class.database.php';
$db = Database::getInstance();

// envoie la course qui a une date de fermeture supérieur à la date du jour, donc cela n'affiche plus les courses qui sont closes
// définir ma requête
$sql = <<<EOD
            select id, nom, description, DATE_FORMAT(date, "%d/%m/%Y") as dateCourse, urlInscription, urlInscrit, 
                    DATE_FORMAT(dateOuverture, "%d/%m/%Y") as dateOuvertureFr, DATE_FORMAT(dateFermeture, "%d/%m/%Y") as dateFermetureFr,
                    dateOuverture, dateFermeture, date, curdate() as today
                from epreuve
                where date > curdate() 
                order by date
                limit 1;
EOD;

// A FAIRE !! : TROUVER UN MOYEN POUR RECUPERER UNIQUEMENT LA PROCHAINE EPREUVE
// EN FONCTION DE LA DATE

$curseur = $db->query($sql);
$lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();

// envoyer le résultat au format JSON
echo json_encode($lesLignes);
