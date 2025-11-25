<?php
$this->layout('layout', [
        'title' => 'Modifier le personnage : ' . $perso->getName()
]);

if (!isset($perso)) {
    echo "<p>❌ Erreur : aucun personnage trouvé pour édition.</p>";
    return;
}
?>

<h1 class="genshin-title">Modifier le personnage : <strong><?= $this->e($perso->getName()) ?></strong></h1>

<?php if (!empty($message)): ?>
    <?= $this->insert('message', ['message' => $message]) ?>
<?php endif; ?>


<form method="post" action="index.php?action=edit-perso" class="form-genshin">

    <!-- ID caché -->
    <input type="hidden" name="id" value="<?= $this->e($perso->getId()) ?>">

    <label for="nom">Nom :</label>
    <input type="text" name="perso-nom" id="nom" required
           value="<?= $this->e($perso->getName()) ?>">

    <label for="element">Élément :</label>
    <select name="perso-element" id="element" required>
        <?php foreach ($listElements as $el): ?>
            <option value="<?= $el->getId() ?>"
                    <?= $el->getId() === $perso->getElement()->getId() ? 'selected' : '' ?>>
                <?= $this->e($el->getName()) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="origin">Origine :</label>
    <select name="perso-origin" id="origin" required>
        <?php foreach ($listOrigins as $or): ?>
            <option value="<?= $or->getId() ?>"
                    <?= $or->getId() === $perso->getOrigin()->getId() ? 'selected' : '' ?>>
                <?= $this->e($or->getName()) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="class">Classe :</label>
    <select name="perso-class" id="class" required>
        <?php foreach ($listUnitClasses as $uc): ?>
            <option value="<?= $uc->getId() ?>"
                    <?= $uc->getId() === $perso->getUnitclass()->getId() ? 'selected' : '' ?>>
                <?= $this->e($uc->getName()) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="rarity">Rareté (4 ou 5) :</label>
    <input type="number" name="perso-rarity" id="rarity" min="4" max="5" required
           value="<?= $this->e($perso->getRarity()) ?>">

    <label for="url">URL de l’image :</label>
    <input type="url" name="perso-url" id="url" required
           value="<?= $this->e($perso->getUrlImg()) ?>">

    <button type="submit" class="btn-genshin">✅ Mettre à jour</button>
</form>
