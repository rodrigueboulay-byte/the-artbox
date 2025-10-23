<?php 
$titre = $_POST['titre'] ?? '';
$artiste = $_POST['artiste'] ?? '';
$image = $_POST['image'] ?? '';
$description = $_POST['description'] ?? '';
$erreurs = [];

if ($titre === ''){
    $erreurs['titre'] = "Le titre est obligatoire.";
} 
if ($artiste === ''){
    $erreurs['artiste'] = "L'artiste est obligatoire.";
}
if ($image === ''){
    $erreurs['image'] = "L'image est obligatoire.";
} elseif (!filter_var($image, FILTER_VALIDATE_URL)){
    $erreurs['image'] = "L'URL de l'image n'est pas valide";
}
if ($description === ''){
    $erreurs['description'] = "La description est obligatoire.";
} elseif (strlen($description) < 3){
    $erreurs['description'] = "La description doit contenir au moins 3 caractères.";
}

