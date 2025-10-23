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
?>

