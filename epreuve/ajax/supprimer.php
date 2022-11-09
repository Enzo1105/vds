<?php
// vérification des paramètre transmis
if (!isset($_POST['nom'])) {
    echo "\nLe paramètre 'id' indiquant l'id' de l'épreuve n'est pas transmis";
    $erreur = true;
}

if ($erreur) exit;

// récupération des données
$id = trim($_POST['id']);

// contrôle des données
require '../../class/class.database.php';
$db = Database::getInstance();

if (empty($epreuve)) {
    echo "L'id de l'épreuve doit être renseigné.";
    $erreur = true;
} elseif (!preg_match("/^[0-9]{1,2}$/", $epreuve)) {
    echo "Le numéro de licence doit être composé de 1 seul chiffre.";
    exit;
} else {
    // Vérification de l'existence de l'id de l'épreuve et de la possibilité de le supprimer
    $sql = <<<EOD
        SELECT 1
        FROM epreuve
        where id = :id;
EOD;
}

// Réalisation de la requête de suppression

$sql = <<<EOD
   DELETE FROM epreuve
   WHERE id = :id;
EOD;
$curseur = $db->prepare($sql);
$curseur->bindParam('id', $id);
try {
    $curseur->execute();
    echo 1;
} catch (Exception $e) {
    echo substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
}