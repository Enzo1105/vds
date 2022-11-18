<?php
/**
 * Page d'accueil admin des épreuves
 */

require '../include/initialisation.php';


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
$titreFonction = "Administration épreuves des 4 saisons";
require RACINE . '/include/head.php';
?>
<script src="modifierepreuve.js"></script>
<div id="msg" class="m-3"></div>
<div class="card border-dark mx-2 mb-2">
    <div class="card-header text-white" style="background-color: #343a40">
        <span style="" class="card-text">Modification de la description des épreuves</span>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <script src="index.js"></script>
    <div class="row mt-3 ml-1">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="input-group mb-3 col-6">
                <label class="input-group-text" for="liste">Epreuve à modifier</label>
                <select class="form-select " id="liste"></select>
            </div>
        </div>
    </div>
    <div id="formulaire" class="border p-3">
        <label class="col-form-label" for="contenu">Contenu de la description de l'épreuve à modifier</label>
        <textarea id='contenu' required minlength="10" style="display:none"></textarea>
        <div id="messageContenu" class="messageErreur"></div>
        <button id='btnModifier' class="btn btn-danger d-block w-100 ">Modifier</button>
    </div>

