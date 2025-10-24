<?php 
$titre = $_POST['titre'] ?? ''; // Récupération des données du formulaire
$artiste = $_POST['artiste'] ?? '';
$image = $_POST['image'] ?? '';
$description = $_POST['description'] ?? '';
$erreurs = []; // Tableau pour stocker les messages d'erreur

foreach (['titre','artiste','image','description'] as $champ) { // Vérification des champs obligatoires
    if (empty($_POST[$champ])) $erreurs[$champ] = ucfirst($champ)." est obligatoire."; // Message d'erreur si le champ est vide
}

if (!empty($_POST['image']) && !filter_var($_POST['image'], FILTER_VALIDATE_URL)) // Validation de l'URL de l'image
    $erreurs['image'] = "L'URL de l'image n'est pas valide.";

if (!empty($_POST['description']) && strlen($_POST['description']) < 3) // Validation de la description
    $erreurs['description'] = "La description doit contenir au moins 3 caractères.";


if (isset($_POST['submit']) && empty($erreurs)) { // Si le formulaire est soumis et qu'il n'y a pas d'erreurs
    include 'bdd.php'; 
    $pdo = connect();
    $stmt = $pdo->prepare('INSERT INTO oeuvres (titre, artiste, image, description) VALUES (?, ?, ?, ?)'); 
    $stmt->execute([$titre, $artiste, $image, $description]);
    header('Location: oeuvre.php?id=' . $pdo->lastInsertId()); // Redirection vers la page de l'œuvre ajoutée
    exit;
} else {
    session_start(); // Démarrage de la session pour stocker les erreurs et les anciennes valeurs
    $_SESSION['erreurs'] = $erreurs; // Stockage des messages d'erreur
    $_SESSION['old'] = $_POST; // Stockage des anciennes valeurs du formulaire
    header('Location: ajouter.php');
    exit;
}
?>