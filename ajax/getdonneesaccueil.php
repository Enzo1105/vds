<?php

/*
 * Récupération des données alimentant la page d'accueil
 */

require '../include/initialisation.php';


// Tableau stockant l'ensemble des tableaux de données à retourner
$lesDonnees = [];

// la classe Database sera chargée dynamiquement (pas besoin de require)
$lesDonnees['bandeau'] = base::getLeBandeau();


// récupération de la prochaine édition des 4 saisons

$sql = <<<EOD
            select id, nom, description, DATE_FORMAT(date, "%d/%m/%Y") as dateCourse, urlInscription, urlInscrit, 
                    DATE_FORMAT(dateOuverture, "%d/%m/%Y") as dateOuvertureFr, DATE_FORMAT(dateFermeture, "%d/%m/%Y") as dateFermetureFr,
                    dateOuverture, dateFermeture, date, curdate() as today
                from epreuve
                where date > curdate() 
                order by date
                limit 1;
EOD;
$db = Database::getInstance();
$curseur = $db->query($sql);
$lesDonnees['epreuve'] = $curseur->fetchAll(PDO::FETCH_ASSOC);
$curseur->closeCursor();


// récupération du dernier résultat datant de moins de 15 jours concernant les coureurs du club paru sur le site de la ffa : table resultatffa

// récupération des partenaires


// vérification de l'existence de l'image et solution au problème de non-rafraichissement du cache


// récupération des liens utiles





echo json_encode($lesDonnees);