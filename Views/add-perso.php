<?php
// Titre de la page avec le nom du personnage si c'est une édition
$this->layout('layout', [
        'title' => isset($perso)
                ? 'Modifier le personnage : ' . $this->e($perso->getName())
                : 'Ajouter un personnage'
])
?>

<h2>
    <?= isset($perso)
            ? 'Modifier le personnage : <strong>' . $this->e($perso->getName()) . '</strong>'
            : 'Ajouter un nouveau personnage' ?>
</h2>

<?php if (!empty($message)): ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>

<form method="post" action="index.php?action=<?= isset($perso) ? 'edit-perso' : 'add-perso' ?>" class="form-container">

    <?php if (isset($perso)) : ?>
        <input type="hidden" name="id" value="<?= $this->e($perso->getId()) ?>">
    <?php endif; ?>

    <label for="nom">Nom :</label>
    <input type="text" name="perso-nom" id="nom" required
           value="<?= isset($perso) ? $this->e($perso->getName()) : '' ?>">

    <label for="element">Élément :</label>
    <input type="text" name="perso-element" id="element" required
           value="<?= isset($perso) ? $this->e($perso->getElement()) : '' ?>">

    <label for="origin">Origine :</label>
    <input type="text" name="perso-origin" id="origin" required
           value="<?= isset($perso) ? $this->e($perso->getOrigin()) : '' ?>">

    <label for="class">Classe :</label>
    <input type="text" name="perso-class" id="class" required
           value="<?= isset($perso) ? $this->e($perso->getUnitclass()) : '' ?>">

    <label for="rarity">Rareté (4 ou 5) :</label>
    <input type="number" name="perso-rarity" id="rarity" min="4" max="5" required
           value="<?= isset($perso) ? $this->e($perso->getRarity()) : '' ?>">

    <label for="url">URL de l’image :</label>
    <input type="url" name="perso-url" id="url" required
           value="<?= isset($perso) ? $this->e($perso->getUrlImg()) : '' ?>">

    <br><br>
    <button type="submit"><?= isset($perso) ? 'Mettre à jour' : 'Ajouter' ?> le personnage</button>
</form>
