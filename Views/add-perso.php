<?php
$this->layout('template', [
        'title' => 'Ajouter un nouveau personnage',
        'gameName' => 'Ajouter un nouveau personnage'
]);


?>



<?php if (!empty($message)): ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>

<form method="post" action="index.php?action=add-perso" class="form-container">

    <label for="nom">Nom :</label>
    <input type="text" name="perso-nom" id="nom" required>

    <label for="element">Élément :</label>
    <input type="text" name="perso-element" id="element" required>

    <label for="origin">Origine :</label>
    <input type="text" name="perso-origin" id="origin" required>

    <label for="class">Classe :</label>
    <input type="text" name="perso-class" id="class" required>

    <label for="rarity">Rareté (4 ou 5) :</label>
    <input type="number" name="perso-rarity" id="rarity" min="4" max="5" required>

    <label for="url">URL de l’image :</label>
    <input type="url" name="perso-url" id="url" required>

    <br><br>
    <button type="submit" class="btn-genshin">Ajouter le personnage</button>
</form>
