<?php
/**
 * Consultation de la liste des membres
 */

require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Liste des membres";
require RACINE . '/include/head.php';

$lesMembres = Membre::getLesMembres();
// $lesCategories = Base::getLesCategories2();

// instanciation d'un objet de la classe tableau pour générer un affichage dans un conteneur de type table

$lesColonnes = ['Catégories', 'Code', 'Age entre', 'et', 'Né(e) entre', 'et'];
$lesTailles = [30, 10, 20, 20, 20, 20];
$lesAlignements = ['L', 'C', 'C', 'C', 'C', 'C'];
$lesStyles = ['', '', '', '', '', ''];
$lesClasses = ['', '', '', '', '', ''];

$monTableau = new Tableau($lesColonnes, $lesTailles, $lesStyles, $lesClasses);

foreach ($lesMembres as $row) {
    // $row[0] = $ligne['login'];
    $monTableau->ajouterLigne($row, $lesStyles, $lesClasses);
}
$monTableau->fermer();


?>
    <script src="consultation2.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css"/>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
    <div id="msg" class="m-3"></div>
   <?= $monTableau->getTableau(); ?>

<?php require RACINE . '/include/pied.php'; ?>