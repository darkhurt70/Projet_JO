<?php
$this->layout('template', [
        'title' => 'Ajouter un nouveau personnage',
        'gameName' => $gameName
]);


?>



<?php if (!empty($message)): ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>

<form method="post" action="index.php?action=add-perso" class="form-genshin">

    <label for="nom">Nom :</label>
    <input type="text" name="perso-nom" id="nom" required>

    <label for="element">Élément :</label>
    <select name="perso-element" id="element" required>
        <option value="">-- Sélectionner un élément --</option>
        <?php foreach ($listElements as $el): ?>
            <option value="<?= $this->e($el->getId()); ?>">
                <?= $this->e($el->getName()); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="origin">Origine :</label>
    <select name="perso-origin" id="origin" required>
        <option value="">-- Sélectionner une origine --</option>
        <?php foreach ($listOrigins as $or): ?>
            <option value="<?= $this->e($or->getId()); ?>">
                <?= $this->e($or->getName()); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="class">Classe :</label>
    <select name="perso-class" id="class" required>
        <option value="">-- Sélectionner une classe --</option>
        <?php foreach ($listUnitClasses as $cl): ?>
            <option value="<?= $this->e($cl->getId()); ?>">
                <?= $this->e($cl->getName()); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="rarity">Rareté (4 ou 5) :</label>
    <input type="number" name="perso-rarity" id="rarity" min="4" max="5" required>

    <label for="url">URL de l’image :</label>
    <input type="url" name="perso-url" id="url" required>

    <br><br>
    <button type="submit" class="btn-genshin">Ajouter le personnage</button>
</form>
