<?php
    require 'header.php';
    include 'bdd.php'; // Inclusion du fichier de connexion à la base de données
    $pdo = connect(); // Connexion à la base de données
    $oeuvres = getAllOeuvres($pdo); // Récupération de toutes les œuvres
?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
