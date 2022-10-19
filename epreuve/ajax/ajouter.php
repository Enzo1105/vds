<?php
// Vérification des paramètres attendus
$erreur = false;

if (!isset($_POST['nom'])) {
    echo "\nLe paramètre 'nom' indiquant le nom de l'épreuve n'est pas transmis";
    $erreur = true;
}

if (!isset($_POST['description'])) {
    echo "\nLe paramètre 'description' indiquant la description de l'épreuve n'est pas transmis";
    $erreur = true;
}

if (!isset($_POST['date'])) {
    echo "\nLe paramètre 'date' indiquant la date de l'épreuve n'est pas transmis";
    $erreur = true;
}

if (!isset($_POST['dateOuverture'])) {
    echo "\nLe paramètre 'dateOuverture' indiquant la date de l'ouverture des inscriptions de l'épreuve n'est pas transmis";
    $erreur = true;
}

if (!isset($_POST['dateFermeture'])) {
    echo "\nLe paramètre 'dateFermeture' indiquant la date de fermeture des inscriptions de l'épreuve n'est pas transmis";
    $erreur = true;
}

if ($erreur) exit;

// récupération des paramètres avec mise en forme attendue

require '../../class/class.controle.php';
$nom = strtoupper(Controle::supprimerEspace($_POST['nom']));
$description = trim($_POST['description']);

// Contrôle des données

require '../../class/class.database.php';
$db = Database::getInstance();

// contrôle du nom
if ($nom === '') {
    echo "\nLe nom doit être renseigné.";
    $erreur = true;
} elseif (!preg_match("/^[A-Z]( ?[A-Z])*$/", $nom)) {
    echo "\nLe nom ne doit comporter que des lettres majuscules non accentuées et des espaces";
    $erreur = true;
} elseif (mb_strlen($nom) > 70) {
    echo "\nLe nom ne doit pas dépasser 70 caractères";
    $erreur = true;
}

// contrôle de la description de l'épreuve
if (empty($description)) {
    echo "\nLa description de l'épreuve doit être renseignée.";
    $erreur = true;
} elseif (!preg_match("/^[A-Z]( ?[A-Z])*$/", $description)) {
    echo "\nLa description ne doit comporter que des lettres majuscules non accentuées et des espaces : $description.";
    $erreur = true;
} else {
    // Vérification de l'existence de l'id du Description
    $sql = <<<EOD
			SELECT 1
			FROM epreuve
			where id = :description;
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('description', $description);
    $curseur->execute();
    $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
    $curseur->closeCursor();
    if (!$ligne) {
        echo "Cette Description n'existe pas";
        $erreur = true;
    }
}

// enregistrement de l'ajout

$sql = <<<EOD
    insert into epreuve(nom, description)
           values (:nom, :description);
EOD;
$curseur = $db->prepare($sql);
$curseur->bindParam('nom', $nom);
$curseur->bindParam('description', $description);
try {
    $curseur->execute();
    echo 1;
} catch(Exception $e) {
    echo substr($e->getMessage(),strrpos($e->getMessage(), '#') + 1);
}