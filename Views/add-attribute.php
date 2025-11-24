<?php $this->layout('layout', ['title' => 'Ajouter un Attribut']) ?>

<h2>Ajouter un nouvel attribut</h2>

<?php if (!empty($message)) : ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>

<form method="post" action="index.php?action=add-attribute" class="form-container">

    <label for="type">Type d'attribut :</label>
    <select name="type" id="type" required>
        <option value="">-- Choisir un type --</option>
        <option value="origin">Origine</option>
        <option value="element">Élément</option>
        <option value="unitclass">Classe</option>
    </select>

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" required>

    <label for="url">URL de l’image :</label>
    <input type="url" name="url" id="url" required>

    <br><br>
    <button type="submit">Ajouter</button>
</form>