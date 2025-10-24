<?php require 'header.php'; ?>

<?php
session_start(); // Démarrage de la session

$erreurs = $_SESSION['erreurs'] ?? []; // Récupération des messages d'erreur de la session
$old = $_SESSION['old'] ?? []; // Récupération des anciennes valeurs du formulaire

unset($_SESSION['erreurs'], $_SESSION['old']); // Nettoyage des erreurs et des anciennes valeurs de la session
?>


<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre"
            value="<?= htmlspecialchars($old['titre'] ?? '') ?>">   
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste"
            value="<?= htmlspecialchars($old['artiste'] ?? '') ?>"> 
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image"
            value="<?= htmlspecialchars($old['image'] ?? '') ?>"> 
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description"
            ><?= htmlspecialchars($old['description'] ?? '') ?></textarea> 
            
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php if (!empty($erreurs)): ?> 
    <div style="color: red; margin-bottom: 50px; margin-left: 400px;"> 
        <strong>Merci de corriger les erreurs suivantes :</strong>
        <ul>
            <?php foreach ($erreurs as $message): ?>
                <li><?= htmlspecialchars($message) ?></li> 
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php require 'footer.php'; ?>
