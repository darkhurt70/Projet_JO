<?php
$this->layout('template', [
        'title' => 'Ajouter un nouveau personnage',
        'gameName' => $gameName
]);

?>


<h1 class="genshin-title">Ajouter un nouvel élément</h1>

<?php if (isset($message) && $message instanceof \Helpers\Message): ?>
    <div class="alert <?= $this->e($message->getColor()) ?>">
        <strong><?= $this->e($message->getTitle()) ?> :</strong> <?= $this->e($message->getContent()) ?>
    </div>
<?php elseif (!empty($message)): ?>
    <div class="alert"><?= $this->e($message) ?></div>
<?php endif; ?>


<form method="post" action="index.php?action=add-attribute" class="form-genshin">

    <label for="type">Type d'attribut :</label>
    <select name="type" id="type" required>
        <option value="origin">Origine</option>
        <option value="element">Élément</option>
        <option value="unitclass">Classe</option>
    </select>

    <label for="name">Nom :</label>
    <input type="text" name="name" required placeholder="Nom de l'attribut">

    <label for="url_img">URL de l’image :</label>
    <input type="url" name="url_img" required placeholder="https://exemple.com/image.jpg">

    <button type="submit" class="btn-genshin">Ajouter </button>
</form>
