<?php
/**
 *  Suppression d'une épreuve des 4 saisons
 * Appel : epreuve/index.js
 */

$ajax = 1;
require '../../include/initialisation.php';
require '../../include/controleacces.php';
echo Std::delete('epreuve');
