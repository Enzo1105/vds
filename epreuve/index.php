<?php
/**
 * Page d'accueil affichant toutes les fonctionnalités offertes
 */

require '../include/initialisation.php';

// Génération du contenu du cadre membre
$cadreMembre = "";
if (isset($_SESSION['membre'])) {

    // option statique du menu 'Espace membres
    $cadreMembre .= <<<EOD
            <a class="btn btn-sm btn-outline-dark m-2 shadow-sm" href="/page/formation.php">Formation</a>

            <a class="btn btn-sm btn-outline-dark m-2 shadow-sm" href="/profil/annuaire.php">Annuaire</a>
            <a class="btn btn-sm btn-outline-dark m-2 shadow-sm" href="/profil/fiche.php">Ma fiche membre
                <i class="bi bi-info-circle text-info"
                   data-bs-toggle="popover"
                   data-bs-content="Complétez si vous le souhaitez vos informations personnelles : téléphone, photo.<br>Abonnez vous à la newletters ">
                </i>
            </a>
            <a class="btn btn-sm btn-outline-dark m-2 shadow-sm" href="/profil/modificationpassword.php">Modifier mon mot de passe</a>
            <a class='btn btn-sm btn-danger m-2 shadow-sm' href='/profil/deconnexion.php'>Se déconnecter</a>
EOD;
} else {
    $cadreMembre = "<a class='btn btn-sm btn-danger m-2 shadow-sm' href='/profil/connexion.php'>Se connecter</a>";
    $cadreMembre .= "<a class='btn btn-sm btn-outline-dark m-2 shadow-sm' href='/profil/oublipassword.php'>J'ai oublié mon mot de passe</a>";
    $cadreMembre .= "<a class='btn btn-sm btn-outline-dark m-2 shadow-sm' href='/profil/oublilogin.php'>J'ai oublié mon login</a>";
}

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
        --!>

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
