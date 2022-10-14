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
$idPays = trim($_POST['idPays']);

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
} elseif (mb_strlen($nom) > 30) {
    echo "\nLe nom ne doit pas dépasser 30 caractères";
    $erreur = true;
}

// contrôle du nom du pays
if (empty($idPays)) {
    echo "\nLe nom du pays doit être renseigné.";
    $erreur = true;
} elseif (!preg_match("/^[A-Z]( ?[A-Z])*$/", $idPays)) {
    echo "\nLe nom ne doit comporter que des lettres majuscules non accentuées et des espaces : $idPays.";
    $erreur = true;
} else {
    // Vérification de l'existence de l'id du pays
    $sql = <<<EOD
			SELECT 1
			FROM ecurie
			where id = :idPays;
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('idPays', $idPays);
    $curseur->execute();
    $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
    $curseur->closeCursor();
    if (!$ligne) {
        echo "Ce pays n'existe pas";
        $erreur = true;
    }
}

// enregistrement de l'ajout

$sql = <<<EOD
    insert into ecurie(nom, idPays)
           values (:nom, :idPays);
EOD;
$curseur = $db->prepare($sql);
$curseur->bindParam('nom', $nom);
$curseur->bindParam('idPays', $idPays);
try {
    $curseur->execute();
    echo 1;
} catch(Exception $e) {
    echo substr($e->getMessage(),strrpos($e->getMessage(), '#') + 1);
}
