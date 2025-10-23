<?php
function connect () {
    $host = 'localhost';
    $db   = 'artbox';
    return new PDO("mysql:host=$host;dbname=$db;", 'root', '');
}
function getAllOeuvres($pdo) {
    $stmt = $pdo->query('SELECT * FROM oeuvres');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getOeuvreById($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM oeuvres WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

