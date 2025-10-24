<?php 
$titre = $_POST['titre'] ?? ''; // Récupération des données du formulaire
$artiste = $_POST['artiste'] ?? '';
$image = $_POST['image'] ?? '';
$description = $_POST['description'] ?? '';
$erreurs = []; // Tableau pour stocker les messages d'erreur

foreach(['titre','artiste','image','description'] as $field) { 
    if (empty($_POST[$field])) { // Vérification des champs obligatoires
        $erreurs[] = "Le champ " . htmlspecialchars($field) . " est obligatoire.";
    }
}
if (strlen($description) < 3 && !empty($description))  // Vérification de la longueur de la description
    $erreurs[] = "La description doit au moins contenir 3 caracteres.";


if (!filter_var($image, FILTER_VALIDATE_URL) && !empty($image))  // Vérification de l'URL de l'image
    $erreurs[] = "L'URL de l'image n'est pas valide.";


if (isset($_POST['submit']) && empty($erreurs)) { // Si le formulaire est soumis et qu'il n'y a pas d'erreurs
    include 'bdd.php'; // Inclusion du fichier de connexion à la base de données
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