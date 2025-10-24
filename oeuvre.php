<?php
    require 'header.php';
    include 'bdd.php'; // Inclusion du fichier de connexion à la base de données
    $pdo = connect(); // Connexion à la base de données
    $oeuvre = getOeuvreById($pdo); // Récupération de l'œuvre par son ID
    if (!$oeuvre) { // Si l'œuvre n'existe pas, redirection vers la page d'accueil
        header('Location: index.php');
        exit; 
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
