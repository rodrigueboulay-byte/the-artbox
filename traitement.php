<?php 
$titre = $_POST['titre'] ?? '';
$artiste = $_POST['artiste'] ?? '';
$image = $_POST['image'] ?? '';
$description = $_POST['description'] ?? '';
$erreurs = [];

foreach (['titre','artiste','image','description'] as $champ) {
    if (empty($_POST[$champ])) $erreurs[$champ] = ucfirst($champ)." est obligatoire.";
}

if (!empty($_POST['image']) && !filter_var($_POST['image'], FILTER_VALIDATE_URL))
    $erreurs['image'] = "L'URL de l'image n'est pas valide.";

if (!empty($_POST['description']) && strlen($_POST['description']) < 3)
    $erreurs['description'] = "La description doit contenir au moins 3 caractères.";


if (isset($_POST['submit']) && empty($erreurs)) {
    include 'bdd.php';
    $pdo = connect();
    $stmt = $pdo->prepare('INSERT INTO oeuvres (titre, artiste, image, description) VALUES (?, ?, ?, ?)');
    $stmt->execute([$titre, $artiste, $image, $description]);
    header('Location: oeuvre.php?id=' . $pdo->lastInsertId());
    exit;
} else {
    session_start();
    $_SESSION['erreurs'] = $erreurs;
    $_SESSION['old'] = $_POST;
    header('Location: ajouter.php');
    exit;
}
?>