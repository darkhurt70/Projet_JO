<?php
$this->layout('layout', [
    'title' => 'Modifier le personnage : '
]);

if (!isset($perso)) {
    echo "<p>❌ Erreur : aucun personnage trouvé pour édition.</p>";
    return;
}
?>

<h2>Modifier le personnage : <strong><?= $this->e($perso->getName()) ?></strong></h2>

<?php if (!empty($message)): ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>

<form method="post" action="index.php?action=edit-perso" class="form-container">

    <!-- ID caché -->
    <input type="hidden" name="id" value="<?= $this->e($perso->getId()) ?>">

    <label for="nom">Nom :</label>
    <input type="text" name="perso-nom" id="nom" required
           value="<?= $this->e($perso->getName()) ?>">

    <label for="element">Élément :</label>
    <input type="text" name="perso-element" id="element" required
           value="<?= $this->e($perso->getElement()) ?>">

    <label for="origin">Origine :</label>
    <input type="text" name="perso-origin" id="origin" required
           value="<?= $this->e($perso->getOrigin()) ?>">

    <label for="class">Classe :</label>
    <input type="text" name="perso-class" id="class" required
           value="<?= $this->e($perso->getUnitclass()) ?>">

    <label for="rarity">Rareté (4 ou 5) :</label>
    <input type="number" name="perso-rarity" id="rarity" min="4" max="5" required
           value="<?= $this->e($perso->getRarity()) ?>">

    <label for="url">URL de l’image :</label>
    <input type="url" name="perso-url" id="url" required
           value="<?= $this->e($perso->getUrlImg()) ?>">

    <br><br>
    <button type="submit">Mettre à jour le personnage</button>
</form>
