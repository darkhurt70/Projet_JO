<?php
$this->layout('template', ['title' => 'Ajouter un élément']) ?>
$this->layout('template', ['title' => 'Ajouter un élément',
'gameName' => 'Ajouter un élément' ]) ?>
<h1>Page : Ajouter un élément</h1>

<form method="post" action="index.php?action=add-attribute">
    <label for="type">Type d'attribut :</label>
    <select name="type" id="type" required>
        <option value="origin">Origine</option>
        <option value="element">Élément</option>
        <option value="unitclass">Classe</option>
    </select>

    <label for="name">Nom :</label>
    <input type="text" name="name" required>

    <label for="url_img">URL de l’image :</label>
    <input type="url" name="url_img" required>

    <button type="submit">Ajouter</button>
</form>