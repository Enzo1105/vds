<?php

/**
 *  Affichage de l'interface de gestion des épreuves des 4 saisons
 * Appel : Cadre Administration - 'Epreuve'
 */

require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Planification des 4 saisons";
require RACINE . '/include/head.php';
?>
<script src="../composant/date.js"></script>
<script src="../composant/ckeditor/ckeditor.js"></script>

<script src="index.js"></script>
<div id="formulaire" style="visibility: hidden">
    <div id="msg" class="m-3"></div>
    <div class="row">
        <div class="col-12 col-sm-10 col-md-8 ">
            <div class="input-group mb-3 ">
                <label class="input-group-text" for="liste">Épreuve</label>
                <select class="form-select col-4" id="liste"></select>
                <button id="btnSupprimer" class="btn btn-danger ">Supprimer</button>
                <a href="ajout.php" class="btn btn-success my-auto">Nouvelle épreuve</a>
            </div>
        </div>
    </div>
    <div class="border p-3 m-1">
        <?php require "include/formulaire.php"; ?>
        <button id="btnModifier" class="btn btn-danger mt-1 d-block w-100">Modifier</button>
    </div>
</div>
