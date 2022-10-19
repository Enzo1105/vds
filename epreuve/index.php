<?php
/**
 * Page d'accueil admin des épreuves
 */

require 'include/initialisation.php';


// Génération des options du menu Administration

$cadreAdmin = "";
if (isset($_SESSION['membre'])) {
    $id = $_SESSION['membre']['id'];
    // la classe base est chargée dynamiquement
    $lesLignes = Base::getLesModules($id);

    if ($lesLignes) {
        foreach ($lesLignes as $ligne) {
            $nom = $ligne['nom'];
            $description = $ligne['description'];
            $repertoire = $ligne['repertoire'];
            $cadreAdmin .= <<<EOD
            <a class='btn btn-sm btn-outline-dark mt-2 shadow-sm' href='/$repertoire/index.php'>
              $nom
              <i class="bi bi-info-circle text-info"
                   data-bs-toggle="popover"
                   data-bs-content="$description">
                </i>
            </a>
EOD;
        }
    }
}

$titreFonction = "Site de l'Amicale du Val de Somme";
require RACINE . '/include/head.php';
?>
<script src="index.js"></script>
<script src="epreuveadmin.js"></script>

<div class="card border-dark mx-2 mb-2">
    <div class="card-header text-white" style="background-color: #343a40">
        <span style="" class="card-text">Administration épreuves des 4 saisons</span>
    </div>
    <div class="card-body">
        <!-- <table>
            <thead>
            <tr>
                <th colspan="2">The table header</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>The table body</td>
                <td>with two columns</td>
            </tr>
            </tbody>
        </table>
        -->

        <p id="dateepreuve">

        </p>
        <a id='btnAjouter' class="btn btn-sm btn-success">
            Ajouter
        </a>
        <a id='btnModifier' class="btn btn-sm btn-warning">
            Modifier
        </a>
        <a id='btnSupprimer' class="btn btn-sm btn-danger">
            Supprimer
        </a>
    </div>
</div>


<?php require RACINE . '/include/pied.php'; ?>
