<?php
function connect () { // Fonction de connexion à la base de données
    $host = 'localhost'; // Adresse du serveur MySQL
    $db   = 'artbox'; // Nom de la base de données
    return new PDO("mysql:host=$host;dbname=$db;", 'root', ''); // Connexion avec PDO
}
function getAllOeuvres($pdo) { // Récupère toutes les œuvres de la base de données
    $stmt = $pdo->query('SELECT * FROM oeuvres'); // Exécution de la requête
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les œuvres sous forme de tableau associatif
}
function getOeuvreById($pdo) { // Récupère une œuvre par son ID
    $stmt = $pdo->prepare('SELECT * FROM oeuvres WHERE id = ?'); // Préparation de la requête
    $stmt->execute([$_GET['id']]); // Exécution avec l'ID passé en paramètre GET
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne l'œuvre sous forme de tableau associatif
}
?>

