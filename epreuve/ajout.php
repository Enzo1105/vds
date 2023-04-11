<?php
/**
 *  Affichage de l'interface d'ajout d'une épreuve des 4 saisons
 * Appel : index.php  bouton
 */


require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Nouvelle édition des 4 saisons";
require RACINE . '/include/head.php';
?>
<script src="../composant/date.js"></script>
<script src="../composant/ckeditor/ckeditor.js"></script>
<script src="ajout.js"></script>
<div id="formulaire" class="border p-3">
    <div id="msg" class="m-3"></div>
    <?php require "include/formulaire.php"; ?>
    <button id='btnAjouter' class="btn btn btn-danger text-white d-block w-100 ">Ajouter</button>
</div>

