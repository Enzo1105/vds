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
<script src="index.js"></script>
<script src="epreuveadmin.js"></script>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
<script src="index.js"></script>
<div id="msg" class="m-3"></div>
<div class="card border-dark mx-2 mb-2">
    <div class="card-header text-white" style="background-color: #343a40">
        <span style="" class="card-text">Ajout/Suppression/Modifications des épreuves</span>
    </div>
<div id="msg" class="m-3"></div>
<div class="row">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="input-group mb-3 col-6">
            <label class="input-group-text" for="idEpreuve">Epreuve</label>
            <select class="form-select" id="idEpreuve"></select>
            <button id="btnSupprimer" class="btn btn-danger" title="Supprimer l'épreuve sélectionnée">Supprimer
            </button>
            <a button id='ajoutEpreuve' class="btn btn-success "
               data-bs-toggle="modal"
               data-bs-target="#frmAjout"
               data-bs-trigger="hover"
               data-bs-placement='bottom'
               title="Ajouter une épreuve">
                Ajouter
            </a>
            <a class="btn btn-warning" href="../epreuve/modifierepreuve.php">
                Modifier une épreuve
            </a>
        </div>
    </div>
</div>

<div id='droit'>
    <div class="d-flex justify-content-between">
        <h4 class="">Les épreuves disponibles</h4>
    </div>
    <div id="lesModules"></div>
</div>
<?php require RACINE . '/include/pied.php'; ?>

<!-- Fenêtre nodale pour l'ajout d'une épreuve -->
<div class="modal fade" id="frmAjout"
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     data-bs-backdrop="true" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une nouvelle épreuve</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="msgFrmAjout"></div>
                <label for="nom" class="mt-1 pl-3">Epreuve</label>
                <input id="nom"
                       style="width: 250px"
                       type="text"
                       placeholder="Nom de l'épreuve"
                       class="form-control">
                <div id="messageNom" class="messageErreur"></div>
                <div class="text-center m-3">
                    <button id='btnAjouter' class="btn btn-sm btn-success">Ajouter une épreuve</button>
                </div>
                <div class="col-auto messageErreur" id="msgAjout">
                </div>
            </div>
        </div>
    </div>
</div>
<?php require RACINE . '/include/pied.php'; ?>
